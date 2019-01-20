<?php
	$m = new MongoClient();
	$db = $m->brabm;
	$depots=$db->depot->find();
	

	if(isset($_POST['Submit']))
	{
		$number=$_POST['number'];
		$bus=$db->bus->findOne(array("_id"=>$_POST['number']));
		if($bus == null)
		{
		$collection = $db->bus;	
		$depot=$_POST['Depot'];
		$collection->insert(array("_id"=>$number,"Depot"=>$depot));
		}
		else
		{
			?><script> alert("The Bus No. You Entered Is Already Added!!!!!!");</script>
			<?php  
		}
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
	
<caption><h3>New Bus</h3></caption>
<tr>
	<td>Number:
	<td><input type="text" name="number">
</tr>

<tr>
	<td>Depot:
	<td>
	<select name="Depot">
	<?php
		foreach ($depots as $document) {
		echo "<option value=".$document['_id'].">".$document['_id']." - ".$document['Depot_Name']."</option>";
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
