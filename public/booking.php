<?php
require_once("../includes/initialize_public.php");

define("PAGE_TITLE", "");
define("PAGE_JS", "booking.js");
define("PAGE_CSS", "booking.css");


includeTemplate("public.header.php");
?>


<article id="content">
    <section class="booking-section">

        <div class="booking-options">
            <figure>
                <h3>My Bookings</h3>
                <img src="img/booking.png" alt="Current bookings" />
                <figcaption>
                    View bookings you have made <br>
                    <a href="booking_login.php">View Bookings &raquo;</a>
                </figcaption>
            </figure>

            <figure>
                <h3>Book a tour</h3>
                <img src="img/package.png" alt="Book now" />
                <figcaption>
                    Use this option to book a tour.<br>
                    <a href="booking_guide.php">Book Now &raquo;</a>
                </figcaption>
            </figure>
        </div>

    </section>

    <section class="extras-section">
        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
    </section>
</article>


<?php includeTemplate("public.footer.php"); ?>
