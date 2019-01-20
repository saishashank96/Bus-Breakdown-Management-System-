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
		Conductor
	</title>
	<script>
		function display(url){
			document.getElementById("disp").src=url;
			return false;
		}
	</script>
</head>
<body>

	<?php include"header.php"?>
<div class="menu">



<div class="dropdown">
  <button class="dropbtn">Current</button>
  <div class="dropdown-content">
   <!-- <a onclick="display('')">By Route</a> -->
    <a onclick="display('ConductorBreakdownInitial.php')">Breakdown</a>
  </div>
</div>


<div class="dropdown">
  <button class="dropbtn">History</button>
  <div class="dropdown-content">
    <a onclick="display('conductorhistory.php')">Breakdown</a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn"><?php echo"$eid"?></button>
  <div class="dropdown-content">
<!--	<a onclick="display('UpdateEmp.php')">Update Info</a>
    <a onclick="display('change_password.php')">Change Password</a> -->
    <a href="login.php">Sign Out</a>
  </div>
</div>
</div>

<div>

	<iframe id="disp" src="ConductorBreakdownInitial.php">
	</iframe>
	
</div>

<?php include"footer.php"?>
</body>
</html>