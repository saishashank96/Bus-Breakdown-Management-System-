<?php
date_default_timezone_set("Asia/Kolkata");
session_start();
$eid=$_SESSION["eid"];
	$m = new MongoClient();
	$db = $m->brabm;
	$date=date("Y/m/d");

$page = $_SERVER['PHP_SELF'];
$sec = "10";
?>
<html>
<head>
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
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
	$cursor=$db->breakdown->findOne(array("Conductor_ID"=>$eid,"Date"=>$date,"Time"=>(array('$lte'=>$time))));
	
	if($cursor['status']==0)
	{echo "Manager is yet to Send a bus";}
	elseif($cursor['status']==1)
	{
		echo "Bus ".$cursor['Sent_Bus']." has been sent";
?>
		<button type="Submit" name="Submit" onclick='window.location.reload(true);'>Bus Reached</button>

<?php
		if(isset($_POST['Submit']))
		{
		$db->breakdown->update(array('_id'=>$cursor['_id']),array('$set'=>array("status"=>2)));
		}
	}
	elseif($cursor['status']==2)
	{
		echo "Bus Reached";
	}
	$m->close();	
?>
</form>	
		</div>
	</div>  
</div>
</html>