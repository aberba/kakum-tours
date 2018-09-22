<?php
require_once("../includes/initialize_public.php");


define("PAGE_TITLE", "Attractions");
define("PAGE_JS", "attractions.js");
define("PAGE_CSS", "attractions.css");

includeTemplate("public.header.php");
?>

<article id="content">
    <section class="attractions-section">
        <?php
            $attractions = Attraction::findPublished();
            $output = "";
            $show_pagination = false;
            if ($attractions) {
                $show_pagination = true;

                foreach ($attractions as $key => $value) {
                    $output .= "
                    <div class='attraction clearfix'>
                        <h3>".htmlentities($value->name)."</h3>
                        <figure>
                            <img src='uploads/photos/".$value->photo_thumb_filename. "' alt='".htmlentities($value->alt_text)."' title='Click to view more photos of this attraction' />
                        </figure>
                        <button class='button'>Add to Basket</button>
                        <ul>
                            <li><strong>Duration</strong>: <span class='price'>2.20 hrs</span></li>
                            <li><strong>Price</strong>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class='price'>&dollar;".$value->price."</span></li>
                        </ul>

                        <a href='attraction_view.php?id=".$value->id."'>Read More &raquo;</a>
                    </div>";
                }

            } else {
                $output .= "<p>Sorry, no attraction is added yet.</p>";
            }

            echo $output;
        ?>

    </section>

    <section class="pagination" role="pagination">
        <?php
        /**
         * This is where pagination is displayed
         * Pagination is shown when there one or more attraction uploaded
         */
         if ($show_pagination) {
             //Show pagination here
         }

        ?>
        <p>
            pagination here
        </p>

    </section>
</article>

<?php includeTemplate("public.footer.php"); ?>
