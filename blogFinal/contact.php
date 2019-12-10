<?php
require_once("brvdleyoConnect.php");
require_once("FormValidation.php");
require_once('emailer.php');
session_start();
if (!$_SESSION['validUser']) {
  header("Location: login.php");
}

$validateTool = new FormValidation();
$m = '';
$e = '';
$isValid1 = '';
$isValid2 = '';
$errorMessage1 = '';
$errorMessage2 = '';
$successMessage = '';

if (isset($_POST['submit'])) {
  $m = $_POST['user'];
  $e = $_POST['email'];
  if ($validateTool->validateRequiredStringField($m)) {
    $isValid1 = true;
    }
    else {
      $isValid1 = false;
      $allCorrect = false;
      $errorMessage1 = "This field is Invalid";
      $successMessage = "";
    }
    if ($validateTool->validateEmail($e)) {
      $isValid2 = true;
      }
      else {
        $isValid2 = false;
        $allCorrect = false;
        $errorMessage2 = "This field is Invalid";
        $successMessage = "";
      }
          if ($isValid1 && $isValid2) {
                $sending = new Emailer($e, 'Sent From: BradleyOwens126@gmail.com', 'Thank you for contacting us!', 'We will respond as quick as possible!');
                if ($sending->send()) {
                  $sending2 = new Emailer('bradleyowens126@gmail.com', 'Sent From: BradleyOwens126@gmail.com', 'Thank you for contacting us!', "$m $e");
                  $sending2->send();
                  $successMessage = "Thanks for contacting us.";
                }
                else {
                  $errorMessage1 = "Error sending email. Try Again.";
                }
          }
      }
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Blog | Contact Us</title>
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
             <a href="logout.php"><li id="logout">LOGOUT</li></a>
           </div>
         </ul>
       </nav>
       <main class="mwrapper">
         <div class="fwrapper">
           <div class="fcontainer2">
             <h2 style="margin: 1px;">Contact Us!</h2>
             <form class="register" action="contact.php" method="post">
               <p class="error" style="margin: 1px;"><?php echo $errorMessage1; ?></p>
               <p class="success" style="margin: 1px;"><?php echo $successMessage; ?></p>
               <div class="user2">
                 <label for="user">Message -</label>
                 <textarea id="special" name="user" value=""><?php echo $m;?></textarea>
               </div>
               <p class="error" style="margin: 1px;"><?php echo $errorMessage2; ?></p>
               <div class="user2">
                 <label for="email">Email -</label>
                 <input type="email" class="email" name="email" value="<?php echo $e;?>">
               </div>
               <input type="submit" name="submit" value="Submit">
             </form>
           </div>
         </div>
       </main>
     </div>
   </body>
 </html>
