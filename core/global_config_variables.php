<?php

// if your folder is not in the document root please add where your document root folder is
// for example if your document root folder is C:/xampp/htdocs
// ie...  C:/xampp/htdocs
// if its not in the root it will have a file name afterwards
// ie...  C:/xampp/htdocs/ast_base_framework/
// you just need to add the file name if its not root else add nothing.
$file_root_document_folder = "ast_base_framework";





// This function will output your base website address with NO traling slash
// ie...  http://localhost   or   http:yourwebsiteaddress.com
function getTheUrl(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'];
}





// Edit your Global configurations
$GLOBALS['config'] = array(
    'mysql_local' => array(
        'host'      => 'localhost',
        'username'  => 'root',
        'password'  => '',
        'db'        => 'ast_base_framework'
    ),
    'mysql_live' => array(
        'host'      => 'localhost',
        'username'  => '',
        'password'  => '',
        'db'        => ''
    ),
    'remember' => array(
        'cookie_name'   => 'hash',
        'cookie_expiry' =>  2592000
    ),
    'session' => array(
        'session_name'  => 'user',
        'session_role'  => 'role',
        'token_name'    => 'token'
    ),
    'csrf' => array(
        'csrf_protection'   => true,
        'csrf_token_name'   => 'token'
    ),
    'site'      =>  array(
        'base_url'      =>  getTheUrl().'/'.$file_root_document_folder.'/',
        'site_url'      =>  getTheUrl().'/'.$file_root_document_folder.'/',
        'uri_protocol'  => 'REQUEST_URI',
        'base_uri'      =>  $_SERVER['DOCUMENT_ROOT'].'/'.$file_root_document_folder.'/',
        'core_folder_uri'       =>  $_SERVER['DOCUMENT_ROOT'].'/'.$file_root_document_folder.'/core/',
        'classes_folder_uri'        =>  $_SERVER['DOCUMENT_ROOT'].'/'.$file_root_document_folder.'/classes/',
        'functions_folder_uri'      =>  $_SERVER['DOCUMENT_ROOT'].'/'.$file_root_document_folder.'/functions/',
        'helpers_folder_uri'        =>  $_SERVER['DOCUMENT_ROOT'].'/'.$file_root_document_folder.'/helpers/',
        'includes_folder_uri'       =>  $_SERVER['DOCUMENT_ROOT'].'/'.$file_root_document_folder.'/inclueds/',
        'index_page'                =>  'index.php',
        'language'                  =>  'english',
        'charset'                   =>  'UTF-8',
        'url_suffix'                =>  '',
        'enable_hooks'              => FALSE,
        'permitted_uri_chars'       => 'a-z 0-9~%.:_\-',
        'log_date_format'           => 'Y-m-d H:i:s',
        'time_reference'            => 'local',
        'encryption_key'            => '',
        'enable_query_strings'      =>  FALSE,
    ),
    'date_language' => array(
        'date_year' => 'Year',
        'date_years' => 'Years',
        'date_month' => 'Month',
        'date_months' => 'Months',
        'date_week' => 'Week',
        'date_weeks' => 'Weeks',
        'date_day' => 'Day',
        'date_days' => 'Days',
        'date_hour' => 'Hour',
        'date_hours' => 'Hours',
        'date_minute' => 'Minute',
        'date_minutes' => 'Minutes',
        'date_second' => 'Second',
        'date_seconds' => 'Seconds',

        'UM12'   => '(UTC -12:00) Baker/Howland Island',
        'UM11'   => '(UTC -11:00) Niue',
        'UM10'   => '(UTC -10:00) Hawaii-Aleutian Standard Time, Cook Islands, Tahiti',
        'UM95'   => '(UTC -9:30) Marquesas Islands',
        'UM9'    => '(UTC -9:00) Alaska Standard Time, Gambier Islands',
        'UM8'    => '(UTC -8:00) Pacific Standard Time, Clipperton Island',
        'UM7'    => '(UTC -7:00) Mountain Standard Time',
        'UM6'    => '(UTC -6:00) Central Standard Time',
        'UM5'    => '(UTC -5:00) Eastern Standard Time, Western Caribbean Standard Time',
        'UM45'   => '(UTC -4:30) Venezuelan Standard Time',
        'UM4'    => '(UTC -4:00) Atlantic Standard Time, Eastern Caribbean Standard Time',
        'UM35'   => '(UTC -3:30) Newfoundland Standard Time',
        'UM3'    => '(UTC -3:00) Argentina, Brazil, French Guiana, Uruguay',
        'UM2'    => '(UTC -2:00) South Georgia/South Sandwich Islands',
        'UM1'    => '(UTC -1:00) Azores, Cape Verde Islands',
        'UTC'    => '(UTC) Greenwich Mean Time, Western European Time',
        'UP1'    => '(UTC +1:00) Central European Time, West Africa Time',
        'UP2'    => '(UTC +2:00) Central Africa Time, Eastern European Time, Kaliningrad Time',
        'UP3'    => '(UTC +3:00) Moscow Time, East Africa Time, Arabia Standard Time',
        'UP35'   => '(UTC +3:30) Iran Standard Time',
        'UP4'    => '(UTC +4:00) Azerbaijan Standard Time, Samara Time',
        'UP45'   => '(UTC +4:30) Afghanistan',
        'UP5'    => '(UTC +5:00) Pakistan Standard Time, Yekaterinburg Time',
        'UP55'   => '(UTC +5:30) Indian Standard Time, Sri Lanka Time',
        'UP575'  => '(UTC +5:45) Nepal Time',
        'UP6'    => '(UTC +6:00) Bangladesh Standard Time, Bhutan Time, Omsk Time',
        'UP65'   => '(UTC +6:30) Cocos Islands, Myanmar',
        'UP7'    => '(UTC +7:00) Krasnoyarsk Time, Cambodia, Laos, Thailand, Vietnam',
        'UP8'    => '(UTC +8:00) Australian Western Standard Time, Beijing Time, Irkutsk Time',
        'UP875'  => '(UTC +8:45) Australian Central Western Standard Time',
        'UP9'    => '(UTC +9:00) Japan Standard Time, Korea Standard Time, Yakutsk Time',
        'UP95'   => '(UTC +9:30) Australian Central Standard Time',
        'UP10'   => '(UTC +10:00) Australian Eastern Standard Time, Vladivostok Time',
        'UP105'  => '(UTC +10:30) Lord Howe Island',
        'UP11'   => '(UTC +11:00) Srednekolymsk Time, Solomon Islands, Vanuatu',
        'UP115'  => '(UTC +11:30) Norfolk Island',
        'UP12'   => '(UTC +12:00) Fiji, Gilbert Islands, Kamchatka Time, New Zealand Standard Time',
        'UP1275' => '(UTC +12:45) Chatham Islands Standard Time',
        'UP13'   => '(UTC +13:00) Samoa Time Zone, Phoenix Islands Time, Tonga',
        'UP14'   => '(UTC +14:00) Line Islands'
    )
);



