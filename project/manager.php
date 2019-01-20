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
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="maincss.css">
	<title>
		Manager
	</title>
	<script>
		function display(url){
			document.getElementById("disp").src=url;
			return false;
		}
		</script>
</head>
<body>
<div id="container">
<?php include"header.php"?>

<div class="menu">

<div class="dropdown">
  <a class="dropbtn" onclick="display('managerdefault.php')">Home</a>
</div>

<div class="dropdown">
  <button class="dropbtn">Current</button>
  <div class="dropdown-content">
    <a onclick="display('DispDepot.php')">Depot</a>
    <a onclick="display('DispRoutes.php')">Route</a>
	<a onclick="display('DispSchedule.php')">Schedule</a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">Analysis</button>
  <div class="dropdown-content">
    <a onclick="display('ReasonPie.php')">Reason</a>
    <a onclick="display('DateGraph.php')">Date</a>
	<a onclick="display('RouteGraph.php')">Route</a>
	<a onclick="display('graphbuswise.php')">Bus</a>
	<a onclick="display('DepotGraph.php')">Sent Bus Depot</a>
  </div>
</div>

<div class="dropdown">
  <button class="dropbtn">History</button>
  <div class="dropdown-content">
    <a onclick="display('DispBreakdown.php')">Breakdown</a>
  </div>
</div>

<!-- <div class="dropdown">
  <button class="dropbtn">Bus</button>
  <div class="dropdown-content">
    <a onclick="display('addbus.php')">Add Bus</a>
	<a onclick="display('AddSchedule.php')">Add Schedule</a>
  </div>
</div> -->
<div class="dropdown">
  <button class="dropbtn"><?php echo"$eid"?></button>
  <div class="dropdown-content">
<!--	<a onclick="display('UpdateEmp.php')">Update Info</a>
    <a onclick="display('change_password.php')">Change Password</a> -->
    <a href="logout.php">Sign Out</a>
  </div>
</div>

<div>
	<iframe id="disp" src="managerdefault.php"></iframe>
</div>


</div>	
	<?php include"footer.php"?>
</body>
</html>