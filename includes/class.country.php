<?php
class Country extends GlobalObject {
	protected static $table_name = "countries";

	protected static $table_columns = ["id", "name", "abbreviation", "phone_code"];

	public $id, 
	       $name,
	       $abbreviation,
	       $phone_code;
	
}
?>