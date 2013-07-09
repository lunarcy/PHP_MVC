<?php
//! View class
/**
* View and subclass according to operation (list, post, delete)
* Called by Controller, to do the thing respectively.
*/
class View {
	//private $model;
	public $output; //string for output the HTML content.
	
	//! construct
	/**
	* store the param $model obj into the $this->model,
	* pass to the subclass for get the data. 
	*/
	public function __construct(&$model){
		$this->model = $model;
	}
	
	public function display() {
		echo($this->output);
	}
}

class listView extends View { //subclass for display notes
	public function __construct($notes) {
		foreach ($notes as $value)
		{	//echo "title: ".$value['title'];
			//error_log($value['title']);
			//-- When Use AJAX JQuery, Input.Button will stay the same page, and show the response Data.
			//-- a.href="" will reload the page, with updated displaying rows.
			$this->output.="<p><strong>Title:</strong>".$value['title']."</p>".
                     "<p><strong>Notes:</strong>".$value['content']."</p>".
					 "<p><strong>Name:</strong>".$value['creator']."</p>".
                     "<p><strong>Time:</strong>".$value['nDate']."</p>".
					 //"<p align=\"right\"><a class='deleteBtn' id=".$value['id']." href=\"\">Delete Note</a>".
					 "<p align=\"right\"><input class='deleteBtn' id=".$value['id']." type='button' value='Delete Note'>".
					 
                     "<hr />";
		}
	}
}

class postView extends View { //subclass for post a note
	public function __construct($success)
	{
		if ($success)
			$this->output="Post Success!<br><a href=\"".$_SERVER['PHP_SELF']."?action=list\">See Notes</a>";
		else
			$this->output="Post Fail!";
	}
}

class deleteView extends View { //subclass for delete a note  
	public function __construct($success)
	{ 
		if ($success)
			$this->output="Delete Success!<br><a href=\"".$_SERVER['PHP_SELF']."?action=list\">See Notes</a>";
		else
			$this->output="Delete Fail!";
	}
}

?>

