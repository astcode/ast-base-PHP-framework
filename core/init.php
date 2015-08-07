<?php
session_start();

// Get all of the global configurations
require_once dirname(__FILE__).'/global_config_variables.php';


// this checks if we are on a live server or localhost server
// if isLive is true then on local else if isLive is false on LIVE server
$isLive = (!checkdnsrr($_SERVER['SERVER_NAME'], 'NS')) ? true : false ;
if ($isLive) {
    // LocalHost server
    // You will need to change the $basefileconfig to your  localhost file
    // Example: C:\xampp\htdocs\
    $basefileconfig = $_SERVER['DOCUMENT_ROOT'].'/'.$file_root_document_folder.'/';
    defined("BASE_FILE_CONFIG")
        || define("BASE_FILE_CONFIG",
        $_SERVER['DOCUMENT_ROOT'].'/'.$file_root_document_folder.'/');
} else {
    // Live Server
    // Example: /home/truthyou/public_html/
    // You will need to change the $basefileconfig to your servers host file
    $basefileconfig =  $_SERVER['DOCUMENT_ROOT'].'/'.$file_root_document_folder.'/';
    defined("BASE_FILE_CONFIG")
        || define("BASE_FILE_CONFIG",
        $_SERVER['DOCUMENT_ROOT'].'/'.$file_root_document_folder.'/');
}

// Gets core constants REQUIRED.
require_once BASE_FILE_CONFIG.'core/constants.php';


// Autoload classes
function autoload($class) {
    require_once BASE_FILE_CONFIG.'classes/' . $class . '.php';
}
spl_autoload_register('autoload');

// Include page variables ie... $user = new User();
require_once BASE_FILE_CONFIG.'core/variables.php';


// Include functions
// Not autoloaded because we need files to be in a specific order
//  If you need any of the functionalities of the scripts just uncomment them

        //  For sanitizing HTML
            require_once $basefileconfig.'functions/sanitize.php';

        // General functions ie.. getIp(), hasIpHit(), etc...
            require_once $basefileconfig.'functions/general.php';

        // add ip_address to the global array.. may be overkill
        $GLOBALS['config']['site']['ip_address'] = getIp();
        $GLOBALS['config']['visitor']['ip_address'] = getIp();

//----------------------------------------------------------------------------//
//      The following can be commented or uncommented       //
//----------------------------------------------------------------------------//
        // Function to format your date and time
            // require_once $basefileconfig.'functions/date_time.php';

        // Include Helpers
        // require_once $basefileconfig.'helpers/array_helper.php';
        // require_once $basefileconfig.'helpers/email_helper.php';
        // require_once $basefileconfig.'helpers/form_helper.php';
        // require_once $basefileconfig.'helpers/inflector_helper.php';

//----------------------------------------------------------------------------//
//      Do not change the following code                                   //
//----------------------------------------------------------------------------//

        // do NOT comment this one it is REQUIRED
        require_once $basefileconfig.'helpers/string_helper.php';

        //

        // Do NOT Comment out  REQUIRED
            // Gets the base and site url for other scripts to use
                require_once $basefileconfig.'helpers/url_helper.php';
            // gets the app_base_url()
                require_once $basefileconfig.'libs/lib_functions.php';

// gets ip_address may be overkill
$ip = getIp();


// Check for users that have requested to be remembered
if(Cookie::exists(Config::get('remember/cookie_name'))) {
    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

    if($hashCheck->count()) {
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }

}

// get the logged in user INFO_ALL
if (Session::exists('user')) {
    $loggedin_user_id = Session::get('user');
    $this_loggedin_user = DB::getInstance()->query("SELECT * FROM users WHERE id = '{$loggedin_user_id}'");
    foreach ($this_loggedin_user->results() as $the_user) {
        $this_loggedin_user_id = $the_user->id;
        $this_loggedin_user_username = $the_user->username;
        $this_loggedin_user_name = $the_user->name;
        $this_loggedin_user_joined = $the_user->joined;
        $this_loggedin_user_group = $the_user->group;
        // $this_loggedin_user_updated = $the_user->updated;
        // $this_loggedin_user_email = $the_user->email;
    }
}