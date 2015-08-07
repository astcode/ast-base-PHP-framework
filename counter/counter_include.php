<?php
// Directory Seperator
defined("DS")
    || define("DS", DIRECTORY_SEPARATOR);

$isLive = (!checkdnsrr($_SERVER['SERVER_NAME'], 'NS')) ? true : false ;

// root path
defined("ROOT_PATH")
    || define("ROOT_PATH", realpath(dirname(__FILE__) . DS."..".DS."..".DS ));

require_once ROOT_PATH.DS.'core'.DS.'init.php';

// file to include in all newsletter files
// if its in the scripts folder include this
// require_once 'newsletter_include.php';
// if its in the parent folder include this
// require_once 'scripts/newsletter_include.php';


