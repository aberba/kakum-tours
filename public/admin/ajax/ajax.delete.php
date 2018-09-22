<?php
require_once("../../../includes/initialize_admin.php");
if (!isAjaxRequest()) exit("R :)");

if (isset($_POST['deleteAttraction'])) {
	$attraction = Attraction::findById((int)$_POST['id']);

	if (!$attraction) {
		exit("No record of attraction (ID = {$id}) was found");
	}
	if ($attraction->delete()) {
		exit("Attraction ". $attraction->name." has been deleted sucessfully!");
	} else {
		exit("Oops!, could not delete attraction (ID = {$id})");
	}
}

?>
