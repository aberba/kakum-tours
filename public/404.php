<?php
require_once("../includes/initialize_public.php");

define("PAGE_TITLE", "404 Not found");
define("PAGE_JS", "f404.js");
define("PAGE_CSS", "f404.css");


includeTemplate("public.header.php");
?>


<article id="content">
    <h2>Page not found</h2>
</article>


<?php includeTemplate("public.footer.php"); ?>
