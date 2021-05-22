<?php

@copyright   2021 Éric Bart <eric.bart@etu.univ-tlse3.fr>, 2020 Edisson Sigua <edissonf.sigua@gmail.com>, Bryan Aguilar <bryan.aguilar6174@gmail.com>

namespace local_fliplearning;

require_once dirname(__FILE__) . '/../../../course/lib.php';
require 'vendor/autoload.php';
defined('MOODLE_INTERNAL') || die();

use MongoDB\Client as MongoDBLink;

class logs {

//if (isset($_GET['beginDate'], $_GET['lastDate']) && !empty($_GET['beginDate']) && !empty($_GET['lastDate'])) {
//    $beginDate = $_GET['beginDate'];
//    $lastDate = $_GET['lastDate'];
//    searchLogs($beginDate, $lastDate);
//}

    public $beginDate;
    public $lastDate;
    public $courseid;
    public $userid;
    public $timecreated;
    public $firstname;
    public $lastname;
    public $detail;
    public $client;


    public function __construct($courseid, $userid) {
        $this->courseid=$courseid;
        $this->userid=$userid;
        $this->client = new MongoDBLink;
    }

    public function addLogsNMP($actionType, $objectType, $sectionName, $objectName, $currentLink, $objectDescription = null) {
        $userInformations=self::getUserIdentification($this->userid);
        $nmpDB = $this->client->nmpDB;
        $nmpDBCollection = $nmpDB->logsNMP;
        /**$testData = $nmpDBCollection->insertOne([
                    'userid' => $this->userid,
                    'courseid' =>$this->courseid,
                    'timecreated' =>time(),
                    'username' => $userInformations['username'],
                    'firstname' => $userInformations['firstname'],
                    'lastname' => $userInformations['lastname'],
                    'sectionname'=> $sectionname,
                    'actiontype' => $actiontype
                ]);**/
        $testData = $nmpDBCollection->insertOne(['actor' =>
                                                    ['objectType'=>'student',
                                                    'mbox'=>'eric.bart@nmp.com',
                                                    'name'=>$userInformations['firstname'].' '.$userInformations['lastname'],
                                                        'account' =>
                                                            ['homepage'=>'http://locahost/moodle/my',
                                                            'name'=>$userInformations['username']]
                                                    ]
                                                ,
                                                'verb' =>
                                                    ['id'=>'https://www.irit.fr/laser/nmp/xapi/verbs/'.$actionType,
                                                     'display'=>['en-US'=>$actionType]
                                                    ]
                                                ,
                                                'object' =>
                                                    ['id'=>'https://www.irit.fr/laser/nmp/xapi/object/'.$objectType,
                                                     'objectType'=>$objectType,
                                                     'definition' => [
                                                         'name'=> ['en-US'=>$objectName],
                                                         'description'=>['en-US'=>$objectDescription]
                                                     ]
                                                        ,
                                                     'context'=> [ 'contextActivities'=>
                                                         ['grouping'=>$sectionName]
                                                     ]
                                                     ]
                                                ,
                                                'context'=>
                                                    ['platform' => 'Moodle',
                                                    'contextActivities'=>['grouping'=>['id'=>$currentLink]]
                                                ]
                                                ,
                                                'timestamp'=>time()
                ]
        );
    }

    public function searchLogsNMP($beginDate, $lastDate)
    {
        $nmpDB = $this->client->nmpDB;
        $nmpDBCollection = $nmpDB->logsNMP;

        $this->beginDate=$beginDate;
        $this->lastDate=$lastDate;

        $lastDate = strtotime("+1 day", strtotime($lastDate));
        $beginDate = strtotime($beginDate);

        //ici on select les donnees
        $find = $nmpDBCollection->find(
            ['timestamp' => ['$gt'=>$beginDate,'$lt'=>$lastDate]]
        );
        //$find = $nmpDBCollection->find(['actor'=>'test']);
        //var_dump(basename(dirname($_SERVER['SCRIPT_NAME'])));
        //$find2 = iterator_to_array($find);
        /**foreach($find as $row) {
            print_r($row->actor->mbox);
        }**/
        return self::generateLogsNMP($find);
    }

