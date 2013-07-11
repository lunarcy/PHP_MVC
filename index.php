<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" /> 
<title>PHP MVC Notebook</title>
<script src="https://www.google.com/jsapi"></script>
<script>
google.load('jquery', '1.6.2');
</script>
<link rel="stylesheet" type="text/css" href="css/test.css">
</head>
<body>
<a href="postNote.htm">Post a new Note</a><br>
<p>

<?php
//! Index.php
/**
* this page called for:
* display notes: index.php?action=list
* post new notes: index.php?action=post
* delete a note: index.php?action=delete&id=n
*/
require_once('lib/DataAccess.php');
require_once('lib/Model.php');
require_once('lib/Controller.php');
require_once('lib/View.php');

//create a DataAccess DBI obj
$dao = & new DBI('localhost', 'bin', 'jbzp123', 'phpWeb');
// call the controller subclass based on the value of $_GET["action"].
$action = $_GET["action"];

//error_log($_REQUEST["title"]);

switch ($action) {
	case "list";
		$controller = & new listController($dao); 
		break; 
	case "post";
		$controller = & new postController($dao, $_REQUEST);
		break;
	case "delete";
		$controller = & new deleteController($dao, $_REQUEST["id"]);
		break;
	default:
		$controller = & new listController($dao);
		break;
}

/*$action = (in_array($action, array('post', 'list', 'delete')) ? $action : 'list').'Controller';
$controller = new $action();
*/
$view = $controller->getView();
$view->display();
?>

<div id="deleteResult">delete Result</div>

<script type="text/javascript">

//-- When Use AJAX JQuery, Input.Button will stay the same page, and show the response Data.
//-- a.href="" will reload the page, with updated displaying rows.
$(document).ready(function() {
	if($.urlParam('action') == 'list'){
		$('input.deleteBtn').click( function() { 
			var id = $(this).attr("id");
			$.post('/bindev/index.php?action=delete&id='+id, $().serialize(), function(data){
				$('div#deleteResult').html(data);
				setTimeout( function(){	// refresh the page in 3 sec.
					window.location.reload();
				}, 3000);
				
			});
		});
		
		
		var auto_refresh = setInterval( function () {
			$('#deleteResult').load('http://localhost/bindev/test.php p#watch').fadeIn("slow");
		}, 5000); // refresh every 2000 milliseconds

	}
});

//-- JQuery get the URL param.
$.urlParam = function(name){
    var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}
</script>

</body>
</html>