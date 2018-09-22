<?php

class Admin extends GlobalObject {
    protected static $table_name = "admin";
    protected static $table_columns = ["id", "fname", "lname", "email", "password", "role", "last_login"];

    public $id,
            $fname,
            $lname,
            $email,
            $password,
            $role,
            $last_login;
    

    public static function authenticate($email="", $password="") {
        global $database, $secure;

        $sql  = "SELECT * FROM ".static::$table_name." WHERE email = '";
        $sql .= $database->cleanData( $email ). "' LIMIT 1";
        $records = static::findBySQL($sql);

        if (empty($records)) return false;
        return ($secure->passwordVerify($password, $records[0]->password)) ? $records[0] : false;
    }

    private function logLogin() {
        $this->last_login = time();
        $this->save();
    }
}
?>