<?php
class Session {

    private $logged_id  = false,
            $message    = "";

    public $id,
           $role;


    function __construct() {
        session_start();
        $this->checkLogin();
        $this->checkMessage();
    }

    /* Session Login & Logout Methods
    *************************************************************/
    private function checkLogin() {
        if (isset($_SESSION['id'])) {
            $this->id        = (int)$_SESSION['id'];
            $this->logged_id = true;
        } else {
            unset($this->id);
            $this->logged_id = false;
        }
        
        //if (isset($_COOKIE['id'])) $_SESSION['id'] = (int)$_COOKIE['id'];
    }

    private function checkMessage() {
        if ( isset($_SESSION['message']) ) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }

    public function message($message="") {
        if (!empty($message)) {
            $_SESSION['message'] = $message;
        } else {
            return $this->message;
        }
    }

    public function login($id=0, $role=0) {
        $_SESSION['id']   = $id;
        $_SESSION['role'] = $role;
        $this->id         = $id;
        $this->role       = $role;
        $this->logged_id  = true;

        //if ($remember_me === true) setcookie('id', $user_id, time() + (60 * 60 * 24 * 2), "/");
        //$this->logLogin($user_id);
    }

    public function logout() {  
        unset($_SESSION['id']);
        unset($_SESSION['role']);
        session_destroy();
        setcookie(session_name(), null, time() - (3600 * 60 * 60 * 24));

        unset($this->id);
        unset($this->role);
        $this->logged_id  = false;  

        //setcookie('id', null, time() - (3600 * 60 * 60 * 24), "/");     
        //setcookie('id', null, time() - (3600 * 60 * 60 * 24), "/ajax/");   
        //if (isset($_COOKIE[session_name()])) setcookie(session_name(), "", time() - (3600 * 60 * 24), "/");
    }

