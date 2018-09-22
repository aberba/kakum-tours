<?php
require_once("../../includes/initialize_admin.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$package = Package::findById($id);
$package_attractions = Attraction::findPackageAttractions($id);

if (!$package) {
	$session->message("No record of package (ID={$id}) was found");
	redirectTo("packages.php");
    exit();
}

define("PAGE_TITLE", "Preview ".$package->name);

includeTemplate("admin.header.php");

?>


<section id="content" class="package-preview-page">
    <section class="package-info-section">
        <h1><?php echo $package->name ?></h1>

        <figure>
        	<img src="../uploads/photos/<?php echo $package->photo_thumb_filename; ?>">
        	<figcaption><?php echo $package->caption; ?></figcaption>
        </figure>

        <div>
            <h3>Package Details</h3>

            <div class='info'>
                <p><span>Status:</span> <?php echo ($package->status == 1) ? "Opened" : "Closed"; ?></p>
                <p><span>Published:</span> <?php echo ($package->publish == 1) ? "Yes" : "No"; ?></p>

            </div>
        </div>

        <div>
            <h3>Description</h3>

        	<p><?php echo $package->description; ?></p>
        </div>

	</section>

	<section class="clearfix">
		<h2>Attractions Under Package</h2>

		<?php
			if ($package_attractions) {
				$output ="";
				foreach ($package_attractions as $key => $value) {
					$output .= "
					    <div id='attraction". $value->id ."' class='attraction'>
							<h3>". $value->name ."</h3>
							<figure>
								<img src='../uploads/photos/". $value->photo_thumb_filename ."' alt='". $value->name ."' />

								<figcaption>". $value->caption ."</figcaption>
							</figure>
						</div>
					";
				}

				echo $output;
			} else {
				echo "<p>No attraction added to package</p>";
			}
		?>
	</section>

	<section>
		<h3>Package Registration</h3>
	</section>

</section>

<aside id="aside"><?php includeTemplate("admin.aside.php"); ?></aside>


<?php includeTemplate("admin.footer.php"); ?>
