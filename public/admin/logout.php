<?php 
require_once("../../includes/initialize_admin.php");

$session->logout();
redirectTo("login.php");
exit();
?>