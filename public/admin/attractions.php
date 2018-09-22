<?php
require_once("../../includes/initialize_admin.php");

define("PAGE_TITLE", "Attractions");

includeTemplate("admin.header.php");
?>


<section id="content" class="attractions-page">
    <section class="form-section">
        <form>
            <input type="search" name="search" placeholder="Search for Attraction by Name">
            <button type="button" name="search-btn">Search</button>
        </form>
    </section>

    <section class="attractions-section clearfix">
        <?php
        $attractions = Attraction::findAll();
        if ($attractions) {
        	$o = "";

        	foreach ($attractions as $attraction => $value) {
        		$publish = ((int)$value->publish === 1) ? "Unpublish" : "Publish";

        		$o .= "<section class='attraction' id='attraction". $value->id ."'>
                                <h3>". $value->name ."</h3>

        		                <figure>
        		                    <img src='../uploads/photos/". $value->photo_thumb_filename ."' alt='". $value->name ."' />
        		                    <figcaption>". $value->caption ."</figcaption>
        		                </figure>

                                <ul class='links' id='". $value->id ."'>
                                    <li><a href='attraction_preview.php?id=". $value->id ."'><img src='../img/notes.png' title='Preview' /></a></li>
                                    <li><a href='attraction_edit.php?id=". $value->id ."'><img src='../img/edit-notes.png' title='Edit' /></a></li>
                                    <li><a href='#' class='delete-btn' id='". $value->id ."'><img src='../img/trash-can.png' title='Delete' /></a></li>
                                    <li><a href='#' class='publish-btn'><img src='../img/online.png' title='". $publish ."' /></a></li>
                                </ul>
        		            </section>
        		";
        	}

        	echo $o;
        }
        ?>
    </section>
</section>

<aside id="aside"><?php includeTemplate("admin.aside.php"); ?></aside>


<?php includeTemplate("admin.footer.php"); ?>
