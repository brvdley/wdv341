<?php
	//Get the Event data from the server.
  require_once("brvdleyoConnect.php");
  //require_once("localhostConnect.php");

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WDV341 Intro PHP  - Display Events Example</title>
    <style>
		.eventBlock{
			width:500px;
			margin-left:auto;
			margin-right:auto;
			background-color:#CCC;
		}

		.displayEvent{
			text_align:left;
			font-size:18px;
		}

		.displayDescription {
			margin-left:100px;
		}
	</style>
</head>

<body>
    <h1>WDV341 Intro PHP</h1>
    <h2>Example Code - Display Events as formatted output blocks</h2>
    <?php
    try {
               $sql = "SELECT event_date FROM wdv341_event";
               $statement = $conn->prepare($sql);
               $statement->execute();
               $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
               $td = date('Y-m-d');
               $i = 0;
               foreach ($statement->fetchAll() as $v) {
                 $date = date_create($v['event_date']);
                 if ($date == $td) {
                   $i++;
                 }
             }
             echo "<h3>Events Today: $i</h3>";
           }
             catch(PDOException $e) {
               echo "Process Failed: " . $e->getMessage();
             }
    ?>
<?php
try {
           $sql = "SELECT * FROM wdv341_event ORDER BY event_date DESC ";
           $statement = $conn->prepare($sql);
           $statement->execute();
           $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
           $tm = date('m');
           $td = date('Y-m-d');
           $tda = date('d');
           $ty = date('Y');
           foreach ($statement->fetchAll() as $v) {
             $event = $v['event_name'];
             $presenter = $v['event_presenter'];
             $description = $v['event_description'];
             $time = $v['event_time'];
             $date = date_create($v['event_date']);
             $df = date_format($date, "m-d-Y");
             echo "<p><div class='eventBlock'><div><span class='displayEvent'>Event: $event </span><span>Presenter: $presenter</span></div><div><span class='displayDescription'>Description: $description</span></div>";
             echo "<div><span class='displayTime'>Time: $time</span></div><div><span class='displayDate'>Date: $df</span></div></div></p>";}
         }
         catch(PDOException $e) {
           echo "Process Failed: " . $e->getMessage();
         }
?>
	<!--<p>
        <div class="eventBlock">
            <div>
            	<span class="displayEvent">Event:</span>
                <span>Presenter:</span>
            </div>
            <div>
            	<span class="displayDescription">Description:</span>
            </div>
            <div><span class="displayTime">Time:</span>
          </div>
          <div>
          <span class="displayDate">Date:</span>
        </div>
      </div>
  </p>-->

<?php
	//Close the database connection
  $conn = NULL;
?>
</div>
</body>
</html>
