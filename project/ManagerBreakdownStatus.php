<?php
session_start();
$eid=$_SESSION["eid"];
	$m = new MongoClient();
	$db = $m->brabm;
	
	

?>
<?php
$page1 = $_SERVER['PHP_SELF'];
$page=$page1.'?id='.$_GET['id'];
$sec = "10";
?>
<html>
<head>
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
<style>

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

</style>
<link rel="stylesheet" type="text/css" href="maincss.css">
</head>
<div class="password">
<body>
<div class="login-page">
	<div class="form">
<form class="login-form" method="POST">
<?php
	$time=date('H:i',time());
	$cursor=$db->breakdown->findOne(array("_id"=>new MongoId($_GET['id'])));
	$stop=$db->stop->findOne(array("_id"=>$cursor['Nearest_Stop']));
	$bus=$db->bus->findOne(array("_id"=>$cursor['Sent_Bus']));
	$depot=$db->depot->findOne(array("_id"=>$bus['Depot']));

	if($cursor['status']==1)
	{
		echo "Bus ".$cursor['Sent_Bus']." has been sent";
	}
	elseif($cursor['status']==2)
	{
		echo "Bus ".$cursor['Sent_Bus']." has reached";
	}
	$m->close();	
?>
<br><br>
<table>	
	<tr><td>Bus No.<td><?php echo $cursor['Bus_No']; ?>
	<tr><td>Route No.<td><?php echo $cursor['Route_No']; ?>
	<tr><td>Counductor ID<td><?php echo $cursor['Conductor_ID']; ?>	
	<tr><td>Nearest Stop<td><?php echo $cursor['Nearest_Stop']."	".$stop['Stop_Name']; ?> 
	<tr><td>Sent Bus<td><?php echo $cursor['Sent_Bus']."	".$depot['Depot_Name']; ?> 
	<tr><td>Status<td><?php echo $cursor['status']; ?>
</table>

	

</form>	
		</div>
	</div>  
</div>
</html>