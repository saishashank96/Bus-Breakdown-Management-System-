<?php
	$m = new MongoClient();

	$db = $m->brabm;
$depots=$db->depot->find();
if(isset($_POST['Submit']))
{


	$collection = $db->employee;

	$eid=$_POST['eid'];
	$pwd=$_POST['pwd'];
	$name=$_POST['Name'];
	$addr=$_POST['Address'];
	$gender=$_POST['gender'];
	$mob=$_POST['mob'];
	$dob=$_POST['dob'];
	$des=$_POST['Designation'];
	
	$depot=$_POST['Depot'];

	$document = array( "_id" => "$eid", 
	"password" => md5("$pwd"), 
	"name" => "$name", 
	"address" => "$addr", 
	"mobile" => "$mob", 
	"dob" => "$dob",
	"designation" => "$des",
	"Depot"=>"$depot");

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
	
<caption><h3>New Employee</h3></caption>
<tr>
	<td>ID:
	<td><input type="text" name="eid" required>
</tr>
<tr>
	<td>Pwd:
	<td><input type="text" name="pwd" required> 
</tr>
<tr>
	<td>Name:
	<td><input type="text" name="Name"required>
</tr>
<tr>
<tr>
	<td>Gender:
	<td><input type="radio" name="gender" value="male" checked > Male
  	    <input type="radio" name="gender" value="female"> Female
</tr>
	<td>Address:
	<td><input type="text" name="Address" required>
</tr>
<tr>
	<td>DOB:
	<td><input type="date" name="dob" min="1956-01-01" max="1998-12-31" required >
</tr>
<tr>
	<td>Mobile:
	<td><input type="tel" name="mob" required>
</tr>
<tr>
	<td>Designation:
	<td>
	<select name="Designation" required>
	   	 <option value="" hidden>-- Select --</option>
   	 <option value="Conductor">Conductor</option>
   	 <option value="Manager">Manager</option>
 	</select>
</tr>
<tr>
	<td>Depot:
	<td>
	<select name="Depot" required>
	<option value="" hidden>-- Select --</option>
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
