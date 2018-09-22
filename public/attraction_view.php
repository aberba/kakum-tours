<?php
require_once("../includes/initialize_public.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$attraction = Attraction::findById($id);

//Redirect to 404 page if not found or not published for public view
if (!$attraction || (int)$attraction->publish !== 1) {
    redirectTo("404.php");
    exit();
}

define("PAGE_TITLE", $attraction->name);
define("PAGE_JS", "attraction_view.js");
define("PAGE_CSS", "attraction_view.css");

includeTemplate("public.header.php");
?>


<article id="content">
    <section class="attraction-section">
        <h1><?php echo $attraction->name; ?></h1>

        <figure class="attraction-image">
            <img src="uploads/photos/<?php echo $attraction->photo_thumb_filename; ?>" alt="<?php echo $attraction->alt_text; ?>" />
        </figure>

        <section class="attraction-details">
            <div>
                <h3>Summary</h3>

                <table class="table">
                    <tr>
                        <th>Item</th>
                        <th>Detail</th>
                    </tr>
                    <tr>
                        <td>Price </td> <td><?php echo $attraction->price; ?></td>
                    </tr>
                    <tr>
                        <td>Tour Duration</td> <td><?php echo $attraction->tour_duration; ?></td>
                    </tr>
                    <tr>
                        <td>Tour Scale</td> <td><?php echo $attraction->tour_scale; ?></td>
                    </tr>
                    <tr>
                        <td>Movement Means</td> <td><?php echo $attraction->movement_means; ?></td>
                    </tr>
                    <tr>
                        <td>Physical Level</td> <td><?php echo $attraction->physical_level; ?> / 5</td>
                    </tr>
                    <tr>
                        <td>Education Level</td> <td><?php echo $attraction->education_level; ?> / 5</td>
                    </tr>
                </table>
            </div>

            <div>
                <h3>Description</h3>
                <p><?php echo $attraction->description; ?></p>

                <button class="button">ADD TO BASKET</button>
            </div>
        </section>

    </section>

</article>


<?php includeTemplate("public.footer.php"); ?>
