<?php

class Package extends Attraction {
    protected static $table_name = "packages";
    protected static $table_columns =
          ["id", "name", "description", "photo_thumb_filename",
           "photo_slide_filename", "caption", "status", "publish", "start_date",
           "end_date", "date_added"];

    public $id,
           $name,
           $description,
           $photo_thumb_filename,
           $photo_slide_filename,
           $caption,
           $status,
           $publish,
           $start_date,
           $end_date,
           $date_added;

}
?>
