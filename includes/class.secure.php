<?php
class Secure {
 
    /* Hashing Methods
    ****************************************************************/
    //generates a salt for hashing
    private function generateSalt($length=22) {
        $length = (int)$length;
        $len    = ($length >= 22) ? $length : 22;
        
        $unique_str = md5(uniqid(mt_rand(), true));
        $base64     = base64_encode($unique_str);
        $modified   = str_replace("+", ".", $base64);
        return substr($modified, 0, $len);
    }
    
    // returns a hashed password
    public function passwordHash($password="") {
        $hash_type     = "$2y$11$";
        $salt          = $hash_type.$this->generateSalt(22);
        return crypt($password, $salt);
    }
    
    //verify a hashed password with existing password
    public function passwordVerify($password="", $hash_password="") {
        return (crypt($password, $hash_password) === $hash_password) ? true : false;
    }




     /* Validation Methods
    ****************************************************************/

    /* Check passwors strenght and returns 'OK' 
       iwhen succeeds or erroe maeesge if fails
    */
    public function passCheckStrength($password="") {
        // Validate
        if(!isset($password[7])) {
            return "Password must be at least 8 characters"; // validate length
        } elseif(!preg_match('/([a-z]+)/', $password)) {
            return "Password must include a lower case alphabet"; // validate lowercase
        } elseif(!preg_match('/([A-Z]+)/', $password)) {
            return "Password must include an upper case alphabet"; // validate uppercase
        } elseif(!preg_match('/([0-9]+)/', $password)) {
            return "Password must include a numeric character"; // validate numeric charaters
        } elseif(!preg_match('/([^a-zA-Z0-9]+)/', $password)) {
            return "Password must include a symbol"; // validate symbols
        } 
        return "OK";
    }

    public function validateEmailAddress($email="") {
         global $database;

         $table  = ($table == "login") ? $this->login_table : $this->users_table;
         $column = ($table == "login") ? "email" : "contact_email";

         if (!filter_var($email, FILTER_validateEmailAddress)) {
            return "Your email address is invalid";
         } elseif (isset($email[39])) {
             return "Email address is too long";
         }

         //validate for duplicate in database
         $sql = "SELECT * FROM ".$table." WHERE ".$column." = '{$email}' LIMIT 1";
         $result = $database->query($sql);
         if($database->num_rows($result) == 1) return "This email address is already in use.";
         return "OK";
    }

    public function validateUsername($user_name="") {
        global $database;

        $user_name = $database->clean_data($user_name);

        if (!preg_match('/([a-zA-Z]+)/', $user_name)) {
            return "Username must contain at least a single alphabet";
        } elseif (!preg_match('/([a-zA-Z0-9_-]+)/', $user_name)) {
            return "Username must contain only alphanumeric character and or underscore";
        }

        $sql    = "SELECT * FROM ".$this->users_table." WHERE user_name = '{$user_name}' LIMIT 1";
        $result = $database->query($sql);
        if ($database->num_rows($result) == 1) return "Username is already in use";
        return "OK";
    }

    // Validate users permisiion using password (used when deleting user)
    public function checkPermission($victim_id=0, $admin_password="") {
       global $database, $session;
       
       $session_u     = $session->user();
       $session_id    = $session_u['id'];
       $session_level = $session_u['level'];
       $victim_id     = (int)$database->clean_data($victim_id);
       
       // Fetch session user's level
       $sql     = "SELECT * FROM ".$this->login_table." WHERE admin_id = '{$session_id}' ";
       $sql    .= "LIMIT 1";
       $result  = $database->query($sql);
       $row_session = $database->fetch_data($result);
       
       //Fetch victim's level
       $sql    = "SELECT level FROM ".$this->login_table." WHERE admin_id = '{$victim_id}' ";
       $sql   .= "LIMIT 1";
       $result = $database->query($sql);

       if($database->num_rows($result) != 1) return 0;
       $row_victim   = $database->fetch_data($result);

       // Check user's permission to delete victim
       if(($session_level <= $row_victim->level) && ($session_level != PERMS_SUPER_ADMIN)) return 2; 
       return ($this->passwordVerify($admin_password, $row_session->password) === true) ? 1 : 0;
    }

    //for authenticating users permission to take an action
    public function authenticate($email="", $password="") {
        global $database, $session;

        $session_u     = $session->user();
        $session_id    = $session_u['id'];
        $session_level = $session_u['level'];
        if(empty($password)) return "Access denied";
       
        // Fetch session user's level
        $sql    = "SELECT * FROM ".$this->login_table." WHERE admin_id = '{$session_id}' ";
        $sql   .= "LIMIT 1";
        $result = $database->query($sql);
        $row    = $database->fetch_data($result);
        $level = (int)$database->clean_data($level);
        if($row->level < $level) return "Access denied. You donnot have permission";
        return ($this->passwordVerify($password, $row->password) === true) ? "Access granted" : "Access denied";
    }
}

$secure = new Secure();
?>