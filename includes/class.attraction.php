<?php

class Attraction extends GlobalObject {
    protected static $table_name = "attractions";
    protected static $link_table_name = "packages_attractions_link";
    protected static $table_columns = ["id", "name", "description", "publish", "photo_thumb_filename", "alt_text", "price", "tour_duration", "education_level", "physical_level", "tour_scale", "movement_means"];

    protected $upload_errors = array(
    	// http://www.php.net/manual/en/features.file-upload.errors.php
    	UPLOAD_ERR_OK           => "Saved successfully!",
    	UPLOAD_ERR_INI_SIZE     => "File is larger than upload maximum size.",
    	UPLOAD_ERR_FORM_SIZE    => "File is larger than form MAX_FILE_SIZE.",
    	UPLOAD_ERR_PARTIAL      => "File upload was incomplete.",
    	UPLOAD_ERR_NO_FILE      => "No file was selected.",
    	UPLOAD_ERR_NO_TMP_DIR   => "No temporal directory is set in system.",
    	UPLOAD_ERR_CANT_WRITE   => "Can't write to disk.",
    	UPLOAD_ERR_EXTENSION    => "File upload stopped by extension."
    );

    public  $id,
            $name,
            $description,
            $photo_thumb_filename,
            $caption,
            $publish,
            $upload_file,
            $errors = [];

    protected
            $file_name,
            $file_type,
            $file_size,
            $file_error,
            $file_tmp_name,
            $allowed_extensions = ["png", "jpg", "jpeg", "gif"];

    protected static $GB = 1073741824,
                     $MB = 1048576,
                     $KB = 1024,
                     $max_upload_size = 1048576;

    public static function findPublished() {
        return static::findBySQL("SELECT * FROM ".static
        ::$table_name." WHERE publish='1' ORDER BY name ASC");
    }

    public static function findPackageAttractions($package_id=0) {
        global $database;

        $package_id = (int)$database->cleanData($package_id);

        // Query attractions linked to package
        $link_result = $database->query("SELECT attraction_id_fk FROM " .static::$link_table_name. " WHERE package_id_fk = '". $package_id ."'");

        if ($database->numRows($link_result) < 1) return false;

        $attractions_ids = array();
        while ($r = $database->fetchData($link_result)) {
            $attractions_ids[] = $r->attraction_id_fk;
        }

        // Now query attractions with the queried link IDs
        $sql = "SELECT * FROM ". static::$table_name ." WHERE id = '0'";
        foreach ($attractions_ids as $id) {
            $sql .= " OR id = '". $id ."'";
        }
        $sql .= ""; // Sort ttractions if required for iternary

        $result = $database->query($sql);
        if ($database->numRows($result) < 1) return false;

        $attractions = array();
        while ($row = $database->fetchData($result)) {
            $attractions[] = $row;
        }

        return $attractions;
    }

    protected function getFileUploadPath() {
        return PHOTOS_DIR;
    }

    public static function getFileExtension($file_name="") {
    	$exp_array = explode(".", basename($file_name));
        return $exp_array[count($exp_array) -1];
    }

    //Returns a file size as text
    public static function sizeAsText($file_size) {

    		if ($file_size < static::$KB) {
    			return "{$file_size} bytes";
    		} elseif ($file_size < static::$MB) {
    			return round($file_size/static::$KB) . "KB";
    		} elseif ($file_size < static::$GB) {
    			return round($file_size/static::$MB, 1) ."MB";
    		} else {
                return round($file_size/static::$GB, 1) . "GB";
    		}
    }

    /* Save uploaded file information into class object
    **********************************************************************/
    public function attachFile($file=null) {

        if (isset($file['name'])) {
            $this->file_name = basename($file['name']);
        } else {
            $this->errors[] = "Please enter a name for this attraction";
            return false;
        }

        if (isset($file['name'][39])) {
            $this->errors[] = "Photo file name must not exceed 40 characters";
            return false;
        }

        if (!in_array( static::getFileExtension($this->file_name) , $this->allowed_extensions)) {
            $this->errors[] = "File extension is not supported";
            return false;
        }

        if ((int)$file['size'] > static::$max_upload_size) {
            $this->errors[] = "Image file must not be greater than " .static::sizeAsText(static::$max_upload_size);
            return false;
        }


        if ( (int)$file['error'] !== 0 ) {
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        }


        if (!isset($file['tmp_name'])) {
            $this->errors[] = "File temporal name was not set";
            return false;
        }

        $this->file_name = $file['name'];
        $this->file_error = $file['error'];
        $this->file_size = $file['size'];
        $this->file_tmp_name = $file['tmp_name'];

        return true;
    }

    public function save() {
        if (!isset($this->id)) {
            return ($this->create()) ? true : false;
        } else {
            /*
            * First validate to make sure cation is set
            * if user uploaded a new photo,
                1. Attach file to object instance
                2. Validate file file does not already exist
                3. Move temporal file to destination
            *****************************************************************/
            if (!isset($this->alt_text[0])) {
                $this->errors[] = "Please enter an alternative text for photo";
                return false;
            }

            if (isset($this->upload_file)) {

                if (!$this->attachFile($this->upload_file)) {
                    $this->errors[] = "Failed to attach uploaded file";

                    return false;
                }

                if (is_file($this->getFileUploadPath().DS.$this->file_name)) {
                    $this->errors[] = $this->file_name . " already exist";
                    return false;
                }


                /* create drectory fi does not exist
                ************************************************************/
                if (!is_dir($this->getFileUploadPath())) {
                    mkdir($this->getFileUploadPath(), 755, true);
                }

                /* @ Move file from tem dir to destination
                ***********************************************************/
                //echo "<hr>cehking move file";
                if (!move_uploaded_file($this->file_tmp_name, $this->getFileUploadPath().DS.$this->file_name)) {
                    $this->errors[] = "Could not move file to destination";
                    return false;
                }

                //Delete current file
                if (is_file($this->getFileUploadPath().DS.$this->photo_thumb_filename)) {
                    unlink($this->getFileUploadPath().DS.$this->photo_thumb_filename);
                }

                /**
                 * Set $this->photo_thumb_filename to current file
                 * Note: This action must be right here, after the unlink action above
                 */
                $this->photo_thumb_filename = $this->file_name;
            }

            // Validate to make sure file is uploaded for unedited attractions
            if (!isset($this->photo_thumb_filename[0])) {
                $this->errors[] = "Please choose an image file for attraction";
                return false;
            }

            if (!parent::save()) {
                $this->errors[] = "Oops! could not save atraction.";
                return false;
            }

            $this->errors[] = "Attraction saved successfully!";
            return true;
        }
    }

    public function delete() {
        if (is_file($this->getFileUploadPath().DS.$this->file_name)) {
            unlink($this->getFileUploadPath().DS.$this->file_name);
        }
        return (parent::delete() === true) ? true : false;
    }
}
?>
