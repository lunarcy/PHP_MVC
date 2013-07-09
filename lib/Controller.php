<?php
//! Controller

require_once('DataAccess.php');
require_once('Model.php');
/**
* Controller mapping the params (list, post, delte)
* from $_GET['action'] to the subclass of Controller.
* 
*/
class Controller {
	public $model;	//Model Object
	public $view;	//View object

	//! Construct
	//Model obj store in member variable $this->model.
	public function __construct(& $dao) {
		$this->model=& new Model($dao);
	}
	
	//return the View obj, 
	//to the specific feature of the Controller subclass, generate according View subclass obj.
	public function getView() { 
		return $this->view;
	}
}

	//subclass of Controller to display notes list.
	class listController extends Controller { //extends means inherit. 
		public function __construct(& $dao){
			parent::__construct($dao); //inherit the parent class's construct. you can think it as copy the construct function code over to here.
			$this->model->listNote();
			$notes = $this->model->getNotes();
			$this->view=& new listView($notes);	//create View subclass for display, pass the Notes data to View subclass.
			// $this->view = & new listView($this->model); 
		}
	}
	
	//subclass of Controller to post notes list.
	class postController extends Controller { 
		public function __construct(& $dao, $post){	//create View subclass for post, $post is as $_POST, where has the notes input.
			parent::__construct($dao); //inherit the parent class's construct. 
			if ($this->model->postNote($post)) 
				$success=1;
		    else
				$success=0;
		    $this->view=& new postView($success, $post); //return if post note action success. 
			// $this->view = & new postView($this->model, $post); 
		}
	}
	
	//subclass of Controller to delete notes list.
	class deleteController extends Controller { 
		public function __construct(& $dao, $id){
			parent::__construct($dao);
			if ($this->model->deleteNote($id)) //create View subclass for delete, $id for specify which note to be deleted.
				$success=1;
			else
				$success=0;
			$this->view=& new deleteView($success);
			// $this->view = & new deleteView($this->model, $id); 
		}
	}
?>