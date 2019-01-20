<?php
	$m = new MongoClient();
	$db = $m->brabm;
	$routes=$db->routes->find();
?>

<html>
<head>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2
}

table.up{
	width:45%;
	float:left;
}
table.down{
	width:45%;
	float:left;
	margin-left:2%;
}
</style>
<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div class="login-page">
	<div class="form2">

<?php

if(isset($_POST['Submit']))
{
	echo "<caption align=center>".$_POST['Route']."</caption>";
	if($_POST['Route']!="0")
	{	
		//UP
		echo"<table class=\"up\"><caption>Up</caption><tr><th>Stop No.<th>Stop Name</tr>";
		$route=$db->routes->findOne(array("_id"=>$_POST['Route']));
		$stopsup=$route['StopsUp'];
		$stop=$db->depot->findOne(array("_id"=>$stopsup[0]));
		echo "<tr><td>".$stop['_id']."<td>".$stop['Depot_Name']."</tr>";
		
		$arrlength = count($stopsup);
		for($x = 1; $x < $arrlength-1; $x++) 
		{
			$stop=$db->stop->findOne(array("_id"=>$stopsup[$x]));
			echo "<tr><td>".$stop['_id']."<td>".$stop['Stop_Name']."</tr>";
		}
		
		$stop=$db->depot->findOne(array("_id"=>$stopsup[$x]));
		echo "<tr><td>".$stop['_id']."<td>".$stop['Depot_Name']."</tr>";
		
		
		//DOWN
		echo"<table class=\"down\"><caption>Down</caption><tr><th>Stop No.<th>Stop Name</tr>";
		$route=$db->routes->findOne(array("_id"=>$_POST['Route']));
		$stopsdown=$route['StopsDown'];
		
		$arrlength = count($stopsdown);
		$stop=$db->depot->findOne(array("_id"=>$stopsdown[0]));
		echo "<tr><td>".$stop['_id']."<td>".$stop['Depot_Name']."</tr>";
		
		for($x = 1; $x < $arrlength-1; $x++) 
		{
			$stop=$db->stop->findOne(array("_id"=>$stopsdown[$x]));
			echo "<tr><td>".$stop['_id']."<td>".$stop['Stop_Name']."</tr>";
		}
		
		$stop=$db->depot->findOne(array("_id"=>$stopsdown[$x]));
		echo "<tr><td>".$stop['_id']."<td>".$stop['Depot_Name']."</tr>";
		
		echo "</table>";
	}
}
else
{
	
?>
		<form class="login-form" method="POST">

<select name="Route" required>
<option value="" hidden>Select Route</option>;
	<?php
	foreach ($routes as $document) {
	echo "<option value=".$document['_id'].">".$document['_id']."</option>";
	}
	?>
</select>
<button type="Submit" name="Submit">Go</button>
		</form>
<?php
}

$m->close();
?>

		</div>
	</div>   

</html>