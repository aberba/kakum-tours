<?php 
require_once("../../includes/initialize_admin.php");

define("PAGE_TITLE", "Country List");

includeTemplate("admin.header.php"); 
?>


<section id="content">  
    <section>
    <h1>List of Countries Under Tour Booking</h1>
    
    <?php 
        $countries = Country::findAll();
        if ($countries) {
            $output = "<table class='table'>
                            <tr>
                                <th>Country</th>
                                <th>Abbreviation</th>
                                <th>Phone Code</th>
                                <th>&nbsp;&nbsp;</th>";
            foreach ($countries as $country => $value) {
                $output .= "<tr>
                                <td>" .$value->name. "</td>
                                <td>" .$value->abbreviation. "</td>
                                <td>" .$value->phone_code. "</td>
                                <td><a href='#'><img src='../img/trash-can.png' title='Delete'</a></td>
                            </tr>
                ";
            }
            $output .= "</table>";
            echo $output;
        }

    ?>
    </section>
</section> 

<aside id="aside"><?php includeTemplate("admin.aside.php"); ?></aside>


<?php includeTemplate("admin.footer.php"); ?>