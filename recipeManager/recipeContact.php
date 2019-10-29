<?php
include 'FormValidation.php';
require_once('brvdleyoConnect.php'); // server sql connection
//require_once('localhostConnect.php'); //localhost sql connection
$validateTool = new FormValidation();

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$inName = '';
$inEmail = '';
$inText = '';
$errorMessage1 = '';
$errorMessage2 = '';
$errorMessage3 = '';
$successMessage = '';
if (isset($_POST['submit'])) {
$inName = $_POST['textfield'];
$inEmail = $_POST['textfield3'];
$inText = $_POST['textarea'];
if ($validateTool->validateRequiredStringField($inName)) {
  $isValid1 = true;
  }
  else {
    $isValid1 = false;
    $allCorrect = false;
    $errorMessage1 = "This field is Invalid";
    $successMessage = "";
  }
  if ($validateTool->validateEmail($inEmail)) {
    $isValid2 = true;
    }
    else {
      $isValid2 = false;
      $allCorrect = false;
      $errorMessage2 = "This field is Invalid";
      $successMessage = "";
    }
    if ($validateTool->validateRequiredStringField($inText) && $validateTool->characterLimiter($inText, 200)) {
      $isValid3 = true;
      }
      else {
        $isValid3 = false;
        $allCorrect = false;
        $errorMessage3 = "This field is Invalid";
        $successMessage = "";
      }
      	if ($isValid1 && $isValid2 && $isValid3) {
        try {
          $sql = "INSERT INTO contact_insert (id, brvdleyo_name, brvdleyo_email, brvdleyo_message) VALUES (NULL, :name, :email, :text);";
          $statement = $conn->prepare($sql);
          $statement->bindParam(":name", $inName);
          $statement->bindParam(":email", $inEmail);
          $statement->bindParam(":text", $inText);
          $statement->execute();
        }
        catch (PDOException $e) {
            echo "Process Failed: " . $e->getMessage();
        }
          $allCorrect = true;
          $errorMessage1 = "";
          $errorMessage2 = "";
          $errorMessage3 = "";
          $successMessage = "Thanks for your submission";
          $inName = '';
          $inEmail = '';
          $inText = '';
        }
}
$conn->null;
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Recipe Manager</title>
     <link rel="stylesheet" href="recipeCSS.css" type="text/css">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="shortcut icon" type="image/x-icon" href="assets/favi.png" />
     <script>console.log("View the repo on this project: https://github.com/brvdley/wdv341/tree/master/recipeManager")</script>
     <style>


     </style>
   </head>

   <body class="cMain">
     <div class="bContainer">
       <div class="nContainer">
         <header>
           <a href="recipeIndex.php"><img src="assets/title.png" alt="Recipe Manager" title="Company Title" onmouseover="this.title='';"></a>
         </header>
         <nav>
           <ul id="nav">
             <a href="recipeIndex.php" id="home"><li id='first'><img src="https://img.icons8.com/material-outlined/24/000000/home--v2.png" style="margin-right: 5px; margin-bottom: 5px;">Home</li></a>
             <a href="recipeList.php" id="recipes"><li id="second"><img src="https://img.icons8.com/metro/24/000000/book.png" style="transform: scale(.8); margin-right: 5px; margin-bottom: 2px;">Recipes</li></a>
             <a href="recipeContact.php" id="contact"><li id="third"><img src="https://img.icons8.com/windows/24/000000/help.png" style="margin-right: 5px; margin-bottom: 2px;">Contact Us</li></a>
           </ul>
           <div class="ham" id="#ham" onclick="hide()">
             <div class="bar1"></div>
             <div class="bar2"></div>
             <div class="bar3"></div>
           </div>
           <div class="search">
             <script async src="https://cse.google.com/cse.js?cx=001410868451250937928:61a6ksh4bhv"></script>
             <div class="gcse-search"></div>
           </div>
         </nav>
         <div class="pages" id="#pages">
           <a href="recipeIndex.php" id="home2"><img src="https://img.icons8.com/material-outlined/24/000000/home--v2.png" style="margin-right: 5px;">Home</a>
           <a href="recipeList.php" id="recipes2"><img src="https://img.icons8.com/metro/24/000000/book.png" style="transform: scale(.8); margin-right: 5px; margin-bottom: 2px;">Recipes</a>
           <a href="recipeContact.php" id="contact2"><img src="https://img.icons8.com/windows/24/000000/help.png" style="margin-right: 5px; margin-bottom: 2px;">Contact Us</a>
         </div>
       </div>
       <main>
        <div class="Rcontainer">
          <div class="titleC">
            <h1>Contact Us: </h1>
          </div>
          <div class="form">
          <form name="form" class="contact" method="post" action="recipeContact.php">
            <p class="success"><?php echo $successMessage ?></p>
            <div id="one">
      				<p class="error"><?php echo $errorMessage1 ?></p>
              <label for="textfield">Name:</label>
              <input type="text" name="textfield" id="textfield" placeholder="John" value="<?php echo $inName; ?>">
            </div>
            <div id="two">
      				<p class="error"><?php echo $errorMessage2 ?></p>
              <label for="textfield3">Email Address: </label>
              <input type="text" name="textfield3" id="textfield3" placeholder="example@example.com" value="<?php echo $inEmail; ?>">
            </div>
            <div id="three">
      				<p class="error"><?php echo $errorMessage3?></p>
              <label for="textarea">Message: (Limit 200 characters & No Special Characters)<br>
              </label>
              <textarea name="textarea" cols="40" rows="5" id="textarea" placeholder="Type Message Here..."value=""><?php echo $inText ?></textarea><span id="counter"></span>
      				<script>document.getElementById('counter').innerHTML = document.getElementById('textarea').value.length + "/200"; document.getElementById('textarea').onkeyup = function () {
        document.getElementById('counter').innerHTML = this.value.length + "/200";
      };</script>
            </div>
            <div id="four">
              <input type="submit" name="submit" value="Submit">
              <input type="reset" value="Reset" onClick="resetThis()">
            </div>
          </form>
          </div>
          <div class="map">
            <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=ankeny%2C%20iowa&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://camzzle.com">i was reading this</a></div><style>.mapouter{position:relative;text-align:right;height:100%;width:100%;border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;}
              .gmap_canvas {overflow:hidden;background:none!important;height:100%;width:100%;border-bottom-left-radius: 8px;
              border-bottom-right-radius: 8px;}</style></div>
          </div>
        </div>
       </main>
       <footer>
         <nav>
           <ul id="nav">
             <a href="recipeIndex.php" id="home"><li id='first'><img src="https://img.icons8.com/material-outlined/24/000000/home--v2.png" style="margin-right: 5px; margin-bottom: 5px;">Home</li></a>
             <a href="recipeList.php" id="recipes"><li id="second"><img src="https://img.icons8.com/metro/24/000000/book.png" style="transform: scale(.8); margin-right: 5px; margin-bottom: 2px;">Recipes</li></a>
             <a href="recipeContact.php" id="contact"><li id="third"><img src="https://img.icons8.com/windows/24/000000/help.png" style="margin-right: 5px; margin-bottom: 2px;">Contact Us</li></a>
           </ul>
           <p id="fourth">BrvdleyOwens &copy;<script>document.write(new Date().getFullYear());</script></p>
           <div class="search">
             <script async src="https://cse.google.com/cse.js?cx=001410868451250937928:61a6ksh4bhv"></script>
             <div class="gcse-search"></div>
           </div>
         </nav>
       </footer>
     </div>
     <script>
     function resetThis() {
       document.querySelector('input[type="text"]').value = '';
       document.querySelector('textarea').value = '';
     }
       function hide() {
         var x = document.querySelector('.pages');
         var y = document.querySelector('.nContainer');
         var z = document.querySelector('.cMain');
     if (x.style.display === "flex") {
       x.style.display = "none";
       y.style.height = "20%";
     } else {
       x.style.display = "flex";
       y.style.height = "30%";
       z.style.height = "220vh";
     }
       }
     </script>
   </body>
 </html>
