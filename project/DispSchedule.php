<?php
	$m = new MongoClient();
	$db = $m->brabm;
	$cursor=$db->schedule->find();
	$cursor=$cursor->sort(array("Dep_time"=>1));
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
</head>
<div class="password">
<body>
<div class="login-page">
<div class="form">
<table><caption>Schedule</caption>
<tr>
	<th>Bus No.</th>
	<th>Conductor</th>
	<th>Route</th>
	<th>Dept. Time</th>
	<th>Arr. Time</th>
</tr>
<?php
foreach ($cursor as $document) {
echo "<tr><td>".$document['Bus']."</td><td>".$document['Conductor']."</td><td>".$document['Route']."</td><td>".$document['Dep_time']."</td><td>".$document['Arr_time']."</td></tr>";
}
?>

</table>
</div>
</html>