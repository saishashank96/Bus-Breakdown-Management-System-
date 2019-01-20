<?php
	
	$m = new MongoClient();
	$db = $m->brabm;
	$depot=$db->depot->find();

	if(isset($_POST['Submit']))
	{
		$collection = $db->stop;	
		$No=$_POST['No'];
		$Name=$_POST['Name'];
		$DNo=$_POST['Depot'];

		$document = array( "_id" => "$No", 
		"Stop_Name" => "$Name", 
		"Nearest_Depot" => "$DNo");

		$collection->insert($document);
		$m->close();
	}
?>
<html>
<head>
<style>
table, th, td {
    border: 0px solid black;
    border-collapse: collapse;
}
</style>
	<link rel="stylesheet" type="text/css" href="maincss.css">
</head>
<body>
	
<div class="main1">
<form method="post">
<table align="center">
	
<caption><h3>New Stop</h3></caption>
<tr>
	<td>Stop ID:
	<td><input type="text" name="No">
</tr>
<tr>
<tr>
	<td>Name:
	<td><input type="text" name="Name">
</tr>
<tr>
	<td>Nearest Depot:
	<td>
	<select name="Depot">
	<?php
	foreach ($depot as $document) {
	echo "<option value=".$document['_id'].">".$document['_id']." ".$document['Depot_Name']."</option>";
	}
	?>
 	</select>
</tr>


<tr>
	<td colspan="2" align="center"><input type="submit" value="Submit" name="Submit">
</tr>
</table>
</form>
</div>
	

</body>
</html>
