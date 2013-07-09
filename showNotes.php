<!DOCTYPE html>
<html>
<head>
<h2>Show Notes</h2>
</head>
<body>

<h1>Show all posted Notes</h1>


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

</body>
</html>
