<!DOCTYPE html>
<html>
<head>
<script src="https://www.google.com/jsapi"></script>
<script>
google.load('jquery', '1.6.2');
</script>
<link rel="stylesheet" type="text/css" href="css/test.css">
<h2>Show Notes</h2>
</head>
<body>

<h1>Show all posted Notes</h1>

<script type="text/javascript">
google.setOnLoadCallback(function() {
	$('button').click(function(){
		$name = $(this).attr('name');
		$('#out').empty().load('123.php', {name: $name});
	});
});
</script>

<?php
require_once('lib/DataAccess.php');
require_once('lib/Model.php');

$dao = & new DBI('localhost', 'bin', 'jbzp123', 'phpWeb');
$model = & new Model($dao);
$model->listNote();

while ($note = $model->getNote())
{
	$output .= "Title: <h3>$note[title]</h3> Note: <br /> $note[content] <br /> <hr /> ";
}

 if (strcmp($output, "")==0)
//if ($output="")
	$output="No data.";
	
echo $output;
?>

<button id="btn-1" name="1">1</button>
<button id="btn-2" name="2">2</button>
<button id="btn-3" name="3">3</button>
<div id="out"></div>
</body>
</html>
