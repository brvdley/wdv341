<?php
require_once("localhostConnect.php");
$id = '';
$upid = '';
$name = '';
$desc = '';
$pres = '';
$month = '';
$day = '';
$year = '';
$formattedDate = '';
$hour = '';
$min = '';
$formattedTime = '';
$isPM = false;
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Event Name</th><th>Event Description</th><th>Event Presenter</th><th>Event Date</th><th>Event Time</th></tr>";
class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo '</tr>' . "\n";
    }
}

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
           $sql = "SELECT * FROM wdv341_event";
           $statement = $conn->prepare($sql);
           $statement->execute();

           $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
           foreach(new TableRows(new RecursiveArrayIterator($statement->fetchAll())) as $k=>$v) {
             echo $v;}
         }
         catch(PDOException $e) {
           echo "Process Failed: " . $e->getMessage();
         }
echo "</table>";
if (isset($_GET['update'])) {
  $id = $_GET['id'];
  $upid = $_GET['columnid'];
  $name = $_GET['columnname'];
  $desc = $_GET['columndesc'];
  $pres = $_GET['columnpres'];
  $month = $_GET['columnmon'];
  $day = $_GET['columnday'];
  $year = $_GET['columnyear'];
  $hour = $_GET['columnhour'];
  $min = $_GET['columnmin'];
  if ($_GET['columnid'] != '') {
    $sql = 'UPDATE wdv341_event SET event_id = :upid WHERE event_id = :id';
    $statement = $conn->prepare($sql);
    $statement->bindparam(":id", $id);
    $statement->bindparam(":upid", $upid);
    $statement->execute();
  }
  if ($_GET['columnname'] != '') {
    $sql = 'UPDATE wdv341_event SET event_name = :name WHERE event_id = :id';
    $statement = $conn->prepare($sql);
    $statement->bindparam(":id", $id);
    $statement->bindparam(":name", $name);
    $statement->execute();
  }
  if ($_GET['columndesc'] != '') {
    $sql = 'UPDATE wdv341_event SET event_description = :desc WHERE event_id = :id';
    $statement = $conn->prepare($sql);
    $statement->bindparam(":id", $id);
    $statement->bindparam(":desc", $desc);
    $statement->execute();
  }
  if ($_GET['columnpres'] != '') {
    $sql = 'UPDATE wdv341_event SET event_presenter = :pres WHERE event_id = :id';
    $statement = $conn->prepare($sql);
    $statement->bindparam(":id", $id);
    $statement->bindparam(":pres", $pres);
    $statement->execute();
  }
  if ($_GET['columnday'] != '' && $_GET['columnmon'] != '' && $_GET['columnyear'] != ''){
    $sql = 'UPDATE wdv341_event SET event_date = :day WHERE event_id = :id';
    $formattedDate = date("Y-m-d", mktime(0,0,0,$month,$day,$year));
    $statement = $conn->prepare($sql);
    $statement->bindparam(":id", $id);
    $statement->bindparam(":day", $formattedDate);
    $statement->execute();
  }
  if ($_GET['columnhour'] != '' && $_GET['columnmin'] != '') {
    if (isset($_GET['time'])) {
      $isPM = true;
    }

    if ($isPM) {$hour += 12;};
    $formattedTime = date("H:i:s", mktime($hour,$min,0));
    $sql = 'UPDATE wdv341_event SET event_time = :tim WHERE event_id = :id';
    $statement = $conn->prepare($sql);
    $statement->bindparam(":id", $id);
    $statement->bindparam(":tim", $formattedTime);
    $statement->execute();
  }
  header("Location: selectEventsUpdate.php");
}
 ?>
 <!DOCTYPE html>
<html>
<head>
  <title>PHP SQL Update Event</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
  <form class="update" action="selectEventsUpdate.php" method="get">
    <label>Enter ID of Event You Wish To Update. ONLY UPDATE ONE ID PER SUBMIT.
      <input type="text" name="id" value=""></br>
    </label>
    <p>Leave columns you do not wish to update blank. ONLY UPDATE ONE COLUMN PER SUBMIT.</p>
    <label>Updated ID
      <input type="text" name="columnid" value=""></br>
    </label>
    <label>Updated Name
      <input type="text" name="columnname" value=""></br>
    </label>
    <label>Updated Description
      <input type="text" name="columndesc" value=""></br>
    </label>
    <label>Updated Presenter
      <input type="text" name="columnpres" value=""></br>
    </label>
    <label>Updated Date (All must be filled in to update.)
      <input type="text" name="columnyear" value="" placeholder="YYYY" maxlength="4">-
      <input type="text" name="columnmon" value="" placeholder="MM" maxlength="2">-
      <input type="text" name="columnday" value="" placeholder="DD" maxlength="2"></br>
    </label>
    <label>Updated Time (Both must be filled in to update.)
      <input type="text" name="columnhour" value="" placeholder="HH" maxlength="2">:
      <input type="text" name="columnmin" value="" placeholder="MM" maxlength="2">
      <label>PM
      <input type="radio" name="time" id="pm" value="pm"></br>
      </label>
    </label>
    <input type="submit" value="Update" name="update">
  </form>
</body>
</html>
