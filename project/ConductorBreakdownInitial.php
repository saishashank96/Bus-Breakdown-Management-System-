<?php
date_default_timezone_set("Asia/Kolkata"); 
session_start();
$eid=$_SESSION["eid"];//Make sure it is of conductor when opening 2 accounts
$m = new MongoClient();
$db = $m->brabm;
$time=date('H:i',time());
$date=date("Y/m/d");
$schedule=$db->schedule->findOne(array("Conductor"=>$eid,"Dep_time"=>(array('$lte'=>$time)),"Arr_time"=>(array('$gte'=>$time))));

if($schedule['Route']=="")
{	
	$m->close();
	header('Location:DispSchedule.php');
}
else
{
	$find=$db->breakdown->findOne(array("Conductor_ID"=>$eid,"Date"=>$date));

	if($find['Conductor_ID']=="")
	{ 
		$m->close();
		header('Location:ReportBreakdown.php');
	}
	else
	{
		$m->close();
		header('Location:BreakdownStatus.php');
	}
}
?>