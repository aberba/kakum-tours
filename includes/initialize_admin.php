<?php

/* GLOBAL TIMEZONE SETTINGS
*********************************************************************/
date_default_timezone_set("Africa/Accra");


/********************************************************************
     APPLICATION CONSTANTS
********************************************************************/

/* DEFINE ENVIRONMENT CONSTANTS
********************************************************************/
define('DS', DIRECTORY_SEPARATOR);
define('APP_ROOT', dirname(__DIR__));
define('SERVER_NAME', $_SERVER['SERVER_NAME']);
define("APP_URI",
        ( (isset($_SERVER['HTTPS'][0]) && ($_SERVER['HTTPS'] == 'on')) ?
        	'https' : 'http' ). "://".$_SERVER['HTTP_HOST']
);
define("HTTP_HOST", $_SERVER['HTTP_HOST']);
define("DEBUG_MODE", true); //set to off when in production


/* FILES DIR CONSTANTS
********************************************************************/
define('INC_DIR', APP_ROOT.DS."includes");
define('TEM_DIR', APP_ROOT.DS."templates");
define('LOG_DIR', APP_ROOT.DS."logs");


/* FILES PATHS CONSTANTS
********************************************************************/
define('UPLOADS_DIR', APP_ROOT.DS."public".DS."uploads");
define("PHOTOS_DIR", UPLOADS_DIR.DS."photos");
define("VIDEOS_DIR", UPLOADS_DIR.DS."videos");
define("DOCS_DIR", UPLOADS_DIR.DS."docs");


/* ERROR REPORTING
   @ Make sure it is set 'false' when in production
********************************************************************/
if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 'Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', LOGS_DIR.DS."errors.log");
}

/* Require authentication file
********************************************************************/
require_once(INC_DIR.DS.'kakum_tours_connect.php');

/* Key Objects
********************************************************************/
require_once(INC_DIR.DS.'class.debug.php');
require_once(INC_DIR.DS.'functions.php');
require_once(INC_DIR.DS.'class.database.php');
require_once(INC_DIR.DS.'class.globalobject.php');
require_once(INC_DIR.DS.'class.session.php');
require_once(INC_DIR.DS.'class.secure.php');
require_once(INC_DIR.DS.'class.customdate.php');

/* Controller Objects
********************************************************************/
require_once(INC_DIR.DS.'class.country.php');
require_once(INC_DIR.DS.'class.admin.php');
require_once(INC_DIR.DS.'class.attraction.php');
require_once(INC_DIR.DS.'class.package.php');

//require_once(INC_DIR.DS.'class.gallery.php');
//require_once(INC_DIR.DS.'class.email.php');
//require_once(INC_DIR.DS.'class.notifications.php');
//require_once(INC_DIR.DS.'class.settings.php');
//require_once(INC_DIR.DS.'class.pagination.php');
//require_once(INC_DIR.DS.'class.uploads.php');
?>
