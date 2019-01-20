<?php
	$m = new MongoClient();
	$db = $m->brabm;
	$cursor=$db->depot->find();
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
<table>
<tr>
	<th>Depot No.
	<th>Depot Name 
</tr>
<?php
foreach ($cursor as $document) {
echo "<tr><td>".$document['_id']."<td>".$document['Depot_Name']."</tr>";
}
?>

</table>
</div>
</html>