<?php
require_once("brvdleyoConnect.php");
//require_once("localhostConnect.php");
include 'FormValidation.php';
include 'emailer.php';
$validateTool = new FormValidation();
session_start();

$password = '';
$email = '';
$error = "";

$_SESSION['validUser'] = "";
$validUser = $_SESSION['validUser'];
if ($validUser) {
  header("Location: studentUpdate.php");
}
else if (isset($_POST['submit'])) {
  $email = $_POST['userName'];
  $password = $_POST['password'];
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  try {
    $sql = 'SELECT * FROM student_info_2020 WHERE student_username = :username AND student_password = :password;';
    $statement = $conn->prepare($sql);
    $statement->bindparam(':username', $email);
    $statement->bindparam(':password', $password);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user) {
      $_SESSION['validUser'] = true;
      $_SESSION['userName'] = $email;
      $_SESSION['password'] = $password;
      header("Location: studentUpdate.php");
    }
    else {$error ="Invalid Username or Password. Please Try Again.";}
    }
    catch(PDOException $e) {
      echo "Process Failed: " . $e->getMessage();
      $sending2 = new Emailer('bradleyowens126@gmail.com', 'Sent From: BradleyOwens126@gmail.com', 'Site Error', "$e->getMessage();");
          $sending2->send();
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="DMACC Portfolio Day 2020 Login.">
    <meta name="keywords" content="DMACC, Portfolio Day 2020, Web Development, Graphic Design, Photography, Video Production">
    <meta name="author" content="Bradley Owens">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/favicon.png" sizes="32x32" type="image/png">
    <title>DMACC Portfolio Day 2020</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="fContainer">
        <form action="studentLogin.php" method="POST">
          <header id="inputHeader">
            <h1>Welcome Students!</h1>
            <p>You may register your information, or update it by logging in.</p>
          </header>
          <div class="lrow1">
            <p id="error"><?php echo $error; ?></p>
            <div class="user">
              <label for="userName">Username (DMACC Email):</label>
              <input type="email" name="userName" value="<?php echo $email;?>"></input>
            </div>
            <div class="pass">
              <label for="password">Password:</label>
              <input type="password" name="password" id="password" value="<?php echo $password;?>"></input><img id="show" src="assets/eye.svg" title="Show Password" alt="Show Password" height="25px" width="25px">
            </div>
          </div>
          <div class="lrow2">
            <input type="submit" name="submit" value="Submit">
            <input type="reset" name="reset" value="Reset">
          </div>
          <div class="lrow3">
            <a href="studentRegister.php"><input type="button" name="new" value="Register" id="new"></a>
            <a href="studentLogin.php"><input type="button" name="returning" value="Login" id="login"></a>
          </div>
        </form>
      </div>
      <footer>
        <div class="social">
          <a href="https://www.facebook.com/dmaccportfolioday/" target="_blank"><img src="https://icongr.am/devicon/facebook-original.svg?size=40"></a>
          <a href="https://twitter.com/DMACCNews" target="_blank"><img src="https://icongr.am/devicon/twitter-original.svg?size=40"></a>
          <a href="https://www.instagram.com/dmaccportfolioday/" target="_blank"><img src="https://bit.ly/2vz3hjf" height="40px" width="40px"></a>
        </div>
        <div class="credit">
          <p>Icons by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></p>
        </div>
      </footer>
    </div>
    <script>
      $('#show').click(function() {
        if ($('#password').attr('type', 'password')) {
          $('#password').attr('type', 'text');}
      });
    </script>
  </body>
</html>
