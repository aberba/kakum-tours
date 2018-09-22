<?php
require_once("../includes/initialize_public.php");

define("PAGE_TITLE", "");
define("PAGE_JS", "gallery.js");
define("PAGE_CSS", "gallery.css");


includeTemplate("public.header.php");
?>


<article id="content">
    <section class="gallery-section">
        <nav>
            <ul>
                <li>Photos</li>
                <li>Videos</li>
                <li>Documents</li>
            </ul>
        </nav>

        <div class="gallery clearfix">

            <figure class="photos">
                <img src="uploads/photos/image.jpg" alt="alt hre" />
            </figure>

            <figure class="videos">
                <video src="uploads/videos/video.mp4" controls poster="uploads/photos/image.jpg">
                    Sorry, you browser cannot play vidoes. Please use a recent version of either google chrome, firefox, or internet explorer.
                </video>
            </figure>

            <div class="gallery-aside">
                <figure><img src="uploads/photos/image.jpg" alt="" /></figure>
                <figure><img src="uploads/photos/image.jpg" alt="" /></figure>
                <figure><img src="uploads/photos/image.jpg" alt="" /></figure>
                <figure><img src="uploads/photos/image.jpg" alt="" /></figure>
            </div>
        </div>
    </section>
</article>


<?php includeTemplate("public.footer.php"); ?>
