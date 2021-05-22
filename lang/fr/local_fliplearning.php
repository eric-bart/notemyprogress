<?php
// Ce fichier fait partie de Moodle - http://moodle.org/
//
// Moodle est un logiciel libre: vous pouvez le redistribuer et / ou le modifier
// selon les termes de la licence publique générale GNU comme publié par
// la Free Software Foundation, soit la version 3 de la licence, soit
// (à votre choix) toute version ultérieure.
//
// Moodle est distribué dans l\'espoir qu'il sera utile,
// mais SANS AUCUNE GARANTIE; sans même la garantie implicite de
// QUALITÉ MARCHANDE ou d\'aDÉQUATION À UN USAGE PARTICULIER. Voir la
// Licence publique générale GNU pour plus de détails.
//
// Vous devriez avoir reçu une copie de la licence publique générale GNU
// avec Moodle. Sinon, consultez <http://www.gnu.org/licenses/>.

/**
* Les chaînes de plugins sont définies ici.
*
* @package local_fliplearning
* @category string
* @copyright 2020 Edisson Sigma <edissonf.sigua@gmail.com>, Bryan Aguilar <bryan.aguilar6174@gmail.com>
* @license http://www.gnu.org/copyleft /gpl.html GNU GPL v3 ou version ultérieure
*/

