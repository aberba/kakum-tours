<?php
require_once("../../includes/initialize_admin.php");


/* Post request
*************************************************************/
$errors = []; //Initialize errors array to populate errors
if ( isset($_POST['add']) ) {

	$attr = new Attraction();

	if (!isset($_POST['name'][0])) {
		$errors['name'] = "Please enter attraction name";
	}

	if (!isset($_POST['description'][0])) {
		$errors['description'] = "Please enter a description";
	}

	if (empty($errors)) {

		$attr->name        = $_POST['name'];
		$attr->description = $_POST['description'];

		if ($attr->save()) {
			$session->message("Attaction has been created successfully! Please edit.");
			redirectTo("attractions.php");
			exit();
		} else {
			$db_error = $database->getError();

			if ($db_error) {
				$session->message($db_error);
				redirectTo("attraction_add.php");
				exit();
			} else {
				$session->message("Oops! an error occured whilst creating attraction");
			}
		}
	}
}


define("PAGE_TITLE", "Add new attraction");

includeTemplate("admin.header.php");

?>


<section id="content" class="attraction-edit-page">
	<h3><a href="attractions.php">&laquo; Back to Attractions</a></h3>

    <section>
		<h1>Add new attraction</h1>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
		     <p class="notice">Please make sure you edit attraction after creation</p>

            <label for="name">Name: </label>
            <input type="text" name="name" placeholder="Enter attraction name here" value="<?php echo isset($_POST['name']) ? htmlentities($_POST['name']) : ""; ?>" >
			<span class="error"><?php echo isset($errors['name']) ? $errors['name'] : ""; ?></span>

            <label for="description">Short Description of Attraction: </label>
            <textarea name="description" placeholder="Enter description here"><?php echo isset($_POST['description']) ? htmlentities($_POST['description']) : ""; ?></textarea>
			<span class="error"><?php echo isset($errors['description']) ? $errors['description'] : ""; ?></span>

            <br /><input type="submit" name="add" value="Save Attraction" />
            <a href="attractions.php">Cancel</a>
        </form>
    </section>
</section>

<aside id="aside"><?php includeTemplate("admin.aside.php"); ?></aside>


<?php includeTemplate("admin.footer.php"); ?>