    public function generateLogsNMP($data)
    {
        self::remove_old_logs($this->courseid);
        //$filename = "Logs"."_$this->beginDate"."_to_"."$this->lastDate".".csv";
        $filename = "ActivityLogsNMP_Course". $this->courseid . ".csv";
        $path = dirname(__FILE__) . "/../downloads/";
        $csv = fopen($path.$filename, "w+");
        /**$entetes = array("UserID",
            self::accent_remover(get_string("fml_logs_csv_headers_username", "local_fliplearning")),
            self::accent_remover(get_string("fml_logs_csv_headers_firstname","local_fliplearning")),
            self::accent_remover(get_string("fml_logs_csv_headers_lastname","local_fliplearning")),
            self::accent_remover(get_string("fml_logs_csv_headers_date","local_fliplearning")),
            self::accent_remover(get_string("fml_logs_csv_headers_hour","local_fliplearning")),
            "CoursID",
            "NMP_SECTION_NAME",
            "NMP_ACTION_TYPE"
        );**/

        $entetes = array("Username",
                        "Name",
                        "Date",
                        "Hour",
                        "CoursID",
                        "NMP_SECTION_NAME",
                        "NMP_ACTION_TYPE");
        //var_dump($data);
        //die();
        fputcsv($csv, $entetes, ";");
        foreach ($data as $row) {
        /**    $row->timecreated += 3600;
            $tabData = array(
                $row->userid,
                $row->username,
                $row->firstname,
                $row->lastname,
                date("d-m-y", $row->timecreated),
                date("H:i:s", $row->timecreated),
                $row->courseid,
                $row->sectionname,
                $row->actiontype
            );**/
            $courseid=explode('courseid=', $row->context->contextActivities->grouping->id);
            $tabData = array(
                $row->actor->account->name,
                $row->actor->name,
                date('d-m-y', $row->timestamp),
                date("H:i:s", $row->timestamp),
                $courseid[1],
                $row->object->context->contextActivities->grouping,
                $row->verb->display->{'en-US'} . '_' . $row->object->definition->name->{'en-US'} . '_' . $row->object->objectType
            );


            fputcsv($csv, $tabData, ";");
        }
        fclose($csv);
        return $filename;
    }

    /**
     * Cette fonction a pour but d'aller chercher dans la base de donnée toutes les logs qui sont contenues entre
     * les deux dates qui sont spécifiées par l'utilisateur ($beginDate & $lastDate)
     *
     * @param $beginDate  Date minimum de la recherche
     * @param $lastDate   Date maximum de la recherche
     * @return mixed      Tous les logs contenus entre cet interval
     */
    public function searchLogsMoodle($beginDate, $lastDate)
    {
        global $DB;
        $this->beginDate=$beginDate;
        $this->lastDate=$lastDate;
        $lastDate = strtotime("+1 day", strtotime($lastDate));
        $beginDate = strtotime($beginDate);
        $sql = "SELECT * from {logstore_standard_log} WHERE timecreated>={$beginDate} AND timecreated<={$lastDate} AND courseid={$this->courseid}";
        $find = $DB->get_records_sql($sql);
        return self::generateLogsMoodle($find);
    }

    /**
     * Génère un fichier .csv contenant toutes les logs d'une date donnée
     *
     * @param array $data Tableau contenant les données
     */
    public function generateLogsMoodle($data)
    {
        self::remove_old_logs($this->courseid);
        //$filename = "Logs"."_$this->beginDate"."_to_"."$this->lastDate".".csv";
        $filename = "ActivityLogsMoodle_Course". $this->courseid . ".csv";
        $path = dirname(__FILE__) . "/../downloads/";
        $csv = fopen($path.$filename, "w+");
        $entetes = array("UserID",
                        self::accent_remover(get_string("fml_logs_csv_headers_username", "local_fliplearning")),
                        self::accent_remover(get_string("fml_logs_csv_headers_firstname","local_fliplearning")),
                        self::accent_remover(get_string("fml_logs_csv_headers_lastname","local_fliplearning")),
                        self::accent_remover(get_string("fml_logs_csv_headers_date","local_fliplearning")),
                        self::accent_remover(get_string("fml_logs_csv_headers_hour","local_fliplearning")),
                        self::accent_remover(get_string("fml_logs_csv_headers_action","local_fliplearning")),
                        "CoursID",
                        self::accent_remover(get_string("fml_logs_csv_headers_coursename","local_fliplearning")),
                        "DetailID",
                        self::accent_remover(get_string("fml_logs_csv_headers_detail","local_fliplearning")),
                        self::accent_remover(get_string("fml_logs_csv_headers_detailtype","local_fliplearning")));
        fputcsv($csv, $entetes, ";");
        foreach ($data as $res => $val) {
            $name = self::getUserIdentification($val->userid);
            $course = self::getCourse($val->courseid);
            $detail = self::getDetail($val->objectid, $val->objecttable);
            $val->timecreated += 3600; //3600 correspond à 1h de notre temps, on ajoute 1h à l'heure de création car l'heure de création a un décalage de -1h.
            $tabData = array($name['id'],
                $name['username'],
                $name['firstname'],
                $name['lastname'],
                date("d-m-y", $val->timecreated),
                date("H:i:s", $val->timecreated),
                $val->action,
                $val->courseid,
                $course,
                $val->objectid,
                $detail,
                $val->objecttable);
            fputcsv($csv, $tabData, ";");
        }
        fclose($csv);
        return $filename;
    }

