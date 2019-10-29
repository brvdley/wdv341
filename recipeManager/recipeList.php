<?php
require_once('brvdleyoConnect.php'); // server sql connection
//require_once('localhostConnect.php'); //localhost sql connection

define('IMAGE_DIR','assets/');

$sql = "SELECT recipe_name,recipe_image,recipe_difficulty,recipe_instructions,recipe_servings,cook_time,prep_time FROM rec WHERE recipe_name= 'Crockpot Chili'; ";
$sql2 = "SELECT recipe_name,recipe_image,recipe_difficulty,recipe_instructions,recipe_servings,cook_time,prep_time FROM rec WHERE recipe_name= 'Sugar Cookies';";
$sql3 = "SELECT recipe_name,recipe_image,recipe_difficulty,recipe_instructions,recipe_servings,cook_time,prep_time FROM rec WHERE recipe_name= 'French Omelet';";

$sth = $conn->prepare($sql);
$sth->execute();


$sth2 = $conn->prepare($sql2);
$sth2->execute();

$sth3 = $conn->prepare($sql3);
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>console.log("View the repo on this project: https://github.com/brvdley/wdv341/tree/master/recipeManager")</script>
  </head>

  <body id="list">
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
      <main class="mList">
        <div class="Rcontainer">
          <div class="welcome">
            <h1>This week&#39;s featured recipes include: </h1>
            <p>(Click one to view the recipe!)</p>
          </div>
          <div class="recipeTable2">
            <div class="row">
              <div class="recipe" id="beans">
                <div class="RImage">
                  <img src="<?php echo IMAGE_DIR . $image1; ?>" id="chili" alt="Crockpot Chili" title="Recipe Image Featuring Crockpot Chili">
                </div>
                <div class="RTitle">
                  <h4 id="recipeTitle"><?php echo $name1; ?></h4>
                </div>
              </div>
              <div class="recipe" id="sugar">
                <div class="RImage">
                  <img src="<?php echo IMAGE_DIR . $image2; ?>" id="cookie" alt="Sugar Cookies" title="Recipe Image Featuring Sugar Cookies">
                </div>
                <div class="RTitle">
                   <h4 id="recipeTitle"><?php  echo $name2; ?></h4>
                </div>
              </div>
              <div class="recipe" id="omelet">
                <div class="RImage">
                   <img src="<?php echo IMAGE_DIR . $image3; ?>" id="egg" alt="French Omelet" title="Recipe Image Featuring A French Omelet">
                </div>
                <div class="RTitle">
                   <h4 id="recipeTitle"><?php echo $name3; ?></h4>
                </div>
              </div>
            </div>
          </div>
          <span class="lContainer">
          </span>
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
  <script>
    function hide() {
      var x = document.querySelector('.pages');
      var y = document.querySelector('.nContainer');
  if (x.style.display === "flex") {
    x.style.display = "none";
    y.style.height = "10%";
  } else {
    x.style.display = "flex";
    y.style.height = "13%";
  }
    }

  $('#beans').click(function() {
    $('.omelet').remove();
    $('.sugar').remove();
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector(".lContainer").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "chili.txt", true);
  xhttp.send();
});
$('#omelet').click(function() {
  $('.chili').remove();
  $('.sugar').remove();
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.querySelector(".lContainer").innerHTML = this.responseText;
  }
};
xhttp.open("GET", "omelet.txt", true);
xhttp.send();
});
$('#sugar').click(function() {
  $('.chili').remove();
  $('.omelet').remove();
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.querySelector(".lContainer").innerHTML = this.responseText;
  }
};
xhttp.open("GET", "sugar.txt", true);
xhttp.send();
});
  function half() {
    if($('#in1').html() == '2') {
    $('#serv1').html(6 / 2);
    $('#in1').html(2 / 2);
    $('#in2').html(1 / 2);
    $('#in3').html(1 / 2);
    $('#in4').html(4 / 2);
    $('#in5').html(1 / 2);
    $('#in6').html(1 / 2);
    $('#in7').html(2 / 2);
    $('#in8').html(2 / 2);
    $('#in9').html(2 / 2);
    $('#in10').html(2 / 2);
    $('#in11').html(1 / 2);
    $('#in12').html(.5 / 2);
  }
  else if ($('#in1').html() == '4'){
    $('#serv1').html((12 / 2) / 2);
    $('#in1').html((4 / 2) / 2);
    $('#in2').html((2 / 2) / 2);
    $('#in3').html((2 / 2) / 2);
    $('#in4').html((8 / 2) / 2);
    $('#in5').html((2 / 2) / 2);
    $('#in6').html((2 / 2) / 2);
    $('#in7').html((4 / 2) / 2);
    $('#in8').html((4 / 2) / 2);
    $('#in9').html((4 / 2) / 2);
    $('#in10').html((4 / 2) / 2);
    $('#in11').html((2 / 2) / 2);
    $('#in12').html((1 / 2) / 2);
  }
  else if ($('#in20').html() == '2') {
    $('#serv1').html(1 / 2);
    $('#in20').html(2 / 2);
    $('#in21').html(2 / 2);
    $('#in22').html(.125 / 2);
    $('#in23').html(1 / 2);
    $('#in24').html(.33 / 2);
  }
  else if ($('#in20').html() == '4') {
    $('#serv1').html((2 / 2) / 2);
    $('#in20').html((4 / 2) / 2);
    $('#in21').html((4 / 2) / 2);
    $('#in22').html((.25 / 2) / 2);
    $('#in23').html((1 / 2) / 2);
    $('#in24').html((.66 / 2) / 2);
  }
  else if ($('#in30').html() == '2.75') {
    $('#serv1').html(48 / 2);
    $('#in30').html(2.75 / 2);
    $('#in31').html(1 / 2);
    $('#in32').html(.5 / 2);
    $('#in33').html(1 / 2);
    $('#in34').html(1.5 / 2);
    $('#in35').html(1 / 2);
    $('#in36').html(1 / 2);
  }
  else if ($('#in30').html() == '5.5') {
    $('#serv1').html((96 / 2) / 2);
    $('#in30').html((5.5 / 2) / 2);
    $('#in31').html((2 / 2) / 2);
    $('#in32').html((1 / 2) / 2);
    $('#in33').html((2 / 2) / 2);
    $('#in34').html((3 / 2) / 2);
    $('#in35').html((2 / 2) / 2);
    $('#in36').html((2 / 2) / 2);
  }
  }
  function single() {
    if ($('#in1').html() == '1') {
    $('#serv1').html(3 * 2);
    $('#in1').html(1 * 2);
    $('#in2').html(.5 * 2);
    $('#in3').html(.5 * 2);
    $('#in4').html(2 * 2);
    $('#in5').html(.5 * 2);
    $('#in6').html(.5 * 2);
    $('#in7').html(1 * 2);
    $('#in8').html(1 * 2);
    $('#in9').html(1 * 2);
    $('#in10').html(1 * 2);
    $('#in11').html(.5 * 2);
    $('#in12').html(.25 * 2); }
    else if ($('#in1').html() == '4'){
      $('#serv1').html(12 / 2);
      $('#in1').html(4 / 2);
      $('#in2').html(2 / 2);
      $('#in3').html(2 / 2);
      $('#in4').html(8 / 2);
      $('#in5').html(2 / 2);
      $('#in6').html(2 / 2);
      $('#in7').html(4 / 2);
      $('#in8').html(4 / 2);
      $('#in9').html(4 / 2);
      $('#in10').html(4 / 2);
      $('#in11').html(2 / 2);
      $('#in12').html(1 / 2);
    }
    else if ($('#in20').html() == '1') {
      $('#serv1').html(.5 * 2);
      $('#in20').html(1 * 2);
      $('#in21').html(1 * 2);
      $('#in22').html(.0625 * 2);
      $('#in23').html(.5 * 2);
      $('#in24').html(.165 * 2);
    }
    else if ($('#in20').html() == '4') {
      $('#serv1').html(2 / 2);
      $('#in20').html(4 / 2);
      $('#in21').html(4 / 2);
      $('#in22').html(.25 / 2);
      $('#in23').html(1 / 2);
      $('#in24').html(.66 / 2);
    }
    else if ($('#in30').html() == '5.5') {
      $('#serv1').html(96 / 2);
      $('#in30').html(5.5 / 2);
      $('#in31').html(2 / 2);
      $('#in32').html(1 / 2);
      $('#in33').html(2 / 2);
      $('#in34').html(3 / 2);
      $('#in35').html(2 / 2);
      $('#in36').html(2 / 2);
    }
    else if ($('#in30').html() == '1.375') {
      $('#serv1').html(24 * 2);
      $('#in30').html(1.375 * 2);
      $('#in31').html(.5 * 2);
      $('#in32').html(.25 * 2);
      $('#in33').html(.5 * 2);
      $('#in34').html(.75 * 2);
      $('#in35').html(.5 * 2);
      $('#in36').html(.5 * 2);
    }
  }
  function double() {
    if ($('#in1').html() == '1') {
    $('#serv1').html((3 * 2) * 2);
    $('#in1').html((1 * 2) * 2);
    $('#in2').html((.5 * 2) * 2);
    $('#in3').html((.5 * 2) * 2);
    $('#in4').html((2 * 2) * 2);
    $('#in5').html((.5 * 2) * 2);
    $('#in6').html((.5 * 2) * 2);
    $('#in7').html((1 * 2) * 2);
    $('#in8').html((1 * 2) * 2);
    $('#in9').html((1 * 2) * 2);
    $('#in10').html((1 * 2) * 2);
    $('#in11').html((.5 * 2) * 2);
    $('#in12').html((.25 * 2) * 2); }
    else if ($('#in1').html() == '2'){
      $('#serv1').html(6 * 2);
      $('#in1').html(2 * 2);
      $('#in2').html(1 * 2);
      $('#in3').html(1 * 2);
      $('#in4').html(4 * 2);
      $('#in5').html(1 * 2);
      $('#in6').html(1 * 2);
      $('#in7').html(2 * 2);
      $('#in8').html(2 * 2);
      $('#in9').html(2 * 2);
      $('#in10').html(2 * 2);
      $('#in11').html(1 * 2);
      $('#in12').html(.5 * 2);
    }
    else if ($('#in20').html() == '2') {
      $('#serv1').html(1 * 2);
      $('#in20').html(2 * 2);
      $('#in21').html(2 * 2);
      $('#in22').html(.125 * 2);
      $('#in23').html(1 * 2);
      $('#in24').html(.33 * 2);
    }
    else if ($('#in20').html() == '1') {
      $('#serv1').html((.5 * 2) * 2);
      $('#in20').html((1 * 2) * 2);
      $('#in21').html((1 * 2) * 2);
      $('#in22').html((.0625 * 2) * 2);
      $('#in23').html((.5 * 2) * 2);
      $('#in24').html((.165 * 2) * 2);
    }
    else if ($('#in30').html() == '1.375') {
      $('#serv1').html((24 * 2) * 2);
      $('#in30').html((1.375 * 2) * 2);
      $('#in31').html((.5 * 2) * 2);
      $('#in32').html((.25 * 2) * 2);
      $('#in33').html((.5 * 2) * 2);
      $('#in34').html((.75 * 2) * 2);
      $('#in35').html((.5 * 2) * 2);
      $('#in36').html((.5 * 2) * 2);
    }
    else if ($('#in30').html() == '2.75') {
      $('#serv1').html(48 * 2);
      $('#in30').html(2.75 * 2);
      $('#in31').html(1 * 2);
      $('#in32').html(.5 * 2);
      $('#in33').html(1 * 2);
      $('#in34').html(1.5 * 2);
      $('#in35').html(1 * 2);
      $('#in36').html(1 * 2);
    }
  }
  </script>
</html>
