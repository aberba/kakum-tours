<?php
require_once("../includes/initialize_public.php");


define("PAGE_TITLE", "Home");
define("PAGE_JS", "home.js");
define("PAGE_CSS", "home.css");

includeTemplate("public.header.php");
?>


<article id="content">
    <section class="slider-section">
        <div class="fscSlider">
            <img src="uploads/photos/slide.jpg" data-tooltipheader="Slide one" data-tooltipcontent="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.">

            <img src="uploads/photos/slide.jpg" data-tooltipheader="Slide one" data-tooltipcontent="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.">

            <img src="uploads/photos/slide.jpg" data-tooltipheader="Slide one" data-tooltipcontent="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.">
        </div>
    </section>

    <section class="thumbs-section">
        <div class="thumb">
            <figure>
                <img src="img/package.png" alt="Tour Packages">
            </figure>

            <h3>Transportation</h3>
            <p>Lorem ipsum dolor sit amet <br/><a href="#">View &raquo;</a></p>
        </div>

        <div class="thumb">
            <figure>
                <img src="img/logo-large.png" alt="Tour Packages">
            </figure>

            <h3>About Us</h3>
            <p>Lorem ipsum dolor sit amet <br/><a href="#">View &raquo;</a></p>
        </div>

        <div class="thumb">
            <figure>
                <img src="img/booking.png" alt="Tour Packages">
            </figure>

            <h3>FAQ</h3>
            <p>Lorem ipsum dolor sit amet <br/><a href="#">View &raquo;</a></p>
        </div>
    </section>
</article>


<?php includeTemplate("public.footer.php"); ?>
