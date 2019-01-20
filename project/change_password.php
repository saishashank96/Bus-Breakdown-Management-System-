<?php
	session_start();
	$eid=$_SESSION["eid"];

	if(isset($_POST['Submit']))
	{
		$m = new MongoClient();

		$db = $m->brabm;

		$collection = $db->employee;

		$currentpwd=$_POST['CurrentPwd'];
		$newpwd=$_POST['NewPwd'];
		$confirmpwd=$_POST['ConfirmPwd'];

		$document = array( "_id" => "$eid", 
		"password" => "$pwd", 
		"name" => "$name", 
		"address" => "$addr", 
		"mobile" => "$mob", 
		"dob" => "$dob",
		"designation" => "$des");

		$collection->insert($document);

		$m->close();
	}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="maincss.css">
<title> Password </title>
</head>

<body>

<div class="main1">
<div class="password">
<form>
<table cellpadding="10">
	<tr>
		<td>Current Password:</td> <td> <input type="password" placeholder ="Password" name="CurrentPwd"></td>
	</tr>
	<tr>
		<td>New Password:</td> <td> <input type="password" placeholder ="Password" name="NewPwd"></td>
	</tr>
	<tr>
		<td>Confirm Password:</td> <td> <input type="password" placeholder ="Password" name="ConfirmPwd"></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" value="Submit" name="Submit"></td>

	</tr>
</table>
</div>
</div>
	
</center>
</body>
</html>