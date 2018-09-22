<?php
require_once("../../../includes/initialize_admin.php");
if (!isAjaxRequest()) exit("R :)");

if (isset($_POST['togglePublishing'])) {
	$attraction = Attraction::findById($_POST['id']);
	if (!$attraction) {
		exit("No record of attraction (ID = {$id}) was found");
	}

	$state = ((int)$attraction->publish === 1) ? "unpublished" : "published";
	$attraction->publish = ((int)$attraction->publish === 1) ? 0 : 1;

	if ($attraction->save()) {
		exit("Attraction ". $state." successfully!");
	} else {
		exit("Oops! could not update attraction state");
	}
}
?>
