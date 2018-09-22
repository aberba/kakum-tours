<?php
class GlobalObject {

	protected static $table_name    = "";

	protected static $table_columns = [];

	public $id;

    /* Common Class Methods
    *****************************************************************/
    public static function findById($id=0) {
    	global $database;

	    $sql = "SELECT * FROM ". static::$table_name. " WHERE id='".
	    	    (int)$database->cleanData($id). "' LIMIT 1";

	    $records = static::findBySQL($sql);
	    return (!empty($records)) ? $records[0] : false;
	}

	public static function findAll() {
	    return static::findBySQL("SELECT * FROM ". static::$table_name);
	}

	public static function findBySQL($sql="") {
		global $database;

	    $result = $database->query($sql);
	    if (!$result || $database->numRows($result) < 1) return false;

        $output = array();
	    while ($record = $database->fetchData($result)) {
	        $output[] = static::instantiate($record);
	    }
	    return $output;
	}

	protected static function instantiate($record) {
		$object = new static();

		foreach ($record as $column => $value) {
			if (static::hasColumn($column)) {
				$object->$column = $value;
			}
		}
		return $object;
	}

	protected static function getTableColumns() {
		return static::$table_columns;
	}

	protected static function hasColumn($column) {
		return in_array($column, static::getTableColumns()) ? true : false;
	}

	public function save() {
		return ( isset($this->id) ) ? $this->update() : $this->create();
	}

	protected function create() {
		global $database;

        $column_values = [];
        foreach (static::getTableColumns() as $column) {
        	$column_values[] =  $database->cleanData( $this->$column , "<a>");
        }

		$sql = "INSERT INTO " .static::$table_name . " (";
        $sql .= join(", ", static::getTableColumns());
		$sql .= ") VALUES ('";
		$sql .= join("', '", $column_values);
		$sql .= "')";

		if ($database->query($sql)) {
			$this->id = $database->insertId();
			return true;
		} else {
			return false;
		}
	}


	protected function update() {
		global $database;

        $column_pairs = [];
		foreach (static::getTableColumns() as $col) {
			if ($col == "id") continue;
			$column_pairs[] = "{$col}='". $database->cleanData( $this->$col ) ."'";
		}

        $sql  = "UPDATE " .static::$table_name. " SET ";
		$sql .= join(", ", $column_pairs);
		$sql .= " WHERE id='" .$database->cleanData( $this->id ). "' LIMIT 1";

		$result = $database->query($sql);
		return ( $database->affectedRows() == 1 ) ? true : false;
	}

	public function delete() {
		global $database;

		$sql  = "DELETE FROM ". static::$table_name. " WHERE id='";
		$sql .= $database->cleanData($this->id) ."' LIMIT 1";
		$result = $database->query($sql);

		return ($database->affectedRows() == 1) ? true : false;
	}
}
?>
