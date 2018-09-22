<?php
/* Recommended version of __autoload() in PHP manual */

// spl_autoload_register(function($class_name) {
//     $file_name = "class.". strtolower($class_name) .".php";
//     Debug::assertion(true, "spl_autoload_register(): require_once ignored for {$file_name}");
//     require_once(INC_DIR.DS.$file_name);
// });

function isAjaxRequest() {
    /**
     * used to check againsts crost domain ajax request attack
     * NOTE: uncomment if commented b4 hosting
     */
    if ($_SERVER["HTTP_X_REQUESTED_WITH"] !== "XMLHttpRequest") return false;
    if ($_SERVER['HTTP_HOST'] != HTTP_HOST) return false;
    return true;
}

function includeTemplate($file_name="") {
    $file_name = strtolower($file_name);
    include(TEM_DIR.DS.$file_name);
}

function redirectTo($location=null) {
    Debug::assertion( (location === null), "No agument was passed to redirectTo()");
    header("Location: $location");
}

function arrayToMessage($array=null) {
    return "<ul id='error-messages'><li>". join("</li><li>", $array) .
    "</li></ul>";
}

function outputMessage($message="") {
    if ( isset($message[0]) )  echo "<div id='message'><p>". $message ."</p></div>";
}

/*
function require_class($class_name="") {
    $class_name = strtolower($class_name);
    return require_once(INC_DIR.DS.$class_name);
} */
?>
