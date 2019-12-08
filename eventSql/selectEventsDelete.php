<?php
require_once("localhostConnect.php");
$id='';
echo "<table class='table' style='border: solid 1px black;'>";
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
if (isset($_GET['delete'])) {
  $id = $_GET['id'];
  try {
    $sql = "DELETE FROM wdv341_event WHERE event_id = :id;";
    $statement = $conn->prepare($sql);
    $statement->bindparam(":id", $id);
    $statement->execute();
  }
  catch (PDOException $e) {
    echo "Process Failed: " . $e->getMessage();
  }
  header("Location: selectEventsDelete.php");
}
 ?>
 <!DOCTYPE html>
<html>
<head>
  <title>PHP SQL Delete Event</title>
</head>

<body>
    <form class="delete" action="selectEventsDelete.php" method="get">
      <label>Enter ID of Event You Wish To Delete
        <input type="text" name="id" value="">
      </label>
      <input type="submit" value="Delete" name="delete">
    </form>
</body>
</html>
