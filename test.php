<?php
require_once (dirname(__FILE__).'/../../config.php');
defined('MOODLE_INTERNAL') || die();

if (isset($_GET['beginDate'], $_GET['lastDate']) && !empty($_GET['beginDate']) && !empty($_GET['lastDate'])) {
    $beginDate = $_GET['beginDate'];
    $lastDate = $_GET['lastDate'];
    $find = searchLogs($beginDate, $lastDate);
    generateLogs($find);
    downloadFile();
}

/**
 * Cette fonction a pour but d'aller chercher dans la base de donnée toutes les logs qui sont contenues entre
 * les deux dates qui sont spécifiées par l'utilisateur ($beginDate & $lastDate)
 *
 * @param $beginDate  Date minimum de la recherche
 * @param $lastDate   Date maximum de la recherche
 * @return mixed      Tous les logs contenus entre cet interval
 */
function searchLogs($beginDate, $lastDate)
{
    global $DB;
    if($beginDate==$lastDate) {
        $beginDate = strtotime($beginDate);
        $lastDate = strtotime($lastDate) + strtotime('+1 day', $lastDate);
    } else {
        $beginDate = strtotime($beginDate);
        $lastDate = strtotime($lastDate);
    }
    $sql = "SELECT * from {logstore_standard_log} WHERE timecreated>={$beginDate} AND timecreated<={$lastDate}";
    $find = $DB->get_records_sql($sql);
    return $find;
}

/**
 * Génère un fichier .csv contenant toutes les logs d'une date donnée
 *
 * @param array $data Tableau contenant les données
 */
function generateLogs(array $data)
{
    $tempDir = sys_get_temp_dir();
    $csv = fopen("$tempDir" . DIRECTORY_SEPARATOR . "data.csv", "w+");
    $entetes = array("UserID", "Nom d'utilisateur", "Nom", "Prenom", "Date", "Heure", "Action", "CoursID", "Nom du cours", "DetailID", "Detail", "objecttable");
    fputcsv($csv, $entetes, ";");
    foreach ($data as $res => $val) {
        $name = getUserIdentification($val->userid);
        $course = getCourse($val->courseid);
        $detail = getDetail($val->objectid, $val->objecttable);
        $val->courseid = clearCSV($val->courseid);
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
}

/**
 * Retourne un tableau associatif contenant l'username, le nom ainsi que le prénom de la personne visée
 *
 * @param $userid Identifiant de l'utilisateur
 * @return array  Tableau associatif contenant username, firstname & lastname de l'utilisateur
 */
function getUserIdentification($userid)
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
function getCourse($courseid)
{
    global $DB;
    $course = (array)$DB->get_record("course", array("id" => $courseid), "fullname");
    $course = accent_remover($course['fullname']);
    if ($course) {
        return $course;
    }
    $course = "";
    return $course;
}

function getDetail($objectid, $datatable)
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
            $detail = accent_remover($detail['name']);
        } else if ($datatable == 'grade_items') {
            $detail = (array)$DB->get_record($datatable, array("id" => $objectid), "itemname", "id");
            $detail = accent_remover($detail['itemname']);
        }
        return $detail;
    }
}

function accent_remover($cadena)
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

function clearCSV($value)
{
    if ($value == 0 || $value == "0") {
        $value = "";
    }
    return $value;
}

function downloadFile()
{
    $file = "Logs_" . $_GET['file'];
    $tempDir = sys_get_temp_dir();
    header("Cache-Control: private");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$file.csv");
    header("Content-Type: application/csv");
    header("Content-Transfer-Emcoding: binary");
    readfile("$tempDir" . DIRECTORY_SEPARATOR . "data.csv");
}

?>