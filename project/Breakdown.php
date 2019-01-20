<?php
	session_start();
	
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
	date_default_timezone_set("Asia/Kolkata"); 
	$time=date('H:i',time());
	$date=date("Y/m/d");
	$count=0;
	$count1=0;
	$flag=0;
?>
<html>
<head>
<style>
body{
	//overflow:hidden;
}
</style>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>	
<?php
	$breakdown=$db->breakdown->findOne(array("_id"=>new MongoId($_GET['id'])));
	$brbussch=$db->schedule->findOne(array("Bus"=>$breakdown['Bus_No'],"Dep_time"=>(array('$lte'=>$time)),"Arr_time"=>(array('$gte'=>$time))));
	$stop=$db->stop->findOne(array("_id"=>$breakdown['Nearest_Stop']));
	$newbus=$db->bus->find(array('Depot'=>$stop['Nearest_Depot'],'_id'=>array('$ne'=>$breakdown['Bus_No'])));
	
	// just yo check if free bus is available in nearest depot.
	foreach ($newbus as $document)
	{
		$newbussch=$db->schedule->findOne(array("Bus"=>$document['_id']));
		//Is bus free?
		if(($brbussch['Arr_time'] <$newbussch['Dep_time'] || $brbussch['Dep_time'] >$newbussch['Arr_time']))
		{
		//Is Bus Brokendown OR Sent as Replacement? CONSTRAINT: Same bus can be sent only once in a day
		$newbussent=$db->breakdown->findOne(array('$or'=>array(array('Sent_Bus'=>$document['_id']),array('Bus'=>$document['_id'])),'Date'=>$date));
		if($newbussent['Bus_No']=="")
		{
			$count++;
		}
		}
	}


?>
<div class="login-page">
	<div class="form">
		<form class="login-form" method="POST">
	
	<input type="text" value=<?=$breakdown['Bus_No'] ?> readonly></input>
	<input type="text" value=<?=$breakdown['Route_No'] ?> readonly></input>
	<input type="text" value=<?=$breakdown['Nearest_Stop'] ?> readonly></input>
	<?php	if($count==0)
	{
		echo "Free Bus not available at nearest depot<br>Select Bus from Another Depot";
	}?>
	<select name="Bus" required>
		<option value="" hidden>Select Bus to Send</option>
		<?php
		foreach ($newbus as $document)
		{
			$newbussch=$db->schedule->findOne(array("Bus"=>$document['_id']));
			//Is bus free?
			if(($brbussch['Arr_time'] <$newbussch['Dep_time'] ||$brbussch['Dep_time'] >$newbussch['Arr_time']))
			{
			//Is Bus Brokendown OR Sent as Replacement? CONSTRAINT: Same bus can be sent only once in a day
			$newbussent=$db->breakdown->findOne(array('$or'=>array(array('Sent_Bus'=>$document['_id']),array('Bus'=>$document['_id'])),'Date'=>$date));
			$depot=$db->depot->findOne(array("_id"=>$document['Depot']));			
			if($newbussent['Bus']=="")
			{
				echo "<option value=".$document['_id'].">".$document['_id']."  ".$depot['Depot_Name']."</option>";
			}
			}
		}
		//Free Bus not available at nearest depot
		if($count==0)
		{
			$newbus=$db->bus->find(array('_id'=>array('$ne'=>$breakdown['Bus_No'])));
			foreach ($newbus as $document)
			{	
			$newbussch=$db->schedule->findOne(array("Bus"=>$document['_id']));
			//Is bus free?
			if(($brbussch['Arr_time'] <$newbussch['Dep_time'] ||$brbussch['Dep_time'] >$newbussch['Arr_time']))
			{
			//Is Bus Brokendown OR Sent as Replacement? CONSTRAINT: Same bus can be sent only once in a day
			$newbussent=$db->breakdown->findOne(array('$or'=>array(array('Sent_Bus'=>$document['_id']),array('Bus'=>$document['_id'])),'Date'=>$date));
			if($newbussent['Bus']=="")
			{
				$depot=$db->depot->findOne(array("_id"=>$document['Depot']));
				echo "<option value=".$document['_id'].">".$document['_id']."  ".$depot['Depot_Name']."</option>";
				$count1++;
			}
			}
			}
		}

		?>
	</select>
		<?php
		if($count==0 && $count1==0)
			{
			echo "No Buses Available at any Depot";
			}
		else{
		?>
		<button type="Submit" name="Submit2" onclick=>Send Bus</button>
<?php
		}
	if(isset($_POST['Submit2']))
	{
		$collection=$db->breakdown;
	
		$doc=array('$set'=>array("Sent_Bus"=>$_POST['Bus'],
		"status"=>1));
		
		$collection->update(array("_id"=>$breakdown['_id']),$doc);
		
		header('Location:ManagerBreakdownStatus.php?id='.$_GET['id']);
	}
	$m->close();
?>
		</div>
	</div>          
	
	</body>
</html>