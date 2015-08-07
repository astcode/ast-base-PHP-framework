<?php

// Directory Seperator
defined("DS")
    || define("DS", DIRECTORY_SEPARATOR);

// root path
defined("ROOT_PATH")
    || define("ROOT_PATH", realpath(dirname(__FILE__) . DS."..".DS ));

$isLive = (!checkdnsrr($_SERVER['SERVER_NAME'], 'NS')) ? true : false ;

// site domain name with http
if (!$isLive) {
    defined("SITE_URL")
        || define("SITE_URL",
        "http://".$_SERVER['SERVER_NAME'].DS);
} else {
    defined("SITE_URL")
        || define("SITE_URL",
        "http://".$_SERVER['SERVER_NAME'].DS.$file_root_document_folder.DS);
}

// echo SITE_URL;
// site domain name with http
defined("CORE_URL")
    || define("CORE_URL",
    SITE_URL."core".DS);

// echo SITE_URL;
// site domain name with http
defined("FUNCTIONS_URL")
    || define("FUNCTIONS_URL",
    SITE_URL."functions".DS);

// echo SITE_URL;
// site domain name with http
defined("HELPERS_URL")
    || define("HELPERS_URL",
    SITE_URL."helpers".DS);

// echo SITE_URL;
// site domain name with http
defined("LIBS_URL")
    || define("LIBS_URL",
    SITE_URL."libs".DS);

// echo SITE_URL;
// site domain name with http
defined("INCLUDES_URL")
    || define("INCLUDES_URL",
    SITE_URL."includes".DS);

// site domain name with http
defined("VENDOR_URL")
    || define("VENDOR_URL",
    INCLUDES_URL."vendors".DS);

// site domain name with http
defined("CSS_URL")
    || define("CSS_URL",
    INCLUDES_URL."css".DS);

// site domain name with http
defined("JS_URL")
    || define("JS_URL",
    INCLUDES_URL."js".DS);

// site domain name with http
defined("JQUERY_URL")
    || define("JQUERY_URL",
    VENDOR_URL."jquery".DS);

// site domain name with http
defined("JS_URL")
    || define("JS_URL",
    VENDOR_URL."js".DS);

// site domain name with http
defined("BOOTSTRAP_URL")
    || define("BOOTSTRAP_URL",
    VENDOR_URL."bootstrap".DS);