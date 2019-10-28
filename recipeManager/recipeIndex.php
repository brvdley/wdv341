<?php
require_once('brvdleyoConnect.php'); // server sql connection
//require_once('localhostConnect.php'); //localhost sql connection

define('IMAGE_DIR','assets/');

$sql = "

SELECT recipe_name,recipe_image,recipe_difficulty,recipe_instructions,recipe_servings,cook_time,prep_time FROM rec WHERE recipe_name= 'Crockpot Chili';

";

$sql2 = "

SELECT recipe_name,recipe_image,recipe_difficulty,recipe_instructions,recipe_servings,cook_time,prep_time FROM rec WHERE recipe_name= 'Sugar Cookies';

";

$sql3 = "

SELECT recipe_name,recipe_image,recipe_difficulty,recipe_instructions,recipe_servings,cook_time,prep_time FROM rec WHERE recipe_name= 'French Omelet';

";

$sth = $conn->prepare($sql);
$sth->bindParam('recipe_name', $bpName1, PDO::PARAM_STR, 100);
$sth->bindParam('recipe_image', $bpImage1, PDO::PARAM_STR, 100);
$sth->bindParam('recipe_difficulty', $bpDiff1, PDO::PARAM_INT, 11);
$sth->bindParam('recipe_instructions', $bpInst1, PDO::PARAM_STR, 1000);
$sth->bindParam('recipe_servings', $bpServ1, PDO::PARAM_INT, 11);
$sth->bindParam('cook_time', $bpCook1, PDO::PARAM_STR, 100);
$sth->bindParam('prep_time', $bpPrep1, PDO::PARAM_STR, 100);
$sth->execute();


$sth2 = $conn->prepare($sql2);
$sth2->bindParam('recipe_name', $bpName2, PDO::PARAM_STR, 100);
$sth2->bindParam('recipe_image', $bpImage2, PDO::PARAM_STR, 100);
$sth2->bindParam('recipe_difficulty', $bpDiff2, PDO::PARAM_INT, 11);
$sth2->bindParam('recipe_instructions', $bpInst2, PDO::PARAM_STR, 1000);
$sth2->bindParam('recipe_servings', $bpServ2, PDO::PARAM_INT, 11);
$sth2->bindParam('cook_time', $bpCook2, PDO::PARAM_STR, 100);
$sth2->bindParam('prep_time', $bpPrep2, PDO::PARAM_STR, 100);
$sth2->execute();

$sth3 = $conn->prepare($sql3);
$sth3->bindParam('recipe_name', $bpName3, PDO::PARAM_STR, 100);
$sth3->bindParam('recipe_image', $bpImage3, PDO::PARAM_STR, 100);
$sth3->bindParam('recipe_difficulty', $bpDiff3, PDO::PARAM_INT, 11);
$sth3->bindParam('recipe_instructions', $bpInst3, PDO::PARAM_STR, 1000);
$sth3->bindParam('recipe_servings', $bpServ3, PDO::PARAM_INT, 11);
$sth3->bindParam('cook_time', $bpCook3, PDO::PARAM_STR, 100);
$sth3->bindParam('prep_time', $bpPrep3, PDO::PARAM_STR, 100);
$sth3->execute();

foreach ($sth->fetchall(PDO::FETCH_ASSOC) as $row) {
  $name1 = $row['recipe_name'];
  $image1 = $row['recipe_image'];
  $diff1 = $row['recipe_difficulty'];
  $inst1 = $row['recipe_instructions'];
  $serv1 = $row['recipe_servings'];
  $cook1 = $row['cook_time'];
  $prep1 = $row['prep_time'];
}

foreach ($sth2->fetchall(PDO::FETCH_ASSOC) as $row) {
  $name2 = $row['recipe_name'];
  $image2 = $row['recipe_image'];
  $diff2 = $row['recipe_difficulty'];
  $inst2 = $row['recipe_instructions'];
  $serv2 = $row['recipe_servings'];
  $cook2 = $row['cook_time'];
  $prep2 = $row['prep_time'];
}

foreach ($sth3->fetchall(PDO::FETCH_ASSOC) as $row) {
  $name3 = $row['recipe_name'];
  $image3 = $row['recipe_image'];
  $diff3 = $row['recipe_difficulty'];
  $inst3 = $row['recipe_instructions'];
  $serv3 = $row['recipe_servings'];
  $cook3 = $row['cook_time'];
  $prep3 = $row['prep_time'];
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Recipe Manager</title>
    <link rel="stylesheet" href="recipeCSS.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/favi.png" />
  </head>

  <body>
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
          <div class="search">
            <script async src="https://cse.google.com/cse.js?cx=001410868451250937928:61a6ksh4bhv"></script>
            <div class="gcse-search"></div>
          </div>
        </nav>
      </div>
      <main>
        <div class="Rcontainer">
          <div class="welcome">
            <h1>This week&#39;s featured recipes include: </h1>
          </div>
          <div class="recipeTable">
            <div class="row">
              <div class="recipe">
                <div class="RImage">
                  <a id="noStyle" href="recipeList.php"><img src="<?php echo IMAGE_DIR . $image1; ?>" id="chili" alt="Crockpot Chili" title="Recipe Image Featuring Crockpot Chili"></a>
                </div>
                <div class="RTitle">
                  <a id="noStyle" href="recipeList.php"><h4 id="recipeTitle"><?php echo $name1; ?></h4></a>
                </div>
              </div>
              <div class="recipe">
                <div class="RImage">
                  <a id="noStyle" href="recipeList.php"><img src="<?php echo IMAGE_DIR . $image2; ?>" id="cookie" alt="Sugar Cookies" title="Recipe Image Featuring Sugar Cookies"></a>
                </div>
                <div class="RTitle">
                  <a id="noStyle" href="recipeList.php"><h4 id="recipeTitle"><?php  echo $name2; ?></h4></a>
                </div>
              </div>
              <div class="recipe">
                <div class="RImage">
                  <a id="noStyle" href="recipeList.php"><img src="<?php echo IMAGE_DIR . $image3; ?>" id="egg" alt="French Omelet" title="Recipe Image Featuring A French Omelet"></a>
                </div>
                <div class="RTitle">
                  <a id="noStyle" href="recipeList.php"><h4 id="recipeTitle"><?php echo $name3; ?></h4></a>
                </div>
              </div>
            </div>
          </div>
          <div class="vContainer">
            <div class="video">
              <video src="assets/food.mp4" height="288px" width="512px" loop controls poster="assets/poster.jpg">HTML5 Video is not supported by this browser.</video>
            </div>
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
  </body>
</html>