    /**
     * Retourne un tableau associatif contenant l'username, le nom ainsi que le prénom de la personne visée
     *
     * @param $userid Identifiant de l'utilisateur
     * @return array  Tableau associatif contenant username, firstname & lastname de l'utilisateur
     */
    public function getUserIdentification($userid)
    {
        global $DB;
        $name = (array)$DB->get_record("user", array("id" => $userid), "id, username, lastname, firstname"); //On cherche le nom de la personne qui a fait la log
        //var_dump($name);
        if ($name) {
            if (empty($name['username'])) {
                $name['username'] = "Undefined";
            }
            if (empty($name['lastname'])) {
                $name['lastname'] = "Undefined";
            }
            if (empty($name['firstname'])) {
                $name['firstname'] = "Undefined";
            }
            return $name;
        }
        $name['username'] = "Not found";
        $name['username'] = "Not found";
        $name['firstname'] = "Not found";
        return $name;
    }

    /**
     * Retourne un tableau associatif contenant le nom complet du cours visé
     *
     * @param $courseid Identifiant du cours
     * @return array    Tableau associatif contenant le nom complet du cours
     */
    public function getCourse($courseid)
    {
        global $DB;
        $course = (array)$DB->get_record("course", array("id" => $courseid), "fullname");
        $course = self::accent_remover($course['fullname']);
        if ($course) {
            return $course;
        }
        $course = "";
        return $course;
    }

    /**
     * Fonction permettant de récupérer les informations précises des actions des utilisateurs
     *
     * @param $objectid id de l'objet visé (test, dépôt, etc..)
     * @param $datatable base de données où aller chercher l'information
     * @return string|string[] informations retournées
     */
    public function getDetail($objectid, $datatable)
    {
        global $DB;
        if (!empty($objectid) && !empty($datatable)) {
            if ($datatable == 'assign' || $datatable == 'assignment' || $datatable == 'book'
                || $datatable == 'chat' || $datatable == 'choice' || $datatable == 'data' || $datatable == 'forum'
                || $datatable == 'glossary' || $datatable == 'imscp' || $datatable == 'lesson' || $datatable == 'label'
                || $datatable == 'lti' || $datatable == 'page' || $datatable == 'quiz' || $datatable == 'resource'
                || $datatable == 'scorm' || $datatable == 'url' || $datatable == 'wiki' || $datatable == 'workshop'
                || $datatable == 'folder' || $datatable == 'course_sections' || $datatable == "enrol") {
                $detail = (array)$DB->get_record($datatable, array("id" => $objectid), "name", "id");
                $detail = self::accent_remover($detail['name']);
            } else if ($datatable == 'grade_items') {
                $detail = (array)$DB->get_record($datatable, array("id" => $objectid), "itemname", "id");
                $detail = self::accent_remover($detail['itemname']);
            }
            return $detail;
        }
    }

    /**
     * Fonction permettant d'harmoniser le fichier csv avec un encodage sans accent, permet d'éviter d'eventuels
     * bugs de rendu
     *
     * @param $cadena chaîne à vérifier
     * @return string|string[] chaîne $cadena sans accent
     */
    public function accent_remover($cadena)
    {
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );
        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena);
        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena);
        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena);
        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena);
        $cadena = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );
        return $cadena;
    }

    /**
     * Fonction permettant d'enlever les identifiants inutiles
     * /!\ Retirée car finalement inutile dans le traitement du CSV.
     * @param $value valeur à vérifier
     * @return string valeur vide si id inutile
     */
    //public function clearCSV($value)
    //{
    //    if ($value == 0 || $value == "0") {
    //        $value = "";
    //    }
    //    return $value;
    //}

    /**
     * Fonction permettant de télécharger le fichier de logs directement grace à du code php (utile pour debug)
     */
    //public function downloadFile()
    //{
    //    $file = "Logs_" . $_GET['file'];
    //    $tempDir = sys_get_temp_dir();
    //    header("Cache-Control: private");
    //    header("Content-Description: File Transfer");
    //    header("Content-Disposition: attachment; filename=$file.csv");
    //    header("Content-Type: application/csv");
    //    header("Content-Transfer-Emcoding: binary");
    //    readfile("$tempDir" . DIRECTORY_SEPARATOR . "data.csv");
    //}

    /**
     * Enlève l'ancien fichier de logs généré ayant le même identifiant de cours dans un souci d'éviter les
     * duplications dans le disque du serveur.
     *
     * @param $courseid l'identifiant du cours contenu dans le nom du fichier à supprimer
     *
     */
    public static function remove_old_logs($courseid){
        $path = dirname(__FILE__) . "/../downloads";
        $files = glob($path . '/*');
        foreach($files as $file){
            if(is_file($file)){
                $route_parts = explode(".", $file);
                foreach($route_parts as $route_part){
                    if($route_part == $courseid){
                        unlink($file);
                    }
                }
            }
        }
    }
}
?>
