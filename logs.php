<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Logs page
 *
 * @package     local_fliplearning
 * @copyright   2021 Éric Bart <eric.bart@etu.univ-tlse3.fr>, 2020 Edisson Sigua <edissonf.sigua@gmail.com>, Bryan Aguilar <bryan.aguilar6174@gmail.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once('locallib.php');
global $COURSE, $USER;

$courseid = required_param('courseid', PARAM_INT);
$course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
$context = context_course::instance($course->id);

$url = '/local/fliplearning/logs.php';
local_fliplearning_set_page($course, $url);

require_capability('local/fliplearning:usepluggin', $context);
require_capability('local/fliplearning:view_as_teacher', $context);
require_capability('local/fliplearning:logs', $context);

$actualLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$logs = new \local_fliplearning\logs($COURSE->id, $USER->id);
$logs->addLogsNMP("viewed", "section", "LOGFILES", "activity_log", $actualLink, "Section where you can consult the logs of the activities performed on the course and on the note my progress plugin");

$reports = new \local_fliplearning\teacher($COURSE->id, $USER->id);

$configweeks = new \local_fliplearning\configweeks($COURSE, $USER);
if (!$configweeks->is_set()) {
    $message = get_string("weeks_not_config", "local_fliplearning");
    print_error($message);
}

$content = [
    "courseid" => $course->id,
    "userid" => $USER->id,
    'timezone' => $reports->timezone,
    'strings' => [
        "section_help_title" => get_string("fml_logs_help_title", "local_fliplearning"),
        "section_help_description" => get_string("fml_logs_help", "local_fliplearning"),

        "title" => get_string("fml_logs_title", "local_fliplearning"),
        "description" => get_string("fml_logs_help_description", "local_fliplearning"),
        "helplabel" => get_string("helplabel","local_fliplearning"),
        "exitbutton" => get_string("exitbutton","local_fliplearning"),
        "ss_change_timezone" => get_string("ss_change_timezone", "local_fliplearning"),
        "graph_generating" => get_string("graph_generating", "local_fliplearning"),
        "about" => get_string("fml_about", "local_fliplearning"),
        "about_table" => get_string("fml_about_table", "local_fliplearning"),

        "logs_indicators_first_date" => get_string("fml_logs_first_date", "local_fliplearning"),
        "logs_indicators_last_date" => get_string("fml_logs_last_date", "local_fliplearning"),
        "logs_indicators_title_select" => get_string("fml_logs_select_date", "local_fliplearning"),
        "logs_valid_date" => get_string("fml_logs_valid_date", "local_fliplearning"),
        "logs_valid_Moodlebtn" => get_string("fml_logs_valid_Moodlebtn", "local_fliplearning"),
        "logs_valid_NMPbtn" => get_string("fml_logs_valid_NMPbtn", "local_fliplearning"),
        "logs_invalid_date" => get_string("fml_logs_invalid_date", "local_fliplearning"),
        "logs_title_MoodleSetpoint_title" => get_string("fml_logs_title_MoodleSetpoint_title", "local_fliplearning"),
        "logs_title_MMPSetpoint_title" => get_string("fml_logs_title_MMPSetpoint_title", "local_fliplearning"),
        "logs_download_btn" => get_string("fml_logs_download_btn", "local_fliplearning"),

        "logs_download_nmp_help_title" =>  get_string("fml_logs_download_nmp_help_title", "local_fliplearning"),
        "logs_download_moodle_help_title" =>  get_string("fml_logs_download_moodle_help_title", "local_fliplearning"),
        "logs_download_moodle_help_description" => get_string("fml_logs_download_moodle_help_description","local_fliplearning"),
        "logs_download_nmp_help_description" => get_string("fml_logs_download_nmp_help_description","local_fliplearning"),


        "logs_csv_headers_username" => get_string("fml_logs_csv_headers_username", "local_fliplearning"),
        "logs_csv_headers_firstname" => get_string("fml_logs_csv_headers_firstname","local_fliplearning"),
        "logs_csv_headers_lastname" => get_string("fml_logs_csv_headers_lastname","local_fliplearning"),
        "logs_csv_headers_date" =>  get_string("fml_logs_csv_headers_date","local_fliplearning"),
        "logs_csv_headers_hour" => get_string("fml_logs_csv_headers_hour","local_fliplearning"),
        "logs_csv_headers_action" => get_string("fml_logs_csv_headers_action","local_fliplearning"),
        "logs_csv_headers_coursename" => get_string("fml_logs_csv_headers_coursename","local_fliplearning"),
        "logs_csv_headers_detail" => get_string("fml_logs_csv_headers_detail","local_fliplearning"),
        "logs_csv_headers_detailtype" => get_string("fml_logs_csv_headers_detailtype","local_fliplearning"),

    ]
];

$PAGE->requires->js_call_amd('local_fliplearning/logs', 'init', ['content' => $content]);
echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_fliplearning/logs', ['content' => $content]);
echo $OUTPUT->footer();
