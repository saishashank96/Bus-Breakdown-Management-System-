<?php
date_default_timezone_set("Asia/Kolkata"); 
	session_start();
	
	if(isset($_POST["submit"]))
	{
		header('Location:breakdown.php');
		$m->close();
	}
	
	if(isset($_SESSION["eid"]))
	{
		$m = new MongoClient();
		$db = $m->brabm;
		$eid=$_SESSION["eid"];
		
	}
	else
	{
		session_destroy();
		header('Location:login.php');
	}
	
	$time=date('H:i',time());
	$date=date("Y/m/d");
$page = $_SERVER['PHP_SELF'];
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

tr:nth-child(even){background-color: #f2f2f2
}

</style>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>	
	<div class="login-page">
	<div class="form">
		Welcome Manager
		<form class="login-form" method="POST">
<?php
	$cursor1=$db->breakdown->find(array('status'=>0));
	if($count1=$cursor1->count()!=0)
	{
?>
		<br><br>
		<table>
		<caption>New Breakdowns</caption> 
		<tr>
		<th>Bus No.
		<th>Route No.
		<th>Nearest Stop
		<th>Time Reported
		</tr>
<?php
	foreach ($cursor1 as $document) 
	{
		echo "<tr onclick=\"document.location='Breakdown.php?id=".$document['_id']."'\">
		<td>".$document['Bus_No'].
		"<td>".$document['Route_No'].
		"<td>".$document['Nearest_Stop'].
		"<td>".$document['Time'].
		"</tr>";
	}
?>
		</table>
<?php
	}
	$cursor2=$db->breakdown->find(array('status'=>1));
	if($count2=$cursor2->count()!=0)
	{
?>		
		<br><br>
		<table>
		<caption>Breakdowns with Bus Sent</caption> 
		<tr>
		<th>Bus No.
		<th>Route No.
		<th>Time Reported
		<th>Bus Sent
		</tr>
		
<?php
	foreach ($cursor2 as $document)
	{
		echo "<tr onclick=\"document.location='ManagerBreakdownStatus.php?id=".$document['_id']."'\">
		<td>".$document['Bus_No'].
		"<td>".$document['Route_No'].
		"<td>".$document['Time'].
		"<td>".$document['Sent_Bus'].
		"</tr>";
	}
?>
		</table>
<?php
	}
	$cursor3=$db->breakdown->find(array('status'=>2,'Date'=>$date));
	if($count3=$cursor3->count()!=0)
	{
?>
		<br><br>
		<table>
		<caption>Breakdowns with Bus Reached</caption> 
		<tr>
		<th>Bus No.
		<th>Route No.
		<th>Time Reported
		<th>Bus Sent
		</tr>
		
<?php
	foreach ($cursor3 as $document)
	{
		echo "<tr onclick=\"document.location='ManagerBreakdownStatus.php?id=".$document['_id']."'\">
		<td>".$document['Bus_No'].
		"<td>".$document['Route_No'].
		"<td>".$document['Time'].
		"<td>".$document['Sent_Bus'].
		"</tr>";
	}
?>
		</table>
<?php
	}
	if($count1==0&&$count2==0&&$count3==0)
	{
		echo "No Breakdowns occured";
	}
	$m->close();
?>
		</form>
		</div>
	</div> 
	</body>
</html>