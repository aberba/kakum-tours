<?php 
require_once("../../includes/initialize_admin.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$package = Package::findById($id);

if (!$package) {
	$session->message("No record of package (ID={$id}) was found");
	redirectTo("packages.php");
    exit();
}

define("PAGE_TITLE", "Edit ".$package->name);

includeTemplate("admin.header.php"); 

?>


<section id="content" class="package-edit-page">  
    <section>
        <form>
            <label for="name">Name: </label>
            <input type="text" name="name" value="<?php echo $package->name; ?>">

            <label for="description">Description: </label>
            <textarea name="description"><?php echo $package->description; ?></textarea>

            <label for="photo">Photo: </label>
            <figure>
                <img src="../uploads/photos/<?php echo $package->photo_thumb_filename; ?>">
            </figure>

            <label for="caption">Caption: </label>
            <input type="text" name="caption" value="<?php echo $package->caption; ?>">

            <label for="publish">Publish: </label>
            No<input type="radio" name="publish" <?php echo ($package->publish == 0) ? "selected" : ""; ?> value="0">
            Yes<input type="radio" name="publish" <?php echo ($package->publish == 1) ? "selected" : ""; ?> value="1">
            
            <br /><button name="save">Save package</button>
            <a href="packages.php">Cancel</a>
        </form>
    </section>
</section> 

<aside id="aside"><?php includeTemplate("admin.aside.php"); ?></aside>


<?php includeTemplate("admin.footer.php"); ?>