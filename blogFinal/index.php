<?php
require_once("brvdleyoConnect.php");
require_once("FormValidation.php");
session_start();
if (!$_SESSION['validUser']) {
  header("Location: login.php");
}
$validateTool = new FormValidation();
$user = '';
$datePosted = '';
$errorMessage1 = '';
$t = '';
$p = '';
$title = '';
$post = '';
$u = '';
$d = '';
$errorMessage1 = '';
$errorMessage2 = '';
$successMessage = '';
$isValid1 = '';
$isValid2 = '';

if(isset($_POST['post'])) {
  $u = $_SESSION['userName'];
  $d = date("Y-m-d");
  $t = $_POST['title'];
  $p = $_POST['textarea'];
  if ($validateTool->validateRequiredTextArea($t) && $validateTool->characterLimiter($t, 100)) {
    $isValid1 = true;
    }
    else {
      $isValid1 = false;
      $allCorrect = false;
      $errorMessage1 = "This field is Invalid";
      $successMessage = "";
    }
    if ($validateTool->validateRequiredTextArea($p) && $validateTool->characterLimiter($p, 1000)) {
      $isValid2 = true;
      }
      else {
        $isValid2 = false;
        $allCorrect = false;
        $errorMessage2 = "This field is Invalid";
        $successMessage = "";
      }
      if ($isValid2 && $isValid1) {
        try {
          $stmt = $conn->prepare("INSERT INTO blog_posts (post_title, post_content, post_creator, post_date) VALUES (:title, :cont, :creator, :dates);");
          $stmt->bindParam(':title', $t);
          $stmt->bindParam(':cont', $p);
          $stmt->bindParam(':creator', $u);
          $stmt->bindParam(':dates', $d);
          $stmt->execute();
          $successMessage = "Post Complete.";
          header("Location: index.php");
        }
        catch (PDOException $e) {
          echo "Process Failed: " . $e->getMessage();
        }
      }
}


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Blog Home</title>
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
            <a href="contact.php"><li id="contact">CONTACT</li></a>
          </div>
          <div class="useri">
            <a href="logout.php"><li id="logout">LOGOUT</li></a>
          </div>
        </ul>
      </nav>
      <div class="middles">
        <div class="dashbar">
          <div class="dwrap">
            <p>Welcome Back <span class="bold"><?php echo $_SESSION['userName']; ?></span>!</p>
            <a href="myPosts.php"><p>My Posts</p></a>
          </div>
        </div>
        <main class="postItems">
            <div class="new">
              <form method="post" class="newPost" action="index.php">
                <p class="success" style="margin: 1px;"><?php echo $successMessage; ?></p>
                <p class="error" style="margin: 1px;"><?php echo $errorMessage1; ?></p>
                <div class="title">
                  <label for="title">Title -</label>
                  <input type="text" name="title" value="<?php echo $t;?>">
                </div>
                <p class="error" style="margin: 1px;"><?php echo $errorMessage2; ?></p>
                <textarea name="textarea" placeholder="Begin typing here..." id="textarea" value=""><?php echo $p;?></textarea>
                <input type="submit" name="post" value="Post" class="post">
              </form>
            </div>
            <div class="posts">
              <div class="pTitle">
                <h1>Posts:</h1>
              </div>
            <div class="postw">
            <?php
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
              $sql = "SELECT * FROM blog_posts";
              $statement = $conn->prepare($sql);
              $statement->execute();
              $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
              foreach($statement->fetchAll() as $k=>$v) {
                $user = $v['post_creator'];
                $datePosted = $v['post_date'];
                $title = $v['post_title'];
                $post = $v['post_content'];
                echo '<div class="postMain"><div class="crumbs"><p>' . $user . '</p><p>Date Posted: ' . $datePosted . '</p></div>
                <div class="bulk"><h2>' . $title . '</h2></p><p>' . $post . '</p></div></div>';}
              }
              catch(PDOException $e) {
                echo "Process Failed: " . $e->getMessage();
              }
              ?>
            </div>
            </div>
        </main>
        </div>
      </div>
    </body>
  </html>
