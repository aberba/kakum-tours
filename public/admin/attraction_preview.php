<?php
require_once("../../includes/initialize_admin.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$attraction = Attraction::findById($id);

if (!$attraction) {
	$session->message("No record of attraction (ID={$id}) was found");
	redirectTo("attractions.php");
    exit();
}

define("PAGE_TITLE", "Preview ".$attraction->name);

includeTemplate("admin.header.php");

?>


<section id="content" class="attraction-preview-page">
	<h3><a href="attractions.php">&laquo; Back to Attractions</a></h3>
    <section>
        <h1><?php echo $attraction->name ?></h1>

        <figure>
        	<img src="../uploads/photos/<?php echo $attraction->photo_thumb_filename; ?>">
        	<figcaption><?php echo $attraction->caption; ?></figcaption>
        </figure>

        <div>
            <h2>Package Details</h2>

            <div class='info'>
                <p><span>Published:</span> <?php echo ($attraction->publish == 1) ? "Yes" : "No"; ?></p>
            </div>
        </div>

        <div>
            <h2>Description</h2>

        	<p><?php echo $attraction->description; ?></p>
        </div>
    </section>
</section>

<aside id="aside"><?php includeTemplate("admin.aside.php"); ?></aside>


<?php includeTemplate("admin.footer.php"); ?>
