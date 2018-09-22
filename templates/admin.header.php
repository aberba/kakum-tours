<?php
global $session;

if ( !$session->loggedIn() ) redirectTo("login.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo PAGE_TITLE; ?> &raquo; Kakum Tours</title>

    <meta charset="utf-8">
    <link rel="shortcut icon" href="../img/favicon.ico">

    <link href="../css/normalize.css" media="all" rel="stylesheet" type="text/css" />
    <link href="css/global.css" media="all" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="wrapper">

	    <header id="header">
	        <div>
	        	<figure id="logo">
	        		<a href="index.php"><img src="../img/green-ecotours-logo.png" alt="kakum Tours Logo"></a>
	        	</figure>
	        </div>

			<nav role="navigation">
				<ul>
				    <li><a href="index.php">Dashboard</a></li>
				    <li><a href="bookings.php">Bookings</a></li>
				    <li><a href="bookings_special.php">Special Bookings</a></li>
				    <li><a href="packages.php">Packages</a></li>
				    <li><a href="attractions.php">Attractions</a></li>
				    <li><a href="notifications.php">Notifications</a></li>
				    <li><a href="countries.php">Countries</a></li>
					<li><a href="logout.php">Logout</a></li>
					<li><a href="#">Site &raquo;</a></li>
					<li></li>
				</ul>
			</nav>
	    </header>

	    <?php outputMessage($session->message()); ?>
