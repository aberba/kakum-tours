<?php
require_once("../../includes/initialize_admin.php");

define("PAGE_TITLE", "Packages");

includeTemplate("admin.header.php");
?>


<section id="content" class="packages-page">
    <section class="form-section">
    	<form>
    		<input type="search" name="search" placeholder="Search for Package by Name">
    		<button type="button" name="search-btn">Search</button>
    	</form>
    </section>

    <section class="packages-section clearfix">
		<?php
		$packages = Package::findAll();
		if ($packages) {
			$output = "";

			foreach ($packages as $package => $value) {
				$status  = ($value->status == 1) ? "Opened" : "Closed";
				$publish = ($value->publish == 1) ? "Unpublish" : "Publish";

				$output .= "<section class='package'>
		                        <h3>". $value->name ."</h3>

				                <figure>
				                    <a href='package_preview.php?id=". $value->id ."'>
				                        <img src='../uploads/photos/". $value->photo_thumb_filename ."' alt='". $value->name ."' />
				                    </a>

				                    <figcaption>". $value->caption ."</figcaption>
				                </figure>

				                <ul class='info'>
				                    <li><span>Status:</span> ". $status ."</li>
				                    <li><span>Start Date:</span> ". CustomDate::stringDate($value->start_date) ."</li>
				                    <li><span>End Date:</span> ". CustomDate::stringDate($value->end_date) ."</li>
				                    <li><span>Date Added:</span> ". CustomDate::stringDate($value->date_added) ."</li>
				                </ul>

	                            <ul class='links'>
	                                <li><a href='package_preview.php?id=". $value->id ."'><img src='../img/notes.png' title='Preview' /></a></li>
	                                <li><a href='package_edit.php?id=". $value->id ."'><img src='../img/edit-notes.png' title='Edit' /></a></li>
	                                <li><a href='#'><img src='../img/trash-can.png' title='Delete' /></a></li>
	                            </ul>
				            </section>
				";
			}
            
			echo $output;
		}
		?>
    </section>
</section>

<aside id="aside"><?php includeTemplate("admin.aside.php"); ?></aside>


<?php includeTemplate("admin.footer.php"); ?>
