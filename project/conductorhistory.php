<?php
	$m = new MongoClient();
	$db = $m->brabm;
	session_start();
	$eid=$_SESSION["eid"];
	$cursor=$db->breakdown->find(array('Conductor_ID'=>$eid));
?>

<html>
<head>
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
<link rel="stylesheet" type="text/css" href="maincss.css">
<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div class="password">
<div class="login-page">
	<div class="form1">
<table><caption>Breakdowns reported by Conductor</caption>
<tr>
	<th>Bus No.
	<th>Route No.
	<th>Conductor
	<th>Nearest Stop
	<th>Reason
	<th>Time
	<th>Date
	</tr>
<?php
foreach ($cursor as $document) {
echo "<tr><td>".$document['Bus_No']."<td>".$document['Route_No']."<td>".$document['Conductor_ID']."<td>".$document['Nearest_Stop']."<td>".$document['Reason']."<td>".$document['Time']."<td>".$document['Date'];
}
?>

</table>
</div>
</div>
</div>
</html>