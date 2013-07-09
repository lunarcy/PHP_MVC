<?php
//! Modelclass  

/**  
* It includes functions for Data manipulation.
* Like：Show, Insert, Delete the posts. 
*/
class Model {
	public $dao; //-- an object instance of a DBH class.
	
	//! Constructor
	/**
	* Create a new Model object.
	* @param $dao, is a DBI object,
	* This param is passing by reference(&$dao) to Model,
	* and stored in Model's member $this->dao
	* Model get the SQL by calling fetch method of $this->dao.
	*/
	public function __construct(&$dao){
		$this->dao = $dao;	
	} 			
	
	public function listNote() { //--fetch all notes. 
		if( $this->dao->fetch("SELECT * FROM mvc_notes") ){
			return true;
		}
		else
			return false;
	}
	
	public function postNote($post) {  //--Insert a new note.
		//$timedate=time()+8*3600;
		$user='bin';
		$title=$post['title'];
		$content=$post['content'];
		
		$sql = "INSERT INTO `phpWeb`.`mvc_notes` (`title`, `content`, `ndate`, `creator`) 
				VALUES ('$title', '$content', NULL, '$user')";
		// echo $sql;  // for Complicated query, <br />	
		// It's a common debug skill of echo out the query SQL, to make sure it's correct.
		//error_log($sql);
		if( $this->dao->fetch($sql) ) 
			return true;
		else
			return false;
	}
	
	function deleteNote($id) { //--Delete a note.
		$sql = "DELETE FROM `phpWeb`.`mvc_notes` WHERE `id`=$id;";  
		if( $this->dao->fetch($sql) )
			return true;
		else
			return false;		
	}
	
	public function getNote() { //-- get one mote.
		//--View will use this method to retrive data and Display it.
		if( $note=$this->dao->getRow() )
			return $note;
		else
			return false;	

	}

	public function getNotes() { //-- get one mote.
		//--View will use this method to retrive data and Display them.	
		if( $notes=$this->dao->getAllRows() )
			return $notes;
		else
			return false;	

	}
}

?>
