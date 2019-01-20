<?php
	$m = new MongoClient();
	$db = $m->brabm;
	
	$buses=$db->bus->find();
	$conductor=$db->employee->find(array("designation"=>"Conductor"));
?>	

<html>
<head>
<style>
table, th, td {
    border: 0px solid black;
    border-collapse: collapse;
}
#divId{
display:none;
}
</style>
	<link rel="stylesheet" type="text/css" href="maincss.css">
</head>
<body>
	
<div class="main1">
<form method="post">
<table align="center">
	
<caption><h3>Schedule Bus</h3></caption>


<?php
if(isset($_POST['Submit1']))
	{
		$bus=$db->bus->findOne(array("_id"=>$_POST['bus']),array("Depot"=>1));
		$routes=$db->routes->find(array("StopsUp.0"=>$bus['Depot']));
?>
<tr>
<td>Bus ID:</td>
<td><input name="bus1" type="text" value=<?=$_POST['bus']?> readonly></td></tr>
<tr>
	<td>Conductor ID:</td>
	<td>
	<select name="cond">
	<?php
		foreach ($conductor as $document) {
		echo "<option value=".$document['_id'].">".$document['_id']."</option>";
		}	
	?>
	</td>
 	</select>
</tr>
<tr>
	<td>Route:</td>
	<td>
	<select name="route" id="route">
	<?php
		foreach ($routes as $document) {
		echo "<option value=".$document['_id'].">".$document['_id']."</option>";
		}	
	?>
 	</select>
	</td>
</tr>
<tr>
	<td>Departure Time:</td>
	<td><input type="time" name="Dep_time"></td>
</tr>
<tr>
	<td>Arrival Time:</td>
	<td><input type="time" name="Arr_time"></td>
</tr>
<tr>
	<td colspan="2" align="center"><button type="submit" value="Submit" name="Submit2">Submit</button></td>
</tr>
<?php
	}
	elseif(isset($_POST['Submit2']))
	{
		$collection = $db->schedule;	
		$bus=$_POST['bus1'];
		$cond=$_POST['cond'];
		$Dep_time=$_POST['Dep_time'];
		$Arr_time=$_POST['Arr_time'];
		$route=$_POST['route'];
		$collection->insert(array("Bus"=>$bus,"Conductor"=>$cond,"Route"=>$route,"Dep_time"=>$Dep_time,"Arr_time"=>$Arr_time));
	}
	else
	{
		?>
		<tr>
	<td>Bus Number:</td>
	<td><select name="bus" id="bus">
	<?php
		foreach ($buses as $document) {
		echo "<option value=".$document['_id'].">".$document['_id']."</option>";
		}	
	?>
	<tr>
	<td colspan="2" align="center"><button type="submit" value="Submit" name="Submit1">Submit</button>
	</tr>
	
	<?php
	}
	$m->close();
	?>
	</td>
 	</select>
</tr>
	
</table>
</form>
</div>
	

</body>
</html>