defined ('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'NOTE MY PROGRESS';

/* Global */
$string['pagination'] = 'Semaine:';
$string['graph_generating'] = 'Nous construisons le rapport, veuillez patienter un instant.';
$string['weeks_not_config'] = 'Le cours n \' a pas été configuré par l \'enseignant, il n\' y a donc aucune visualisation à afficher. ';
$string['pagination_title'] = 'Sélection de la semaine';
$string['helplabel'] = 'Aide';
$string['exitbutton'] = 'OK!';
$string['no_data'] = 'Il n\'y a aucune donnée à afficher';
$string['only_student'] = 'Ce rapport est réservé aux étudiants';
$string["fml_send_mail"] = "(Cliquez pour envoyer un e-mail)";
$string["fml_about"] = "À propos de ce graphique";
$string["fml_about_table"] = "À propos de cette table";
$string["fml_not_configured"] = "Non configuré";
$string["fml_activated"] = "Activé";
$string["fml_disabled"] = "Désactivé";

/* Menu */
$string['menu_main_title'] = "Progression du tableau de bord";
$string['menu_sessions'] = 'Sessions d\'étude';
$string['menu_setweek'] = "Définir les semaines";
$string['menu_time'] = 'Suivi du temps';
$string['menu_assignments'] = 'Suivi des affectations';
$string['menu_grades'] = 'Suivi des notes';
$string['menu_quiz'] = 'Suivi des évaluations';
$string['menu_dropout'] = 'Abandon';
$string['menu_logs'] = "Journaux d'activités";
$string['menu_general'] = "Indicateurs généraux";

/* Nav Bar Menu */
$string['togglemenu'] = 'Afficher / Masquer le menu FML';

/* Composant de pagination */
$string['pagination_component_to'] = 'al';
$string['pagination_component_name'] = 'Semaine';

/* Goups */
$string['group_allstudent'] = 'Tous les étudiants';

/* Erreurs générales */
$string['api_error_network'] = "Une erreur s'est produite lors de la communication avec le serveur.";
$string['api_invalid_data'] = 'Données incorrectes';
$string['api_save_successful'] = 'Les données ont été correctement enregistrées sur le serveur';
$string['api_cancel_action'] = 'Vous avez annulé l \' action ';

/* Admin Task Screen */
$string['generate_data_task'] = 'Processus de génération de données pour Flip my Learning Plugin';

/* Graphique */
$string['chart_loading'] = 'Chargement ...';
$string['chart_exportButtonTitle'] = "Exporter";
$string['chart_printButtonTitle'] = "Imprimer";
$string['chart_rangeSelectorFrom'] = "De";
$string['chart_rangeSelectorTo'] = "Jusqu'à";
$string['chart_rangeSelectorZoom'] = "Plage";
$string['chart_downloadPNG'] = 'Télécharger une image PNG';
$string['chart_downloadJPEG'] = 'Télécharger une image JPEG';
$string['chart_downloadPDF'] = 'Télécharger le document PDF';
$string['chart_downloadSVG'] = 'Télécharger l\'image SVG';
$string['chart_downloadCSV'] = 'Télécharger CSV';
$string['chart_downloadXLS'] = 'Télécharger XLS';
$string['chart_exitFullscreen'] = 'Quitter le plein écran';
$string['chart_hideData'] = 'Masquer la table de données';
$string['chart_noData'] = 'Il n \' y a aucune donnée à afficher ';
$string['chart_printChart'] = 'Imprimer le graphique';
$string['chart_viewData'] = 'Afficher la table de données';
$string['chart_viewFullscreen'] = 'Afficher en plein écran';
$string['chart_resetZoom'] = 'Redémarrer le zoom';
$string['chart_resetZoomTitle'] = 'Réinitialiser le niveau de zoom 1: 1';

/* Définir les semaines */
$string['setweeks_title'] = 'Définition des semaines de cours';
$string['setweeks_description'] = 'Pour commencer, vous devez configurer le cours par semaines et définir une date de début pour la première semaine (le reste des semaines se déroulera automatiquement à partir de cette date. Ensuite, vous devez associer les activités ou des modules liés à chaque semaine en les faisant glisser de la colonne de droite vers la semaine correspondante. Il n\'est pas nécessaire d\'affecter toutes les activités ou modules aux semaines, mais uniquement celles que vous souhaitez envisager pour suivre les étudiants. Enfin, vous devez cliquez sur le bouton Enregistrer pour conserver vos paramètres. ';
$string[' setweeks_sections '] = "Sections disponibles dans le cours";
$string[' setweeks_weeks_of_course '] = "Planification des semaines";
$string[' setweeks_add_new_week '] = "Ajouter une semaine";
$string['setweeks_start'] = "Start:";
$string['setweeks_end'] = "End:";
$string['setweeks_week'] = "Week";
$string['setweeks_save'] = "Enregistrer la configuration";
$string['setweeks_time_dedi cation '] = "Combien d\'heures de travail attendez-vous que les étudiants consacrent à votre cours cette semaine?";
$string['setweeks_enable_scroll'] = "Activer le mode de défilement pour les semaines et les thèmes";
$string['setweeks_label_section_removed'] = "Retiré du cours";
$string['setweeks_error_section_removed'] = "Une section affectée à une semaine a été supprimée du cours, vous devez la supprimer de votre horaire pour continuer.";
$string['setweeks_save_warning_title'] = "Êtes-vous sûr de vouloir enregistrer les modifications?";
$string['setweeks_save_warning_content'] = "Si vous modifiez la configuration des semaines où le cours a déjà commencé, des données peuvent être perdues ...";
$string['setweeks_confirm_ok'] = "Enregistrer";
$string['setweeks_confirm_cancel'] = "Annuler";
$string['setweeks_error_empty_week'] = "Vous ne pouvez pas enregistrer les modifications avec une semaine vide. Veuillez le supprimer et réessayer.";
$string['setweeks_new_group_title'] = "Nouvelle instance de configuration";
$string['setweeks_new_group_text'] = "Nous avons détecté que votre cours est terminé, si vous souhaitez configurer les semaines pour travailler avec de nouveaux étudiants, vous devez activer le bouton ci-dessous. Cela séparera les données des étudiants actuels de celles des précédents cours, en évitant de les mélanger. ";
$string['setweeks_new_group_button_label'] = "Enregistrer la configuration en tant que nouvelle instance";
$string['course_format_weeks'] = 'Semaine';
$string['course_format_topics'] = 'Sujet';
$string['course_format_social'] = 'Social';
$string['course_format_singleactivity'] = 'Activité unique';
$string['plugin_requirements_title'] = 'Statut:';
$string['plugin_requirements_descriptions'] = 'Le plugin sera visible et affichera les rapports pour les étudiants et les enseignants lorsque les conditions suivantes sont remplies ...';
$string['plugin_requirements_has_users'] = 'Le cours doit avoir au moins un étudiant inscrit';
$string['plugin_requirements_course_start'] = 'La date actuelle doit être postérieure à la date de début de la première semaine configurée.';
$string['plugin_requirements_has_sections'] = 'Les semaines configurées ont au moins une section.';
$string['plugin_visible'] = 'Rapports visibles.';
$string['plugin_hidden'] = 'Rapports masqués.';
$string['title_conditions'] = 'Conditions d \' utilisation ';

/* Heure */
$string['fml_mon'] = 'Lundi';
$string['fml_tue'] = 'Mardi';
$string['fml_wed'] = 'Mercredi';
$string['fml_thu'] = 'Jeudi';
$string['fml_fri'] = 'Vendredi';
$string['fml_sat'] = 'Samedi';
$string['fml_sun'] = 'Dimanche';
$string['fml_mon_short'] = 'Lun';
$string['fml_tue_short'] = 'Mar';
$string['fml_wed_short'] = 'Mer';
$string['fml_thu_short'] = 'Jeu';
$string['fml_fri_short'] = 'Ven';
$string['fml_sat_short'] = 'Sat';
$string['fml_sun_short'] = 'Soleil';

$string['fml_jan'] = 'Janvier';
$string['fml_feb'] = 'Février';
$string['fml_mar'] = 'Mars';
$string['fml_apr'] = 'Avril';
$string['fml_may'] = 'Mai';
$string['fml_jun'] = 'Juin';
$string['fml_jul'] = 'Juillet';
$string['fml_aug'] = 'Août';
$string['fml_sep'] = 'Septembre';
$string['fml_oct'] = 'Octobre';
$string['fml_nov'] = 'Novembre';
$string['fml_dec'] = 'Décembre';
$string['fml_jan_short'] = 'Jan';
$string['fml_feb_short'] = 'Fév';
$string['fml_mar_short'] = 'Mar';
$string['fml_apr_short'] = 'Apr';
$string['fml_may_short'] = 'Mai';
$string['fml_jun_short'] = 'Juin';
$string['fml_jul_short'] = 'Juil';
$string['fml_aug_short'] = 'Août';
$string['fml_sep_short'] = 'Sep';
$string['fml_oct_short'] = 'Oct';
$string['fml_nov_short'] = 'Nov';
$string['fml_dec_short'] = 'Déc';

$string['fml_week1'] = 'Sem 1';
$string['fml_week2'] = 'Sem 2';
$string['fml_week3'] = 'Sem 3';
$string['fml_week4'] = 'Sem 4';
$string['fml_week5'] = 'Sem 5';
$string['fml_week6'] = 'Sem 6';

$string['fml_00'] = '00h';
$string['fml_01'] = '01h';
$string['fml_02'] = '02h';
$string['fml_03'] = '03h';
$string['fml_04'] = '04h';
$string['fml_05'] = '05h';
$string['fml_06'] = '06h';
$string['fml_07'] = '07h';
$string['fml_08'] = '08h';
$string['fml_09'] = '09h';
$string['fml_10'] = '10h';
$string['fml_11'] = '11h';
$string['fml_12'] = '12h';
$string['fml_13'] = '13h';
$string['fml_14'] = '14h';
$string['fml_15'] = '15h';
$string['fml_16'] = '16h';
$string['fml_17'] = '17h';
$string['fml_18'] = '18h';
$string['fml_19'] = '19h';
$string['fml_20'] = '20h';
$string['fml_21'] = '21h';
$string['fml_22'] = '22h';
$string['fml_23'] = '23h';

/* Enseignant général */
$string['tg_section_help_title'] = 'Indicateurs généraux';
$string['tg_section_help_description'] = 'Cette section contient des visualisations avec des indicateurs généraux liés à la configuration du cours, les ressources attribuées par semaines, les sessions d\'étude et les progrès des étudiants tout au long du cours.

//Les affichages de cette section montrent les indicateurs de la date de début à la fin du cours (ou à la date actuelle si le cours n\'est pas encore terminé). ';
$string['tg_week_resources_help_title'] = 'Ressources par semaines';
$string['tg_week_resources_help_description_p1'] = 'Ce graphique affiche la quantité de ressources pour chacune des sections de cours affectées à chaque semaine d\'étude configurée dans la section <i> Configurer les semaines </i>. Si deux sections de cours ou plus sont attribuées à une semaine, les ressources de ces sections sont additionnées pour calculer le total des ressources pour une semaine. ';
$string['tg_week_resources_help_description_p2'] = 'Sur l\' axe des x du graphique se trouvent les ressources et activités totales des sections affectées à chaque semaine configurée de Flip My Learning. Sur l’axe des y figurent les semaines d’étude configurées. ';
$string['tg_weeks_sessions_help_title'] = 'Sessions par semaine';
$string['tg_week_sessions_help_description_p1'] = 'Ce graphique montre le nombre de sessions d \' étude complétées par les étudiants chaque semaine à partir de la date de début du cours. L\'accès au cours par l\'étudiant est considéré comme le début d\'une session d\'étude. Une session est considérée comme terminée lorsque le temps entre deux interactions d\'un élève dépasse 30 minutes. ';
$string['tg_week_sessions_help_description_p2'] = 'Sur l \' axe des x du graphique se trouvent les semaines de chaque mois. l\'axe des y du graphique montre les différents mois de l\'année à partir du mois de création du cours. Pour maintenir la symétrie du graphique, un total de cinq semaines a été placé pour chaque mois, cependant, chaque mois ne compte pas autant de semaines. Ces mois n’ajouteront que des sessions jusqu’à la quatrième semaine.';
$string['tg_progress_table_help_title'] = 'Progression des étudiants';
$string['tg_progress_table_help_description'] = 'Ce tableau montre une liste de tous les étudiants inscrits au cours avec leur progression, le nombre de sessions et le temps passé. Pour calculer la progression, toutes les ressources du cours ont été prises en compte, à l\'exception de celles de type <i> Label </i>. Pour déterminer si un étudiant a terminé une ressource, il est d\'abord vérifié pour voir si le paramètre d\'exhaustivité de la ressource est activé. Si tel est le cas, il est recherché si l\'élève a déjà terminé l\'activité basée sur cette configuration. Sinon, l’activité est considérée comme terminée si l’élève l’a vue au moins une fois. ';

$string['fml_title'] = 'Sessions de travail';
$string['table_title'] = 'Progression du cours';
$string['thead_name'] = 'Nom';
$string['thead_lastname'] = 'Nom de famille';
$string['thead_email'] = 'Mail';
$string['thead_progress'] = 'Progression (%)';
$string['thead_sessions'] = 'Sessions';
$string['thead_time'] = 'Heure inversée';

$string['fml_module_label'] = 'ressource';
$string['fml_modules_label'] = 'ressources';
$string['fml_of_conector'] = 'de';
$string['fml_finished_label'] = 'terminé';
$string['fml_finisheds_label'] = 'terminé';

$string['fml_smaller30'] = 'Moins de 30 minutes';
$string['fml_greater30'] = 'Plus de 30 minutes';
$string['fml_greater60'] = 'Plus de 60 minutes';

$string['fml_session_count_title'] = 'Sessions de la semaine';
$string['fml_session_count_yaxis_title'] = 'Nombre de sessions';
$string['fml_session_count_tooltip_suffix'] = 'sessions';

$string['fml_hours_sessions_title'] = 'Sessions par jour et heure';
$string['fml_weeks_sessions_title'] = 'Sessions par semaine';

$string["fml_session_text"] = "session";
$string["fml_sessions_text"] = "sessions";

$string['ss_change_timezone'] = 'Fuseau horaire:';
// $string['ss_activity_inside_plataform_student'] = 'Mon activité sur la plateforme';
// $string['ss_activity_inside_plataform_teacher'] = 'Activité des étudiants sur la plateforme';
// $string['ss_time_inside_plataform_student'] = 'Mon temps sur la plateforme';
// $string['ss_time_inside_plataform_teacher'] = 'Temps moyen passé par les étudiants sur la plateforme cette semaine';
// $string['ss_time_inside_plataform_description_teacher'] = 'Temps que l’élève a investi dans la semaine sélectionnée, par rapport au temps que l’enseignant a prévu de l’investir. Le temps passé affiché correspond à la moyenne de tous les élèves. Le temps prévu par l’enseignant est le temps attribué par l’enseignant dans <i> Configurer les semaines </i>. ';
// $string['ss_time_inside_plataform_description_student'] = 'Temps passé cette semaine par rapport au temps que l’enseignant a prévu de passer.';
// $string['ss_activity_inside_plataform_description_teacher'] = 'Les heures de la journée sont indiquées sur l\'axe Y et les jours de la semaine sur l\'axe X. Dans le graphique, vous pouvez trouver plusieurs points qui, en les survolant, offrent des informations détaillées sur les interactions des étudiants, regroupées par type de ressource (nombre d\'interactions, nombre d\'étudiants qui ont interagi avec la ressource et moyenne des interactions). <br/> <br/> <b> En cliquant sur les balises, vous pourrez filtrer par type de ressource, ne laissant visibles que celles qui ne sont pas barrées. </b> ';
// $string['ss_activity_inside_plataform_description_student'] = 'Afficher les interactions par type de ressource et planification. Lorsque vous survolez un point visible du graphique, vous verrez le nombre d\'interactions regroupées par type de ressource. En cliquant sur les balises, vous pourrez filtrer par type de ressource. ';

/* Sessions de l\'enseignant */
$string['ts_section_help_title'] = 'Sessions d\'étude';
$string['ts_section_help_description'] = 'Cette section contient des visualisations avec des indicateurs liés à l’activité des étudiants dans le cours mesurée en termes de sessions effectuées, de temps moyen passé dans le cours par semaine et de sessions d’étude à intervalles de temps. Les données présentées dans cette section varient en fonction de la semaine d\'étude choisie. ';
$string['ts_inverted_time_help_title'] = 'Temps inversé des étudiants';
$string['ts_inverted_time_help_description_p1'] = 'Ce graphique montre le temps moyen passé par les étudiants dans la semaine par rapport au temps moyen prévu par le professeur.';
$string['ts_inverted_time_help_description_p2'] = 'Sur l \' axe des x du graphique se trouve le nombre d \'heures que l \' enseignant a prévu pour une semaine spécifique. Sur l’axe des y figurent les étiquettes du temps moyen passé et du temps moyen à passer. ';
$string['ts_hours_sessions_help_title'] = 'Sessions par jour et heure';
$string['ts_hours_sessions_help_description_p1'] = 'Ce graphique montre les sessions d \' étude par jour et heure pour la semaine sélectionnée. l\'accès au cours par l\'étudiant est considéré comme le début d\'une session d\'étude. Une session est considérée comme terminée lorsque le temps entre deux interactions d\'un élève dépasse 30 minutes. ';
$string['ts_hours_sessions_help_description_p2'] = 'Sur l \' axe des x du graphique se trouvent les jours de la semaine. Sur l’axe des y figurent les heures de la journée commençant à 12 h 00 et se terminant à 23 h 00 ou 23 h 00. ';
$string['ts_sessions_count_help_title'] = 'Sessions de la semaine';
$string['ts_sessions_count_help_description_p1'] = 'Ce graphique montre le nombre de sessions classées par durée dans des plages horaires: moins de 30 minutes, plus de 30 minutes et plus de 60 minutes. l\'accès au cours par l\'étudiant est considéré comme le début d\'une session d\'étude. Une session est considérée comme terminée lorsque le temps entre deux interactions d\'un élève dépasse 30 minutes. ';
$string['ts_sessions_count_help_description_p2'] = 'Sur l \' axe des x du graphique se trouvent les jours de la semaine configurés. Sur l’axe des y figure le nombre de sessions effectuées. ';

$string['fml_time_inverted_title'] = 'Temps investi par les étudiants';
$string['fml_time_inverted_x_axis'] = 'Nombre d\'heures';
$string['fml_inverted_time'] = 'Temps moyen inversé';
$string['fml_expected_time'] = 'Durée moyenne à inverser';

$string['fml_year'] = 'année';
$string['fml_years'] = 'années';
$string['fml_month'] = 'mois';
$string['fml_months'] = 'mois';
$string['fml_day'] = 'jour';
$string['fml_days'] = 'jours';
$string['fml_hour'] = 'heure';
$string['fml_hours'] = 'heures';
$string['fml_hours_short'] = 'h';
$string['fml_minute'] = 'minute';
$string['fml_minutes'] = 'minutes';
$string['fml_minutes_short'] = 'm';
$string['fml_second'] = 'second';
$string['fml_seconds'] = 'secondes';
$string['fml_seconds_short'] = 's';
$string['fml_ago'] = 'retour';
$string['fml_now'] = 'juste maintenant';

/*Devoirs des enseignants */

$string['ta_section_help_title'] = 'Suivi des devoirs';
$string['ta_section_help_description'] = 'Cette section contient des indicateurs liés à la livraison des tâches et à l \' accès aux ressources. Les données présentées dans cette section varient en fonction de la semaine d\'étude choisie. ';
$string['ta_assigns_submissions_help_title'] = 'Soumissions de devoirs';
$string['ta_assigns_submissions_help_description_p1'] = 'Ce graphique montre la distribution du nombre d\'étudiants, par rapport à l\'état de livraison d\'un devoir.';
$string['ta_assigns_submissions_help_description_p2'] = 'Sur l \' axe des x du graphique se trouvent les tâches des sections assignées à la semaine avec la date et l \'heure de livraison. Sur l\'axe des y se trouve la distribution du nombre d\'étudiants en fonction du statut de livraison. Le graphique a la possibilité d\'envoyer un e-mail aux étudiants dans une certaine distribution (livraison à temps, livraison tardive, pas de livraison) en cliquant sur le graphique. ';
$string['ta_access_content_help_title'] = 'Accès au contenu

du cours ';
$string['ta_access_content_help_description_p1'] = 'Ce graphique montre le nombre d\'étudiants qui ont accédé et n\'ont pas accédé aux ressources du cours. En haut se trouvent les différents types de ressources Moodle, avec la possibilité de filtrer les informations du graphe en fonction du type de ressource sélectionné. ';
$string['ta_access_content_help_description_p2'] = 'L \' axe des x du graphique montre le nombre d \'étudiants inscrits au cours. l\'axe des y du graphique montre les ressources des sections affectées à la semaine. De plus, ce graphique vous permet d’envoyer un e-mail aux étudiants qui ont accédé à la ressource ou à ceux qui n’y ont pas accédé en cliquant sur le graphique. ';

/* Assign Submissions */
$string['fml_intime_sub'] = 'Soumissions à temps';
$string['fml_late_sub'] = 'Soumissions tardives';
$string['fml_no_sub'] = 'Aucune soumission';
$string['fml_assign_nodue'] = 'Pas de date limite';
$string['fml_assignsubs_title'] = 'Soumissions de devoirs';
$string['fml_assignsubs_yaxis'] = 'Nombre d\'étudiants';


/* Accès au contenu */
$string['fml_assign'] = 'Tâche';
$string['fml_assignment'] = 'Tâche';
$string['fml_attendance'] = 'Participation';
$string['fml_book'] = 'Livre';
$string['fml_chat'] = 'Chatter';
$string['fml_choice'] = 'Choix';
$string['fml_data'] = 'Base de données';
$string['fml_feedback'] = 'Commentaires';
$string['fml_folder'] = 'Dossier';
$string['fml_forum'] = 'Forum';
$string['fml_glossary'] = 'Glossaire';
$string['fml_h5pactivity'] = 'H5P';
$string['fml_imscp'] = 'Contenu IMS';
$string['fml_label'] = 'Label';
$string['fml_lesson'] = 'Leçon';
$string['fml_lti'] = 'Contenu IMS';
$string['fml_page'] = 'Page';
$string['fml_quiz'] = 'Quiz';
$string['fml_resource'] = 'Ressource';
$string['fml_scorm'] = 'Package SCORM';
$string['fml_survey'] = 'Sondage';
$string['fml_url'] = 'Url';
$string['fml_wiki'] = 'Wiki';
$string['fml_workshop'] = 'Atelier';

$string['fml_access'] = 'Accès';
$string['fml_no_access'] = 'Aucun accès';
$string['fml_access_chart_title'] = 'Accès au contenu du cours';
$string['fml_access_chart_yaxis_label'] = 'Nombre d\'étudiants';
$string['fml_access_chart_suffix'] = 'étudiants';


/* Email */
$string['fml_validation_subject_text'] = 'Le sujet est obligatoire';
$string['fml_validation_message_text'] = 'Un message est requis';
$string['fml_subject_label'] = 'Ajouter un sujet';
$string['fml_message_label'] = 'Ajouter un message';

$string['fml_submit_button'] = 'Soumettre';
$string['fml_cancel_button'] = 'Annuler';
$string['fml_close_button'] = 'Fermer';
$string['fml_emailform_title'] = 'Envoyer un e-mail';
$string['fml_sending_text'] = 'Envoi de courriels';

$string['fml_recipients_label'] = 'À';
$string['fml_mailsended_text'] = 'Emails envoyés';

$string['fml_email_footer_text'] = 'Ceci est un email envoyé avec Fliplearning.';
$string['fml_email_footer_prefix'] = 'Aller à';
$string['fml_email_footer_suffix'] = 'pour plus d\'informations.';
$string['fml_mailsended_text'] = 'Emails envoyés';

$string['fml_assign_url'] = '/mod/assign/view.php?id=';
$string['fml_assignment_url'] = '/mod/assignment/view.php?id=';
$string['fml_book_url'] = '/mod/book/view.php?id=';
$string['fml_chat_url'] = '/mod/chat/view.php?id=';
$string['fml_choice_url'] = '/mod/choice/view.php?id=';
$string['fml_data_url'] = '/mod/data/view.php?id=';
$string['fml_feedback_url'] = '/mod/feedback/view.php?id=';
$string['fml_folder_url'] = '/mod/folder/view.php?id=';
$string['fml_forum_url'] = '/mod/forum/view.php?id=';
$string['fml_glossary_url'] = '/mod/glossary/view.php?id=';
$string['fml_h5pactivity_url'] = '/mod/h5pactivity/view.php?id=';
$string['fml_imscp_url'] = '/mod/imscp/view.php?id=';
$string['fml_label_url'] = '/mod/label/view.php?id=';
$string['fml_lesson_url'] = '/mod/lesson/view.php?id=';
$string['fml_lti_url'] = '/mod/lti/view.php?id=';
$string['fml_page_url'] = '/mod/page/view.php?id=';
$string['fml_quiz_url'] = '/mod/quiz/view.php?id=';
$string['fml_resource_url'] = '/mod/resource/view.php?id=';
$string['fml_scorm_url'] = '/mod/scorm/view.php?id=';
$string['fml_survey_url'] = '/mod/survey/view.php?id=';
$string['fml_url_url'] = '/mod/url/view.php?id=';
$string['fml_wiki_url'] = '/mod/wiki/view.php?id=';
$string['fml_workshop_url'] = '/mod/workshop/view.php?id=';
$string['fml_course_url'] = '/course/view.php?id=';


/* Évaluation de l\'enseignant */
$string['tr_section_help_title'] = 'Suivi des notes';
$string['tr_section_help_description'] = 'Cette section contient des indicateurs liés aux moyennes des notes dans les activités évaluables. Les différentes unités d\'enseignement (Catégories de Qualification) créées par l\'enseignant sont affichées dans le sélecteur <i> Catégorie de Qualification </i>. Ce sélecteur vous permettra de basculer entre les différentes unités définies et de montrer les activités qui peuvent être évaluées dans chacune. ';
$string['tr_grade_items_average_help_title'] = 'Moyenne des activités évaluables';
$string['tr_grade_items_average_help_description_p1'] = 'Ce graphique présente la moyenne (en pourcentage) des notes des étudiants dans chacune des activités évaluables du cours. La moyenne en pourcentage est calculée en fonction de la note maximale de l\'activité évaluable (exemple: une activité évaluable avec un score maximum de 80 et une note moyenne de 26 présentera une barre d\'une hauteur égale à 33%, puisque 26 est 33% de la note totale). La moyenne pondérée cumulative a été exprimée en fonction de pourcentages afin de préserver la symétrie du graphique, car Moodle vous permet de créer des activités et d’attribuer des notes personnalisées. ';
$string['tr_grade_items_average_help_description_p2'] = 'Sur l \' axe des x du graphique se trouvent les différentes activités évaluables du cours. Sur l’axe des y se trouve la moyenne pondérée exprimée en pourcentage. ';
$string['tr_grade_items_average_help_description_p3'] = 'En cliquant sur la barre correspondant à une activité évaluable, les données des deux graphiques inférieurs seront mises à jour pour afficher des informations supplémentaires sur l\'activité évaluable sélectionnée.';
$string['tr_item_grades_details_help_title'] = 'Meilleure, pire et moyenne';
$string['tr_item_grades_details_help_description_p1'] = 'Ce graphique montre la meilleure note, la note moyenne et la pire note pour une activité évaluable (l’activité sélectionnée dans le tableau des activités évaluables moyennes).';
$string['tr_item_grades_details_help_description_p2'] = 'Sur l \' axe des x du graphique se trouve le score de la note d \'activité, la note maximale de l \' activité étant la valeur maximale sur cet axe. Sur l’axe des y figurent les libellés de la meilleure note, de la note moyenne et de la pire note. ';
$string['tr_item_grades_distribution_help_title'] = 'Répartition des notes';
$string['tr_item_grades_distribution_help_description_p1'] = 'Ce graphique montre la répartition des élèves dans différentes gammes de notes. Les gammes de notes sont calculées en fonction de pourcentages. Les plages suivantes sont prises en compte: moins de 50%, plus de 50%, plus de 60%, plus de 70%, plus de 80% et plus de 90%. Ces fourchettes sont calculées en fonction du poids maximum que l\'enseignant attribue à une activité évaluable. ';
$string['tr_item_grades_distribution_help_description_p2'] = 'Sur l \' axe des x se trouvent les plages de notes d \'activité. Sur l’axe des y figure le nombre d’élèves appartenant à un certain rang. ';
$string['tr_item_grades_distribution_help_description_p3'] = 'En cliquant sur la barre correspondant à un rang, vous pouvez envoyer un email aux étudiants dans le classement.';

/* Notes */
$string['fml_grades_select_label'] = 'Catégorie de note';
$string['fml_grades_chart_title'] = 'Moyennes des activités évaluables';
$string['fml_grades_yaxis_title'] = 'Note moyenne (%)';
$string['fml_grades_tooltip_average'] = 'Note moyenne';
$string['fml_grades_tooltip_grade'] = 'Note maximale';
$string['fml_grades_tooltip_student'] = 'étudiant noté de';
$string['fml_grades_tooltip_students'] = 'élèves notés de';

$string['fml_grades_best_grade'] = 'Meilleure note';
$string['fml_grades_average_grade'] = 'Note moyenne';
$string['fml_grades_worst_grade'] = 'Pire note';
$string['fml_grades_details_subtitle'] = 'Meilleure, pire et moyenne';

$string['fml_grades_distribution_subtitle'] = 'Répartition des notes';
$string['fml_grades_distribution_greater_than'] = 'supérieur à';
$string['fml_grades_distribution_smaller_than'] = 'inférieur à';
$string['fml_grades_distribution_yaxis_title'] = 'Nombre d\'étudiants';
$string['fml_grades_distribution_tooltip_prefix'] = 'Plage';
$string['fml_grades_distribution_tooltip_suffix'] = 'dans cette plage';
$string["fml_view_details"] = "(Cliquez pour voir les détails)";


/* Quiz enseignant */
$string['tq_section_help_title'] = 'Suivi des évaluations';
$string['tq_section_help_description'] = 'Cette section contient des indicateurs liés au résumé des tentatives dans les différentes évaluations du cours et à l \' analyse des questions d \'une évaluation. Les données présentées dans cette section varient en fonction de la semaine d\'étude sélectionnée et d\'un sélecteur contenant toutes les activités de type Evaluation des sections de cours affectées à la semaine sélectionnée. ';
$string['tq_questions_attempts_help_title'] = 'Tentatives de questions';
$string['tq_questions_attempts_help_description_p1'] = 'Ce graphique montre la distribution des tentatives de résolution pour chaque question dans une évaluation ainsi que leur statut de révision.';
$string['tq_questions_attempts_help_description_p2'] = 'Sur l \' axe des x du graphique se trouvent les questions d \'évaluation. l\'axe des y montre le nombre de tentatives de résolution pour chacune de ces questions. La symétrie du graphique sera affectée par les paramètres d\'évaluation (exemple: dans une évaluation qui comporte toujours les mêmes questions, le graphique présentera le même nombre de tentatives pour chaque barre correspondant à une question. Dans une évaluation comportant des questions aléatoires ( d\'une banque de questions), le graphique présentera dans la barre de chaque question la somme des tentatives d\'évaluation dans lesquelles elle est apparue, et peut ne pas être la même pour chaque question d\'évaluation). ';
$string['tq_questions_attempts_help_description_p3'] = 'En cliquant sur l \' une des barres correspondant à une question, il est possible de voir la question d \'évaluation dans une fenêtre pop-up.';
$string['tq_hardest_questions_help_title'] = 'Questions plus difficiles';
$string['tq_hardest_questions_help_description_p1'] = 'Ce graphique montre les questions d’évaluation classées par niveau de difficulté. Une tentative de résolution d\'une question avec le statut Partiellement correct, incorrect ou vide est considérée comme incorrecte, de sorte que le nombre total de tentatives incorrectes d\'une question est la somme des tentatives avec les statuts susmentionnés. Le niveau de difficulté est représenté sous forme de pourcentage calculé sur la base du nombre total de tentatives. ';
$string['tq_hardest_questions_help_description_p2'] = 'Sur l \' axe des x du graphique se trouvent les questions d \'évaluation identifiées par leur nom. l\'axe des y montre le pourcentage de tentatives incorrectes par rapport au nombre total de tentatives pour la question. Cet axe permet d\'identifier les questions qui ont représenté la plus grande difficulté pour les étudiants qui ont passé l\'évaluation. ';
$string['tq_hardest_questions_help_description_p3'] = 'En cliquant sur l \' une des barres correspondant à une question, il est possible de voir la question d \'évaluation dans une fenêtre pop-up.';

$string["fml_quiz_info_text"] = "Cette évaluation a";
$string["fml_question_text"] = "question";
$string["fml_questions_text"] = "questions";
$string["fml_doing_text_singular"] = "tentative faite par";
$string["fml_doing_text_plural"] = "tentatives faites par";
$string["fml_attempt_text"] = "tentative";
$string["fml_attempts_text"] = "tentatives";
$string["fml_student_text"] = "étudiant";
$string["fml_students_text"] = "étudiants";
$string["fml_quiz"] = "Évaluations";
$string["fml_questions_attempts_chart_title"] = "Tentatives de questions";
$string["fml_questions_attempts_yaxis_title"] = "Nombre de tentatives";
$string["fml_hardest_questions_chart_title"] = "Questions plus difficiles";
$string["fml_hardest_questions_yaxis_title"] = "Tentatives incorrectes";
$string["fml_correct_attempt"] = "Correct";
$string["fml_partcorrect_attempt"] = "Partiellement correct";
$string["fml_incorrect_attempt"] = "Incorrect";
$string["fml_blank_attempt"] = "Vide";
$string["fml_needgraded_attempt"] = "Non noté";
$string["fml_review_question"] = "(Cliquez pour revoir la question)";


/* Abandon */
$string['td_section_help_title'] = 'Abandon';
$string['td_section_help_description'] = 'Cette section contient des indicateurs liés à la prédiction du décrochage des étudiants dans un cours. Les informations sont affichées en fonction de groupes d\'étudiants calculés par un algorithme qui analyse le comportement de chaque élève en fonction du temps investi, du nombre de sessions d\'étudiants, du nombre de jours d\'activité et des interactions qu\'ils ont faites avec chaque ressource et avec l\'autre étudiants dans le cours. l\'algorithme place les étudiants ayant un comportement similaire dans le même groupe, afin que les étudiants qui sont de plus en moins engagés dans le cours puissent être identifiés. Les données présentées dans cette section varient en fonction du groupe sélectionné dans le sélecteur qui contient les groupes identifiés dans le cours. ';
$string['td_group_students_help_title'] = 'Regrouper les étudiants';
$string['td_group_students_help_description_p1'] = 'Dans ce tableau se trouvent les étudiants appartenant au groupe sélectionné dans le sélecteur de groupe d\'étudiants. La photo de chaque élève, les noms et le pourcentage de progression dans le cours sont répertoriés. Pour le calcul de la progression, toutes les ressources du cours ont été prises en compte, à l\'exception de celles de type Label. Pour déterminer si un étudiant a terminé une ressource, il est d\'abord vérifié pour voir si le paramètre d\'exhaustivité de la ressource est activé. Si tel est le cas, il est recherché si l\'élève a déjà terminé l\'activité basée sur cette configuration. Sinon, l’activité est considérée comme terminée si l’élève l’a vue au moins une fois. ';
$string['td_group_students_help_description_p2'] = 'Cliquer sur un élève dans ce tableau mettra à jour les graphiques ci-dessous avec les informations de l\'élève sélectionné.';
$string['td_modules_access_help_title'] = 'Ressources du cours';
$string['td_modules_access_help_description_p1'] = 'Ce graphique montre la quantité de ressources auxquelles l\'étudiant a accédé et complété. Les données présentées dans ce graphique varient en fonction de l\'élève sélectionné dans le tableau des étudiants du groupe. Pour déterminer la quantité de ressources et terminer les activités, la configuration Moodle appelée Achèvement des activités est utilisée. Si l\'enseignant ne fait pas la configuration d\'exhaustivité des activités du cours, le nombre d\'activités accédées et terminées sera toujours le même, car sans une telle configuration, une ressource est considérée comme terminée lorsque l\'étudiant y accède. ';
$string['td_modules_access_help_description_p2'] = 'Sur l \' axe des x se trouve la quantité de ressources du cours. Sur l’axe des y figurent les libellés des ressources consultées, complètes et totales du cours. ';
$string['td_modules_access_help_description_p3'] = 'En cliquant sur n\'importe quelle barre, il est possible de voir les ressources et activités disponibles dans le cours (dans une fenêtre pop-up) ainsi que le nombre d\'interactions des étudiants avec chaque ressource et une étiquette de non consulté, consulté ou terminé. ';
$string['td_week_modules_help_title'] = 'Ressources par semaines';
$string['td_week_modules_help_description_p1'] = 'Ce graphique montre la quantité de ressources auxquelles l\'étudiant a accédé et complété pour chacune des semaines configurées dans le plugin. Les données présentées dans ce graphique varient en fonction de l’élève sélectionné dans le tableau <i> Groupe d’étudiants </i>. ';
$string['td_week_modules_help_description_p2'] = 'Sur l \' axe des x du graphique se trouvent les différentes semaines d \'étude configurées. L’axe des y montre la quantité de ressources et d’activités consultées et réalisées par l’élève. ';
$string['td_week_modules_help_description_p3'] = 'En cliquant sur n\'importe quelle barre, il est possible de voir les ressources et activités disponibles dans le cours (dans une fenêtre pop-up) ainsi que le nombre d\'interactions des étudiants avec chaque ressource et une étiquette de non consulté, consulté ou terminé. ';
$string['td_sessions_evolution_help_title'] = 'Sessions et temps passé';
$string['td_sessions_evolution_help_description_p1'] = 'Ce graphique montre comment les sessions d\'étude ont évolué depuis que votre première session a été enregistrée dans le cours. Les données présentées dans ce graphique varient en fonction de l’élève sélectionné dans le tableau <i> Groupe d’étudiants </i>. ';
$string['td_sessions_evolution_help_description_p2'] = 'L \' axe des x du graphique montre une chronologie avec les jours qui se sont écoulés depuis que l \'étudiant a fait la première session d \' étude jusqu\'au jour de la dernière session enregistrée. Sur l\'axe des y, ils affichent 2 valeurs, sur le côté gauche le nombre de sessions d\'étudiants et sur le côté droit le temps passé en heures. Entre ces axes, le nombre de sessions et le temps investi de l\'étudiant sont tirés comme une série de temps. ';
$string['td_sessions_evolution_help_description_p3'] = 'Cette visualisation vous permet de zoomer sur une région sélectionnée. Cette approche permet de montrer clairement cette évolution dans différentes plages de dates. ';
$string['td_user_grades_help_title'] = 'Notes';
$string['td_user_grades_help_description_p1'] = 'Ce graphique montre une comparaison des notes de l \' élève avec les moyennes des notes (moyenne en pourcentage) de leurs pairs dans les différentes activités évaluables du cours. Les données présentées dans ce graphique varient en fonction de l’élève sélectionné dans le tableau <i> Groupe d’étudiants </i>. ';
$string['td_user_grades_help_description_p2'] = 'Les différentes activités évaluables sont affichées sur l \' axe des x du graphique. Sur l\'axe des y se trouvent la note de l\'élève et la note moyenne de ses pairs. La note de l\'étudiant et la moyenne du cours sont affichées sous forme de pourcentage pour maintenir la symétrie du graphique. ';
$string['td_user_grades_help_description_p3'] = 'Avec un clic sur la barre correspondant à une activité, il est possible d \' aller à ladite analysée. ';

$string["fml_cluster_label"] = "Groupe";
$string["fml_cluster_select"] = "Groupe d\'étudiants";
$string["fml_dropout_table_title"] = "Étudiants du groupe";
$string["fml_dropout_see_profile"] = "Afficher le profil";
$string["fml_dropout_user_never_access"] = "Jamais accédé";
$string["fml_dropout_student_progress_title"] = "Progression de l\'élève";
$string["fml_dropout_student_grade_title"] = "Note";
$string['fml_dropout_no_data'] = "Il n'y a pas encore de données d\'abandon pour ce cours";
$string['fml_dropout_no_users_cluster'] = "Il n'y a aucun étudiant dans ce groupe";
$string['fml_dropout_generate_data_manually'] = "Générer manuellement";
$string['fml_dropout_generating_data'] = "Génération de données ...";
$string["fml_modules_access_chart_title"] = "Ressources du cours";
$string["fml_modules_access_chart_series_total"] = "Total";
$string["fml_modules_access_chart_series_complete"] = "Terminé";
$string["fml_modules_access_chart_series_viewed"] = "Consulté";
$string["fml_week_modules_chart_title"] = "Ressources par semaines";
$string["fml_modules_amount"] = "Quantité de ressources";
$string["fml_modules_details"] = "(Cliquez pour voir les ressources)";
$string["fml_modules_interaction"] = "interaction";
$string["fml_modules_interactions"] = "interactions";
$string["fml_modules_viewed"] = "Consulté";
$string["fml_modules_no_viewed"] = "Non consulté";
$string["fml_modules_complete"] = "Terminé";
$string["fml_sessions_evolution_chart_title"] = "Sessions et temps investi";
$string["fml_sessions_evolution_chart_xaxis1"] = "Nombre de sessions";
$string["fml_sessions_evolution_chart_xaxis2"] = "Nombre d\'heures";
$string["fml_sessions_evolution_chart_legend1"] = "Nombre de sessions";
$string["fml_sessions_evolution_chart_legend2"] = "Heure inversée";
$string["fml_user_grades_chart_title"] = "Notes";
$string["fml_user_grades_chart_yaxis"] = "Note en pourcentage";
$string["fml_user_grades_chart_xaxis"] = "Activités évaluables";
$string["fml_user_grades_chart_legend"] = "Cours (moyen)";
$string["fml_user_grades_chart_tooltip_no_graded"] = "Aucune note";
$string["fml_user_grades_chart_view_activity"] = "Cliquez pour voir l\'activité";
$string['fml_send_mail_to_user'] = 'Envoyer un e-mail à';
$string['fml_send_mail_to_group'] = 'Envoyer un e-mail au groupe';


/* Général étudiant */
$string['sg_section_help_title'] = 'Indicateurs généraux';
$string['sg_section_help_description'] = 'Cette section contient des indicateurs liés à vos informations, progrès, indicateurs généraux, ressources du cours, sessions tout au long du cours et notes obtenues. Les affichages de cette section montrent les indicateurs tout au long du cours (jusqu\'à la date actuelle). ';
$string['sg_modules_access_help_title'] = 'Ressources du cours';
$string['sg_modules_access_help_description_p1'] = 'Ce graphique montre la quantité de ressources que vous avez consultées et complétées. Pour déterminer la quantité de ressources que vous avez terminées, utilisez la configuration Moodle appelée Achèvement des activités. Si l\'enseignant n\'a pas configuré l\'exhaustivité des activités du cours, le nombre d\'activités accédées et terminées sera toujours le même, car sans une telle configuration, une ressource est considérée comme terminée lorsque vous y accédez. ';
$string['sg_modules_access_help_description_p2'] = 'Sur l \' axe des x se trouve la quantité de ressources du cours. Sur l’axe des y figurent les libellés des ressources accessibles, complètes et totales en référence à vos interactions avec les ressources du cours. ';
$string['sg_modules_access_help_description_p3'] = 'En cliquant sur n \' importe quelle barre, il est possible de voir les ressources et activités disponibles dans le cours (dans une fenêtre pop-up) ainsi que le nombre d \'interactions que vous avez faites avec chaque ressource et une étiquette non consulté, consulté ou terminé. ';
$string['sg_weeks_session_help_title'] = 'Sessions par semaine';
$string['sg_weeks_session_help_description_p1'] = 'Ce graphique montre le nombre de sessions d \' étude que vous avez suivies chaque semaine à partir de la date de début du cours. l\'accès au cours est considéré comme le début d\'une session d\'étude. Une session est considérée comme terminée lorsque le temps écoulé entre deux interactions dépasse 30 minutes. ';
$string['sg_weeks_session_help_description_p2'] = 'Sur l \' axe des x du graphique se trouvent les semaines de chaque mois. l\'axe des y du graphique montre les différents mois de l\'année à partir du mois de création du cours. Pour maintenir la symétrie du graphique, un total de cinq semaines a été placé pour chaque mois, cependant, chaque mois ne compte pas autant de semaines. Ces mois n’ajouteront que des sessions jusqu’à la quatrième semaine. ';
$string['sg_sessions_evolution_help_title'] = 'Sessions et temps investi';
$string['sg_sessions_evolution_help_description_p1'] = 'Ce graphique montre comment vos sessions d \' étude ont évolué depuis que votre première session a été inscrite au cours. ';
$string['sg_sessions_evolution_help_description_p2'] = 'L \' axe des x du graphique montre une chronologie avec les jours qui se sont écoulés depuis votre première session d \'étude jusqu\'au jour de votre dernière session enregistrée. Sur l\'axe des y, ils affichent 2 valeurs, sur le côté gauche votre nombre de sessions et sur le côté droit votre temps passé en heures. Entre ces axes, votre nombre de sessions et votre temps passé en tant qu\'étudiant sont représentés sous forme de séries chronologiques. ';
$string['sg_sessions_evolution_help_description_p3'] = 'Cette visualisation vous permet de zoomer sur une région sélectionnée.';
$string['sg_user_grades_help_title'] = 'Notes';
$string['sg_user_grades_help_description_p1'] = 'Ce graphique montre une comparaison de vos notes avec les moyennes des notes (moyenne en pourcentage) de vos camarades de classe dans les différentes activités évaluables du cours.';
$string['sg_user_grades_help_description_p2'] = 'L \' axe des x du graphique montre les différentes activités évaluables. Sur l\'axe des y, vous trouverez vos notes et la note moyenne de vos camarades de classe. Votre note et la moyenne du cours sont affichées en pourcentage pour maintenir la symétrie du graphique. ';
$string['sg_user_grades_help_description_p3'] = 'En cliquant sur la barre correspondant à une activité, il est possible d \' accéder à celle analysée. ';

/* Sessions utilisateur */
$string['ss_section_help_title'] = 'Sessions d\'étude';
$string['ss_section_help_description'] = 'Cette section contient des visualisations avec des indicateurs liés à votre activité dans le cours mesurés en termes de sessions d\'étude, de temps passé et de progression dans chacune des semaines configurées par l\'enseignant. Les affichages de cette section varient en fonction de la semaine d\'étude sélectionnée. ';
$string['ss_inverted_time_help_title'] = 'Votre temps investi';
$string['ss_inverted_time_help_description_p1'] = 'Ce graphique montre votre temps passé dans la semaine par rapport au temps prévu par le professeur.';
$string['ss_inverted_time_help_description_p2'] = 'Sur l \' axe des x du graphique se trouve le nombre d \'heures que l \' enseignant a prévu pour une semaine spécifique. Sur l’axe des y figurent les étiquettes du temps passé et du temps à y consacrer. ';
$string['ss_hours_session_help_title'] = 'Sessions par jour et heure';
$string['ss_hours_session_help_description_p1'] = 'Ce graphique montre vos sessions d \' étude par jour et heure de la semaine sélectionnée. l\'accès au cours est considéré comme le début d\'une session d\'étude. Une session est considérée comme terminée lorsque le temps écoulé entre deux interactions dépasse 30 minutes. ';
$string['ss_hours_session_help_description_p2'] = 'Sur l \' axe des x du graphique se trouvent les jours de la semaine. Sur l’axe des y figurent les heures de la journée commençant à 12h et se terminant à 23h ou 23h. ';
$string['ss_resources_access_help_title'] = 'Interaction par types de ressources';
$string['ss_resources_access_help_description_p1'] = 'Ce graphique montre combien de ressources vous avez en attente et celles que vous avez déjà complétées dans la semaine sélectionnée. Les ressources sont regroupées par type dans ce graphique. De plus, une barre s\'affiche en haut qui représente le pourcentage de ressources accédées par rapport au total des ressources affectées à la semaine sélectionnée. ';
$string['ss_resources_access_help_description_p2'] = 'Sur l \' axe des x du graphique se trouvent les différents types de ressources. L’axe des y indique la quantité de ressources consultées pour la semaine. ';
$string['ss_resources_access_help_description_p3'] = 'En cliquant sur n\'importe quelle barre, il est possible de voir les ressources et activités disponibles dans le cours (dans une fenêtre pop-up) ainsi que le nombre d\'interactions que vous avez faites avec chaque ressource et une étiquette non consulté, consulté ou terminé. ';


$string['fml_student_time_inverted_title'] = 'Votre temps investi';
$string['fml_student_time_inverted_x_axis'] = 'Nombre d\'heures';
$string['fml_student_inverted_time'] = 'Heure inversée';
$string['fml_student_expected_time'] = 'Temps à investir';

$string['fml_resource_access_title'] = 'Interaction par types de ressources';
$string['fml_resource_access_y_axis'] = 'Quantité de ressources';
$string['fml_resource_access_x_axis'] = 'Types de ressources';
$string['fml_resource_access_legend1'] = 'Terminé';
$string['fml_resource_access_legend2'] = 'En attente';

$string['fml_week_progress_title'] = 'Progrès de la semaine';



/* Indicateurs de l\'enseignant */
$string['fml_teacher_indicators_title'] = 'Indicateurs généraux';
$string['fml_teacher_indicators_students'] = 'Etudiants';
$string['fml_teacher_indicators_weeks'] = 'Semaines';
$string['fml_teacher_indicators_grademax'] = 'Grade';
$string['fml_teacher_indicators_course_start'] = 'Démarrer';
$string['fml_teacher_indicators_course_end'] = 'Fin';
$string['fml_teacher_indicators_course_format'] = 'Format';
$string['fml_teacher_indicators_course_completion'] = 'Complétude des modules';
$string["fml_teacher_indicators_student_progress"] = "Progression des élèves";
$string["fml_teacher_indicators_week_resources_chart_title"] = "Ressources par semaines";
$string["fml_teacher_indicators_week_resources_yaxis_title"] = "Quantité de ressources";

/* Logs visualisation */
$string['fml_logs_title'] = 'Télécharger les journaux d\'activités';
$string['fml_logs_help_description'] = 'Cette section vous permet de télécharger les journaux d\'activités qui ont été réalisés. C\'est-à-dire que vous avez accès aux actions qui ont été réalisées par les utilisateurs inscrits sur la plate-forme sous forme d\'un tableur.';
$string['fml_logs_title_MoodleSetpoint_title'] = 'Sélectionnez un interval de date pour les actions réalisées sur Moodle';
$string['fml_logs_title_MMPSetpoint_title'] = 'Sélectionnez un interval de date pour les actions réalisées sur Note My Progress';
$string['fml_logs_help'] = 'Cette section vous permet de télécharger un fichier de journal des activités effectuées.';
$string['fml_logs_select_date'] = 'Sélectionnez un interval de temps pour le journal';
$string['fml_logs_first_date'] = 'Date de début';
$string['fml_logs_last_date'] = 'Date de fin';
$string['fml_logs_valid_Moodlebtn'] = 'Télécharger le journal d\'activités de Moodle';
$string['fml_logs_valid_NMPbtn'] = 'Télécharger le journal d\'activités de Note My Progress';
$string['fml_logs_invalid_date'] = 'Veuillez saisir une date';
$string['fml_logs_download_btn'] = 'Téléchargement en cours';
$string['fml_logs_download_nmp_help_title'] = 'A propos des actions réalisées sur Note My Progress';
$string['fml_logs_download_moodle_help_title'] = 'A propos des actions réalisées sur Moodle';
$string['fml_logs_download_nmp_help_description'] = 'Le fichier de logs qui est téléchargé répertorie toutes les actions qui ont été réalisées par l\'utilisateur au sein du plugin Note My Progress uniquement (consultation des avancées, consultation des indicateurs généraux, etc.)';
$string['fml_logs_download_moodle_help_description'] = 'Le fichier de logs qui est téléchargé répertorie toutes les actions qui ont été réalisées par l\'utilisateur au sein de Moodle uniquement (visualisation du cours, visualisation des ressources, dépôt d\'un devoir, etc.)';
/* Logs CSV Header */
$string['fml_logs_csv_headers_username'] = 'Nom d\'utilisateur';
$string['fml_logs_csv_headers_firstname'] = 'Prénom';
$string['fml_logs_csv_headers_lastname'] = 'Nom';
$string['fml_logs_csv_headers_date'] = 'Date';
$string['fml_logs_csv_headers_hour'] = 'Heure';
$string['fml_logs_csv_headers_action'] = 'Action';
$string['fml_logs_csv_headers_coursename'] = 'Nom du cours';
$string['fml_logs_csv_headers_detail'] = 'Détail';
$string['fml_logs_csv_headers_detailtype'] = 'Type d\'objet utilisé';