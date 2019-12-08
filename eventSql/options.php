<?php
session_start();
$validUser = $_SESSION['validUser'];
if (!$validUser) {
  header("Location: login.php");
}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Event Admin Panel</title>
    <link rel="stylesheet" href="login.css" type="text/css">
  </head>
  <body>
    <div class="container">
      <nav>
        <ul class="nwrapper">
          <a href="options.php"><li id="home">Home</li></a>
          <p>Welcome <?php echo $_SESSION['userName'];?>!</p>
          <a href="logout.php"><li id="logout">Logout</li></a>
        </ul>
      </nav>
      <main class="mwrapper">
        <div class="fwrapper">
          <h3>Admin Database Options</h3>
          <div class="scontainer">
            <a href="insertPreparedStatement.php"><h4>Insert Item Into Database</h4></a>
            <a href="selectEventsDelete.php"><h4>Delete Item From Database</h4></a>
            <a href="selectEventsUpdate.php"><h4>Update Item In Database</h4></a>
          </div>
        </div>
        <div class="gwrapper">
        </div>
      </main>
    </div>
  </body>
</html>
