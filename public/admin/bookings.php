<?php 
require_once("../../includes/initialize_admin.php");

define("PAGE_TITLE", "Bookings");

includeTemplate("admin.header.php"); 

?>


<section id="content">  
    <section>
        <h1>List of Bookings Made</h1>

    </section>
</section> 

<aside id="aside"><?php includeTemplate("admin.aside.php"); ?></aside>


<?php includeTemplate("admin.footer.php"); ?>