<?php
require_once("brvdleyoConnect.php");
require_once("FormValidation.php");
require_once("emailer.php");
session_start();
if ($_SESSION['validUser']) {
  header("Location: index.php");
}
$validateTool = new FormValidation();
$u = '';
$p = '';
$rp = '';
$email = '';
$isValid1 = '';
$isValid2 = '';
$isValid3 = '';
$isValid4 = '';
$errorMessage1 = '';
$errorMessage2 = '';
$errorMessage3 = '';
$errorMessage4 = '';
if (isset($_POST['submit'])) {
  $u = $_POST['user'];
  $p = $_POST['pass'];
  $rp = $_POST['rpass'];
  $email = $_POST['email'];
  if ($validateTool->validateRequiredStringField($u)) {
    $isValid1 = true;
    }
    else {
      $isValid1 = false;
      $allCorrect = false;
      $errorMessage1 = "This field is Invalid";
      $successMessage = "";
    }
    if ($validateTool->validateRequiredStringField($p) && $validateTool->charactersRequired($p, 8)) {
      $isValid2 = true;
      }
      else {
        $isValid2 = false;
        $allCorrect = false;
        $errorMessage2 = "This field is Invalid";
        $successMessage = "";
      }
      if ($p == $rp && $validateTool->validateRequiredStringField($rp)) {
        $isValid3 = true;
        }
        else {
          $isValid3 = false;
          $allCorrect = false;
          $errorMessage3 = "This field is Invalid";
          $successMessage = "";
        }
        if ($validateTool->validateEmail($email)) {
          $isValid4 = true;
          }
          else {
            $isValid4 = false;
            $allCorrect = false;
            $errorMessage4 = "This field is Invalid";
            $successMessage = "";
          }
          if ($isValid1 && $isValid2 && $isValid3 && $isValid4) {
            try {
              $stmt = $conn->prepare("INSERT INTO blog_users (user_name, user_password) VALUES (:user, :pass);");
              $stmt->bindParam(':user', $u);
              $stmt->bindParam(':pass', $p);
              $stmt->execute();
              $sending2 = new Emailer($email, 'Sent From: BradleyOwens126@gmail.com', 'Thanks for registering!', "Feel free to post or check out the site!");
              $sending2->send();
              header("Location: login.php");
            }
            catch (PDOException $e) {
              echo "Process Failed: " . $e->getMessage();
              $sending2 = new Emailer('bradleyowens126@gmail.com', 'Sent From: BradleyOwens126@gmail.com', 'Site Error', "$e->getMessage();");
            }
          }
      }
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Blog | Register</title>
     <link rel="stylesheet" href="login.css" type="text/css">
     <link href="https://fonts.googleapis.com/css?family=Chicle&display=swap" rel="stylesheet">
   </head>
   <body>
     <div class="container">
       <nav>
         <ul class="nwrapper">
           <div class="bares">
             <h2 class="logo">BLOG</h2>
             <a href="index.php"><li id="home">HOME</li></a>
           </div>
           <div class="useri">
             <a href="login.php"><li id="login">LOGIN</li></a>
           </div>
         </ul>
       </nav>
       <main class="mwrapper">
         <div class="fwrapper">
           <h3 class="ani">Welcome!</h3>
           <div class="fcontainer2">
             <h2 style="margin: 1px;">Join our community!</h2>
             <form class="register" action="register.php" method="post">
               <p class="error" style="margin: 1px;"><?php echo $errorMessage1; ?></p>
               <div class="user2">
                 <label for="user">Username -</label>
                 <input type="text" class="user" name="user" value="<?php echo $u;?>">
               </div>
               <p class="error" style="margin: 1px;"><?php echo $errorMessage2; ?></p>
               <div class="pass2">
                 <label for="pass">Password -</label>
                 <input type="password" class="pass" name="pass" value="<?php echo $p;?>">
               </div>
               <p id="rules">Should be atleast 8 Characters, no spaces.</p>
               <p class="error" style="margin: 1px;"><?php echo $errorMessage3; ?></p>
               <div class="pass2">
                 <label for="rpass">Confirm Password -</label>
                 <input type="password" class="pass" name="rpass" value="<?php echo $rp;?>">
               </div>
               <p class="error" style="margin: 1px;"><?php echo $errorMessage4; ?></p>
               <div class="user2">
                 <label for="email">Email -</label>
                 <input type="email" class="email" name="email" value="<?php echo $email;?>">
               </div>
               <input type="submit" name="submit" value="Register">
             </form>
             <h4>OR</h4>
             <a href="login.php"><input type="button" value="Login" name="login" id="loginc2a"></a>
           </div>
         </div>
       </main>
     </div>
   </body>
 </html>
