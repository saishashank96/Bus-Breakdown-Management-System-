<?php
	$incorrect=false;
	
	if(isset($_POST["submit"]))
	{
		$eid=$_POST["eid"];
		$pwd=md5($_POST["pwd"]);
		$m = new MongoClient();

		$db = $m->brabm;

		$user = $db->employee->findOne(array("_id"=>$eid));
	
		if($pwd==$user["password"])
		{  
			session_start();
			$_SESSION["eid"]= $eid;
			
			if($user["designation"]=="Conductor")
				header('Location:conductor.php');
			elseif($user["designation"]=="Manager")
				header('Location:manager.php');
		}
		else
		{
			$incorrect=true;
		}
		
		$m->close();
	}
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="login.css">
	
	<title>
		LOGIN PAGE
	</title>
</head>

<body>	
<div id="container">
	
	<?php include"header.php"?>
	
	<div class="login-page">
		<div class="form">
			<form class="login-form" method="POST">
			  <input type="text" placeholder="Emp ID" name="eid" required />
			  <input type="password" placeholder="Password" name="pwd" required />
			  <button type="submit" name="submit">Login</button>
			</form>
			<?php if($incorrect==true){echo "Incorrect Emp ID or Password";}?>
		</div>
	</div>          
</div>	

<?php include"footer.php"?>
</body>
</html>