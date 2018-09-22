<?php

class Debug {

    public static function assertion($condition, $msg) {
        if ($condition && DEBUG_MODE) echo "<hr /><p style='color:red'>". $msg. "</p></hr>";
    }
}
?>
