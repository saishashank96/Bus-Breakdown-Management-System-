<?php
	$m = new MongoClient();
	$db = $m->brabm;
	$cursor=$db->breakdown->find();
	$cursor = $cursor->sort(array("Date" => 1));
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
<div class="password">
<body>
<div class="login-page">
	<div class="form1">
<table><caption>Breakdowns</caption>
<tr>
	
	<th>Bus No.
	<th>Route No.
	<th>Conductor
	<th>Nearest Stop
	<th>Reason
	<th>Time
	<th>Date
	<th>Status
</tr>
<?php
foreach ($cursor as $document) {
echo "<tr><td>".$document['Bus_No']."<td>".$document['Route_No']."<td>".$document['Conductor_ID']."<td>".$document['Nearest_Stop']."<td>".$document['Reason']."<td>".$document['Time']."<td>".$document['Date']."<td>".$document['status']."</tr>";
}
?>

</table>
</div>
</div>
</div>
</div>
</html>