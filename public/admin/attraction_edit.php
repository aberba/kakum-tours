<?php
require_once("../../includes/initialize_admin.php");

// If is get request, set id
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;


/* Post request
*************************************************************/
if ( isset($_POST['save']) ) {

	$id   = (int)$_POST['id'];
	$attr = Attraction::findById($id);

	$attr->name        = $_POST['name'];
	$attr->description = $_POST['description'];
	$attr->alt_text     = $_POST['alt_text'];
	$attr->publish     = $_POST['publish'];

    /* If user uploaded a photo, then attach to object instance
	*********************************************************************/

	//Validate $_FILES was posted and has a value i.e. $_FILES['photo']['name'][0]
	if ( isset($_FILES['photo']) && isset($_FILES['photo']['name'][0])) {
		$attr->upload_file = $_FILES['photo'];
	}

	if (!$attr->save()) {
		$session->message( arrayToMessage($attr->errors) );
		redirectTo("attraction_edit.php?id={$id}");
	} else {
	    $session->message( arrayToMessage($attr->errors) );
		redirectTo("attractions.php");
	}
}



$attraction = Attraction::findById($id);

if (!$attraction) {
	$session->message("No record of attraction (ID={$id}) was found");
	redirectTo("attractions.php");
    exit();
}

define("PAGE_TITLE", "Edit ".$attraction->name);

includeTemplate("admin.header.php");

?>


<section id="content" class="attraction-edit-page">
	<h3><a href="attractions.php">&laquo; Back to Attractions</a></h3>

    <section>
		<h1>Edit attraction &raquo; <a href="#"><?php echo $attraction->name; ?></a></h1>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <label for="name">Name: </label>
            <input type="text" name="name" value="<?php echo $attraction->name; ?>">

			<label for="photo">Update Photo: </label>
			<input type="file" name="photo" />

			<label for="alt_text">Photo's Alternative Text: </label>
            <input type="text" name="alt_text" value="<?php echo $attraction->alt_text; ?>">

			<figure>
                <img src="../uploads/photos/<?php echo $attraction->photo_thumb_filename; ?>">
            </figure>

            <label for="description">Short Description of Attraction: </label>
            <textarea name="description"><?php echo $attraction->description; ?></textarea>

            <label for="publish">Publish ?</label>
            No<input type="radio" name="publish" <?php echo ($attraction->publish == 0) ? "checked" : ""; ?> value="0">
            Yes<input type="radio" name="publish" <?php echo ($attraction->publish == 1) ? "checked" : ""; ?> value="1">

			<input type="hidden" name="id" value="<?php echo $attraction->id; ?>" />

            <br /><input type="submit" name="save" value="Save Attraction" />
            <a href="attractions.php">Cancel</a>
        </form>
    </section>
</section>

<aside id="aside"><?php includeTemplate("admin.aside.php"); ?></aside>


<?php includeTemplate("admin.footer.php"); ?>
