<?php 
require_once("../../includes/initialize_admin.php");

if ( $session->loggedIn() ) redirectTo("index.php");

if (isset($_POST['submit'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];
    
    $admin = Admin::authenticate($email, $password);

    if ( $admin ) {
        $session->login($admin->id, $admin->role);
        redirectTo("index.php");
        exit();
    } else {
        $session->message("Invalid email and password combination");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login &raquo; Kakum Tours</title>
    
    <meta charset="utf-8">
    <!-- <link rel="shortcut icon" href="img/favicon.ico"> -->
    
    <link href="css/normalize.css" media="all" rel="stylesheet" type="text/css" />
    <link href="css/global.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
    <?php outputMessage($session->message()); ?>
    
    <section class="login-section">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <fieldset><legend>Enter Your Credentials to Login</legend>
                <label for="email">Email Address:</label>
                <input type="email" name="email" value="<?php echo isset($_POST['email']) ? htmlentities($_POST['email']) : ""; ?>" placeholder=" e.g. example@mail.com" />

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Your Password">

                <input type="submit" name="submit" value="Login">
            </fieldset>
        </form>
    </section>
</body>
</html>

