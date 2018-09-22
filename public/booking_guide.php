<?php
require_once("../includes/initialize_public.php");

define("PAGE_TITLE", "New Booking");
define("PAGE_JS", "booking_guide.js");
define("PAGE_CSS", "booking_guide.css");


includeTemplate("public.header.php");
?>


<article id="content">
    <section class="guide-section">
        <h2>Tour Booking Guide</h2>
        <p>Booking a tour is really easy. Please follow this simple guide to complete the process.</p>

        <ol class="guides">
            <li>
                <h3>Select attractions.</h3>
                <p>
                    Browse through and click the "Add to Basket" button of any number attractions you would like to book from the <a href="attractions.php" target="_blank">attractions page</a>.

                    The attractions you choose will be shown from the basket icon in the main menu bar at the top of this page.
                </p>

                <figure>
                    <img src="img/booking.png" alt="Choose an attraction by clicking it's 'Add to Cart' button" />
                </figure>
            </li>

            <li>
                <h3>Manage Attractions</h3>
                <p>
                    Click on the baskets in the main memnu bar to reveal the selected attraction if any. For each attraction, click on the manage button to indicate the group and number of tourists in each group you want to book for that particular attraction.
                </p>
                <p>
                    You can also remove any number of attraction from the basket by clicking on the trash icon below that particular attraction in the basket.
                </p>

                <figure>
                    <img src="img/booking.png" alt="Choose an attraction by clicking it's 'Add to Cart' button" />
                </figure>
            </li>


            <li>
                <h3>Book Selected Attractions</h3>
                <p>
                    You can now book the selected choice of attractions in the basket once you are OK with your choice. This is done by cliking the "Book Now" button in the shoping basket.
                </p>

                <p> You will then be sent to a page where you can enter details fo your booking to finalize the process. A confirmation e-mail message containing credentials of your booking will be sent to the provided e-mail address.</p>

                <p>The notification e-mail message may take some time to arrive depending on your location, so please wait a while if you don't recieve an e-mail from us immediately. You can contact us for assistance if you don't recieve your notification e-mail message after 2 hours.</p>

                <figure>
                    <img src="img/booking.png" alt="Choose an attraction by clicking it's 'Add to Cart' button" />
                </figure>
            </li>
        </ol>

        <p>
            <a href="attractions.php">Proceed to book your tour &raquo;</a>
        </p>
    </section>
</article>


<?php includeTemplate("public.footer.php"); ?>
