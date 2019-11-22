<?php
require_once("brvdleyoConnect.php");
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
        echo "</tr>" . "\n";
    }
}

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
           $sql = "SELECT * FROM events WHERE events_id = 18";
           $statement = $conn->prepare($sql);
           $statement->execute();

           $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
           foreach(new TableRows(new RecursiveArrayIterator($statement->fetchAll())) as $k=>$v) {
             echo $v;}
         }
         catch(PDOException $e) {
           echo "Process Failed: " . $e->getMessage();
         }
echo "</table>"
 ?>
 <!DOCTYPE html>
<html>
<head>
  <title>PHP SQL Select Events</title>
</head>

<body>
</body>
</html>
