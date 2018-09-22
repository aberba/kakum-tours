<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo PAGE_TITLE; ?> &raquo; Kakum Tours</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-sacle=1" />
    
    <meta name="description" content="Kakum Tours takes you through the rich natural heritage of Kakum National Park.">
    <link rel="shortcut icon" href="img/favicon.ico">

    <link href="css/normalize.css" media="all" rel="stylesheet" type="text/css" />
    <link href="css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="css/<?php echo PAGE_CSS; ?>" media="all" rel="stylesheet" type="text/css" />
</head>

<body>


    <header id="header">
        <div id="wrapper">
    		<nav class="clearfix" role="navigation">
                <figure class="logo" role="figure">
                    <a href="index.php"><img src="img/logo.png" role="logo" alt="Our logo" /></a>
                </figure>

                <ul class="main-menu" role="menu">
                    <li><a href="index.php">Home</a></li>
                    <!--<li><a href="packages.php">Packages</a></li> -->
                    <li><a href="attractions.php">Attractions</a></li>
                    <li><a href="booking.php">Booking</a></li>
                    <li><a href="gallery.php">Gallery</a></li>
                    <li class="cart">
                        <a href="#" ></a><br>
                        <div>
                            <ul>
                                <li>item 1</li>
                                <li>item 1</li>
                                <li>item 1</li>
                                <li>item 1</li>
                            </ul>
                        </div>
                    </li>
                </ul>

                <form class="form" role="search">
    				<input type="search" name="search" placeholder="Search ..." />
    			</form>

                <ul class="thumb-menu" role="menu">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Packages</a></li>
                    <li><a href="#">Attractions</a></li>
                    <li><a href="#">Bokking</a></li>
                    <li><a href="#">Gallery</a></li>
                </ul>
            </nav>
        </div>

    </header>

    <div id="wrapper" class="content-wrapper">
