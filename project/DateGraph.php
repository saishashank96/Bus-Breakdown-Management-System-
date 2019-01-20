<?php
$m = new MongoClient();
$db = $m->brabm;
$cursor=$db->breakdown->aggregateCursor([['$group'=>['_id'=>'$Date','count'=>['$sum'=>1]]],['$sort'=>['_id'=>1]]]);
   class dataPoints {
	  public $y = "";
      public $indexLabel = "";
   }
$e=array();
foreach($cursor as $doc)
{
	$a = new dataPoints();
	$a->label = $doc["_id"];
	$a->y = $doc["count"];
	array_push($e,$a);
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
        text: "Breakdowns per Day"
      },
	  
      data: [
      {
       type: "line",
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