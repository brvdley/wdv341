<?php
require_once("brvdleyoConnect.php");
//require_once("localhostConnect.php");
include 'FormValidation.php';
include 'emailer.php';
$validateTool = new FormValidation();

$email = '';
$isValidEmail = '';
$isValidUnregistered = '';
$error = "";
$_SESSION['validRegister'] = false;


if (isset($_POST['submit'])) {
  $email = $_POST['userName'];
  if ($validateTool->validateEmail($email) && $validateTool->characterLimiter($email, 100) && strpos($email, 'dmacc.edu') !== false) {
    $isValidEmail = true;
    }
    else {
      $isValidEmail = false;
      $error = "This field is Invalid";
    }
    if ($isValidEmail) {
      $email = $_POST['userName'];
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      try {
        $sql = 'SELECT * FROM student_info_2020 WHERE student_username = :username;';
        $statement = $conn->prepare($sql);
        $statement->bindparam(':username', $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if ($user) {
          $error ="This user is already registered. Please Login.";
          $isValidUnregistered = false;
        }
        else {
          $isValidUnregistered = true;
        }
      }
        catch(PDOException $e) {
          echo "Process Failed: " . $e->getMessage();
          $sending2 = new Emailer('bradleyowens126@gmail.com', 'Sent From: BradleyOwens126@gmail.com', 'Site Error', "$e->getMessage();");
              $sending2->send();
        }
    }
  if ($isValidEmail && $isValidUnregistered) {
    session_start();
    $_SESSION['validRegister'] = true;
    $_SESSION['userName'] = $email;
    header("Location: studentInput.php");
  }
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="DMACC Portfolio Day 2020 Register.">
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
        <form action="studentRegister.php" method="POST">
          <header id="inputHeader">
            <h1>Welcome Students!</h1>
            <p>You may register your information, or update it by logging in.</p>
          </header>
          <p id="error"><?php echo $error; ?></p>
          <div class="rrow1">
            <label for="userName">Username (DMACC Email):</label>
            <input type="email" name="userName" value="<?php echo $email;?>"></input>
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
  </body>
</html>
