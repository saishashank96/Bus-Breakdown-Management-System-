<?php
	session_start();
	
	if(isset($_SESSION["eid"]))
	{
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
	
	$m = new MongoClient();
	$db = $m->brabm;
	$schedule=$db->schedule->findOne(array("Conductor"=>$eid,"Dep_time"=>(array('$lte'=>$time)),"Arr_time"=>(array('$gte'=>$time))));
	
	$route=$db->routes->findOne(array("_id"=>$schedule['Route']));
	$stops=array_unique(array_merge_recursive($route['StopsUp'],$route['StopsDown']), SORT_REGULAR);

	$arrlength = count($stops);
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
	
<div class="login-page">
	<div class="form">
		<form class="login-form" method="POST">
		
<?php 
	if(isset($_POST['Submit1']))
	{
?>	
	<input name="bus1" type="text" value=<?=$schedule['Bus'] ?> readonly></input>
	
	<input name="route1" type="text" value=<?=$schedule['Route'] ?> readonly></input>
	
	<select name="Route" required>
		<option value="" disabled selected hidden>Select Nearest Stop</option>;
			<?php	
			for($x = 1; $x <= $arrlength; $x++) 
			{
				$stop=$db->stop->findOne(array("_id"=>$stops[$x]));
				if($stop!="")
				{
					echo "<option value=".$stop['_id'].">".$stop['_id']." ".$stop['Stop_Name']."</option>";
				}
			}
			?>
	</select>
		
	<select name="reason" required>
			<option value="" disabled selected hidden>Select Reason</option>
			<option value="Tyre Damage">Tyre Damage</option>
			<option value="Engine Failure">Engine Failure</option>
			<option value="Engine Failure">Gear Problem</option>
			<option value="Engine Failure">Engine Overheating</option>
			<option value="Other">Other</option>
	</select>
	
	<button type="Submit" name="Submit2">Submit</button>
<?php
	}
	elseif(isset($_POST['Submit2']))
	{
		$collection=$db->breakdown;
		$neareststop=$_POST['Route'];
		$reason=$_POST['reason'];
		$busno=$schedule['Bus'];
		$routeno=$schedule['Route'];
	
		$doc=array("Bus_No"=>"$busno",
		"Route_No"=>"$routeno",
		"Conductor_ID"=>"$eid",
		"Nearest_Stop"=>"$neareststop",
		"Reason"=>"$reason",
		"Time"=>"$time",
		"Date"=>"$date",
		"status"=>0);
		
		$collection->insert($doc);
		
		$m->close();
		
		header('Location:BreakdownStatus.php');
	}
	else
	{
?>
	<button type="Submit" name="Submit1">Report Breakdown</button>

<?php
	}
	
	$m->close();
?>
		</form>
		</div>
	</div>          
	
	</body>
</html>