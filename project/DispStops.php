<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
	background-color:white;
}
</style>
<link rel="stylesheet" type="text/css" href="maincss.css">
</head>
<div class="password">
<body>
<form method="post">
<input type="text" name="Route" />
<input type="Submit" name="Submit" value="Submit"/>
</form>
<table>
<tr>
	<th>Stop No.
</tr>

<?php
	$m = new MongoClient();
	$db = $m->brabm;
	
	if(isset($_POST['Submit']))
	{
	$stops=$db->routes->find(array("_id"=>$_POST['Route']),array("Stops"=>"1"));
foreach ($stops as $document) {
	
	$s=$document['Stops'];
	$arrlength = count($s);
	for($x = 0; $x < $arrlength; $x++) {
    echo $cars[$x];
    echo "<br>";
}
echo "<tr><td>".$s['_id']."</tr>";
}
	}
?>

</table>
</div>
</html>