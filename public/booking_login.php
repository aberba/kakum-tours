<?php
require_once("../includes/initialize_public.php");

define("PAGE_TITLE", "Booking Login");
define("PAGE_JS", "booking_login.js");
define("PAGE_CSS", "booking_login.css");

includeTemplate("public.header.php");
?>


<article id="content">
    <section class="login-section">
        <form class="form booking-login-form" method="POST">
            <h3> Enter your booking credentials to proceed </h3><br>

            <label for="email">E-mail Address:</label>
            <input type="email" name="email" placeholder="e.g. johndoe@mail.com">

            <label for="regid">Registration ID:</label>
            <input type="text" name="regid" placeholder="Registration ID here">

            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Password here">

            <button class="button booking-login-button">Authenticate &raquo;</button>
        </form>
    </section>

</article>


<?php includeTemplate("public.footer.php"); ?>