    public function loggedIn() {
        return $this->logged_id;
    }

    
    public function sendRecoveryEmail($email="") {
        global $database, $Users, $Email, $Settings, $secure;
        
        $email = $database->clean_data($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return "Please enter a valid email address.";

        //Validate multiple try failure store i session
        $try = (isset($_SESSION['recovery_try'])) ? (int)$_SESSION['recovery_try'] : 1;
         if ($try > 5) return "Sorry!, you have tried multiple times and failed. ".
                              "You are temporally suspended from additional tries for security reasons. ".
                              "<br>Please try again later.";

        $sql = "SELECT user_id_fk FROM ".$this->login_table." WHERE email = '{$email}' LIMIT 1";
        $result = $database->query($sql);
        if ($database->num_rows($result) != 1) {
            ++$try;
            $_SESSION['recovery_try'] = $try;
            return "No record of your email address was found. <br> Please make sure it is correct.";
        }
        $_SESSION['recovery_try'] = $try;

        $user_id = $database->fetch_data($result)->user_id_fk;

        $to       = $Users->query_email($user_id);
        $subject  = $Settings->site_name()." account password recovery";
        $tmp_password = substr($to, 0, 3) ."T". time();
        $tmp_password = substr(md5($tmp_password), 0, 10)."_".date("Y", time());

        $tmp_password_hash = $secure->secure_password($tmp_password);

        if (!$to) return "An error retrieving you email address";

        $message = "<html><head><title>{$subject}</title></head>
                        <body>
                            <div class='width: 100%; padding:20px; text-align: center;'>
                                <p>Hello, you sent a request to recover your account password. Please use the following temporal credentials to sign into your account.<p>
                                <p>Please make sure to change your password to a more secure one immediately you sign in.</p>
                                <p><strong>Email Address</strong>: Your accounht email address<br>
                                   <strong>Password: </strong> ". $tmp_password. "</p>
                            </div>
                        </body>
                    </html>";

        $Settings->transaction_start();
           $sql    = "UPDATE ".$this->login_table." SET password = '{$tmp_password_hash}' WHERE user_id_fk = '{$user_id}' LIMIT 1";
           if (!$database->query($sql)) {
              $Settings->transaction_rollback();
              return "Oops! an error occured whilst procesing your information.";
           }

           if ($Email->send($to, $subject, $message)) return "Oops1, an error occured whilst send recovery message.";
        $Settings->transaction_commit(); //commit if everything was OK

        return "A recovery email message was sent successfully to ". $email.
               ". Please check your inbox to recover your account.";
    }

    public function is_admin() {
        return ($this->user_role >= 2) ? true : false;
    }

    public function is_moderator() {
        return ($this->user_role >= 1) ? true : false;
    }

    public function isActivated($user_id=0) {
        global $database;

        $user_id = (int)$database->clean_data($user_id);
        if ($user_id == 0) return $this->activated;

        $sql = "SELECT activation FROM ".$this->login_table." WHERE user_id_fk = '{$user_id}' LIMIT 1";
        $result = $database->query($sql);
        return ($database->fetch_data($result)->activation == null) ? true : false;
    }
    
    public function user() {
        $user = array("id"         => (int)$this->user_id,
                       "name"      => $this->username,
                       "fullname"  => $this->fullname,
                       "email"     => $this->user_email,
                       "level"     => $this->user_role
                      );
        return $user; 
    }

    public function register($post=null) {
        global $database, $secure, $Email, $Settings;
         
        if(!isset($post['agreed'])) return "You must agree to the terms and conditions to sign up";
        if(!isset($post['gender'])) return "Please select your gender";

        $fname = $database->clean_data($post['fname']);
        $lname = $database->clean_data($post['lname']);
        $gender = ($database->clean_data($post['gender']) == "M") ? "M" : "F";
        $uname = $database->clean_data($post['uname']);
        $email = $database->clean_data($post['email']);
        $pass1 = $post['pass1']; //not sanatized since it will be hashed
        $pass2 = $post['pass2'];

        $result = $secure->validate_name($fname, "fname");
        if($result !== "OK") return $result;

        $result = $secure->validate_name($fname, "lname");
        if($result !== "OK") return $result;

        $result = $secure->validate_email($email);
        if($result !== "OK") return $result;

        $result = $secure->validate_username($uname);
        if($result !== "OK") return $result;
        
        if($pass1 !== $pass2) return "The two passwords donnot match";

        $result = $secure->check_password_strength($pass1);
        if($result !== "OK") return $result;
        $hashed_password = $secure->secure_password($pass1);


        //Insert data into users table
        $Settings->transaction_start();

        $date = time();
        $sql  = "INSERT INTO ".$this->users_table." (username, first_name, last_name, gender, date_registered) ";
        $sql .= "VALUES ('{$uname}', '{$fname}', '{$lname}', '{$gender}', '{$date}')";
        if (!$database->query($sql)) {
            $Settings->transaction_rollback();
            return "Oops!, error inserting account information";
        }

        $last_id = $database->insert_id();
        $activation_key = md5($fname.$email.time()); 
        
        //insert login data into login table
        $sql  = "INSERT INTO ".$this->login_table." (user_id_fk, email, password, activation) ";
        $sql .= "VALUES ('{$last_id}', '{$email}', '{$hashed_password}', '{$activation_key}')";

        if (!$database->query($sql)) {
            $Settings->transaction_rollback();
            return "Oops!, an error occured whilst creating your account. <br />Please try again later.";
        }
        $Settings->transaction_commit();


        // Send account activation email

        //if all credentials are valid, send mail activation email
        $site_name = $Settings->site_name();
        $subject   = $site_name. " Account Activation";
        
        $activation_uri = SITE_URI. "/activation/" .$last_id. "/".$activation_key;
        $message = "<!doctype HTML>
                    <html lang='en'>
                    <head>
                        <meta charset='utf-8'>
                        <title>{$subject}</title>
                    </head>
                    <body style='background: #ffffff'>
                        <div style='width: 100%; text-align: center; font-size: 16px;'>
                            <h1>{$site_name} Account Activation</h1>

                            <p style='margin: 30px 0'><strong>Hello Dear</strong>, your account on {$site_name} is 
                            awaiting activation. <br />Click on the link bellow to activate your account.</p>

                            <p style='margin: 30px 0'>Delete this message if you did not make any registration as such.</p>
                            
                            <br /><br /><br />
                            <p> <a href='{$activation_uri}' target='_blank'>Activate my account now</a> </p><br />

                            <h3>{$site_name}</h3>
                            <p><small>Super genuine information</small></p>
                        </div>
                    </body>
                    <html>";

        $Email->send($email, $subject, $message);

        return "Account created successfully! <br />A confirmation message has been sent to " .$email. 
               ". <br />Please check your inbox to activate your account.";
    }
}

$session = new Session();
?>