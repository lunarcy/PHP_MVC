<?php

/**
* A Class for accessing MySQL DB
* Only for Demo features, no Error Control
*/
class DBI {
	public $dbh; //--for DB connection.
	public $query; //--for query string.  

	//! Constructor
	/**
	* Create a new DBI object.
	* @param $host, DB server name,
	* @param $user, DB server username,
	* @param $pswd, DB server login password,
	* @param $db, DB name.
	*/
	public function __construct($host, $user, $pswd, $db) {
		$this->dbh = mysql_pconnect($host, $user, $pswd); //Persist Connect to DB.
		mysql_select_db($db, $this->dbh);	// Choose the right database .
		
		// Check DBH connection.
		if (mysqli_connect_errno($this->dbh))
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}	
	}
	
	//! Excute SQL statement.
	/**
	* Excute SQL statement, get a query string, and store it to $query. 
	* @param $sql, SQL statement,
	* @return void,
	*/
	public function fetch($sql) {
		$this->query = mysql_unbuffered_query($sql, $this->dbh); // perform query here.
		if($this->query)
			return true;
		else
			error_log("DB Error: ".mysql_errno($this->dbh)." | ".mysql_error($this->dbh));
			return false;
	}

	//! Retrieve a record row.
	/**
	* Return the records as Array, call this functio in a loop can get all the records. 
	* @return mixed,
	*/
	public function getRow() {
		if($row = mysql_fetch_array($this->query, MYSQL_ASSOC)) //MYSQL_ASSOC for array 'Key' name style.
			return $row;
	}
	
	//! Retrieve all records.
	/**
	* Return the records as Array, call this functio in a loop can get all the records. 
	* @return mixed,
	*/
	public function getAllRows() {	
		$rows = array();
		$i=0;
		while($row = mysql_fetch_array($this->query, MYSQL_ASSOC)) { //MYSQL_ASSOC for array 'Key' name style.
			$rows[$i++] = $row;
		}
		return $rows;
	}
}

?>
