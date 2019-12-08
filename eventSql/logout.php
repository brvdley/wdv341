<?php
session_start();
$_SESSION['validUser'] = false;
header("Location: login.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Event Admin Logout</title>
  </head>
  <body>

  </body>
</html>
