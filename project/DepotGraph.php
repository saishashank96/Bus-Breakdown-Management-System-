<?php
$m = new MongoClient();
$db = $m->brabm;
   class dataPoints {
	  public $y = "";
      public $indexLabel = "";
   }

$d=array();
$depots=$db->depot->find();
foreach($depots as $doc)
{
	$d[$doc['Depot_Name']]=0;
}

$cursor=$db->breakdown->aggregateCursor([['$group'=>['_id'=>'$Sent_Bus','count'=>['$sum'=>1]]]]);
foreach($cursor as $doc)
{
	$bus=$db->bus->findOne(Array("_id"=>$doc["_id"]));
	$depot=$db->depot->findOne(array("_id"=>$bus['Depot']));
	$d[$depot['Depot_Name']]+=$doc["count"];
}
$e=array();
while (key($d))
{
	$a = new dataPoints();
	$a->label = key($d);
	$a->y = current($d);
	array_push($e,$a);
	next($d);
}
?>

<!DOCTYPE HTML>
<html>
<head>
  <script type="text/javascript">
  var data=JSON.parse('<?php echo json_encode($e);?>');
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
		animationEnabled:true,
      title:{
        text: "Spare Buses Sent by Depot"
      },
	  
      data: [
      {
       type: "column",
       dataPoints: data
       
     }
     ]
   });

    chart.render();
  }
  </script>
  <script type="text/javascript" src="canvasjs.min.js"></script></head>
  <body>
    <div id="chartContainer" style="height: 440px; width: 100%;">
    </div>
  </body>
 </html>