<?php
if(isset($_POST['Submit']))
{
$m = new MongoClient();

$db = $m->brabm;

$collection = $db->buses;

$bid=$_POST['bid'];
$pwd=$_POST['pwd'];
$name=$_POST['Name'];
$addr=$_POST['Address'];
$gender=$_POST['gender'];
$mob=$_POST['Mobile'];
$dob=$_POST['dob'];

$document = array( "_id" => "$eid", "password" => "$pwd", "name" => "$name", "address" => "$addr", "mobile" => "$mob", "dob" => "$dob" );

$collection->insert($document);
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
	<td>Bus ID:
	<td><input type="text" name="bid">
</tr>
<tr>
	<td>Pwd:
	<td><input type="text" name="pwd">
</tr>
<tr>
	<td>Name:
	<td><input type="text" name="Name">
</tr>
<tr>
<tr>
	<td>Gender:
	<td><input type="radio" name="gender" value="male" checked> Male
  	    <input type="radio" name="gender" value="female"> Female
</tr>
	<td>Address:
	<td><textarea row="4" name="Address"></textarea>
</tr>
<tr>
	<td>DOB:
	<td><input type="date" name="dob">
</tr>
<tr>
	<td>Mobile:
	<td><input type="tel" name="mob">
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" value="Submit">
</tr>
</table>
</form>
</div>
	

</body>
</html>
