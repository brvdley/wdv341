<?php
require_once("brvdleyoConnect.php");
session_start();
if (!$_SESSION['validUser']) {
  header("Location: login.php");
}

$u = $_SESSION['userName'];
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM blog_posts WHERE post_id = :id";
  $statement = $conn->prepare($sql);
  $statement->bindParam(':id', $id);
  $statement->execute();
  header("Location: myPosts.php");
}
if (isset($_POST['submit'])) {
  $cont = $_POST['edit'];
  $title = $_POST['title'];
  $sql = "UPDATE blog_posts SET post_content = :content WHERE post_title = :title";
  $statement = $conn->prepare($sql);
  $statement->bindParam(':content', $cont);
  $statement->bindParam(':title', $title);
  $statement->execute();
  header("Location: myPosts.php");
}
$id = '';
$id = '';
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
        <main class="postItems2">
            <div class="posts">
              <div class="pTitle">
                <h1>Your Posts:</h1>
              </div>
            <div class="postw">
            <?php
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
              $sql = "SELECT * FROM blog_posts WHERE post_creator = :username";
              $statement = $conn->prepare($sql);
              $statement->bindParam(':username', $u);
              $statement->execute();
              $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
              foreach($statement->fetchAll() as $k=>$v) {
                $user = $v['post_creator'];
                $id = $v['post_id'];
                $datePosted = $v['post_date'];
                $title = $v['post_title'];
                $post = $v['post_content'];
                $i = 0;
                echo '<div class="postMain"><div class="crumbs"><p>' . $user . '</p><p>Date Posted: ' . $datePosted . '</p>
                <div class="buttons"><a href="myPosts.php?id='. $id .'"><input type="button" name="delete" value="Delete"></a>
                <input type="button" name="update" value="Edit" id="edit" onclick="add()"></div></div>
                <div class="bulk"><form method="post" action="myPosts.php" id="append"></form>
                <h2>' . $title . '</h2><p>' . $post . '</p></div></div>';}
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
      <script>
      var myParent = document.querySelector('.bulk');
      var parent2 = document.querySelector('.postMain');
      var buttons = document.querySelector('.buttons');
      function add() {
          $('.bulk h2').remove();
          $('.bulk p').remove();
          $('.buttons input[name="update"]').remove();
          $('.postMain .crumbs').remove();
          var selectList = document.createElement("textarea");
          var submit = document.createElement("input");
          var cancel = document.createElement("input");
          var title = document.createElement("input");
          var label = document.createElement("label");
          submit.type = "submit";
          submit.name = "submit";
          submit.value = "Submit";
          cancel.type = "button";
          cancel.name = "cancel";
          cancel.value = "Cancel";
          title.type = "text";
          title.name = "title";
          title.value = "";
          title.id = "title";
          cancel.id = "cancel";
          selectList.id = "textarea";
          selectList.name = "edit";
          selectList.value = '';
          selectList.placeholder = "Begin Typing Here...";
          label.setAttribute("for", "title");
          label.innerHTML = "Post Title You Wish to Update: ";
          myParent.appendChild(cancel);
          var append = document.querySelector('#append');
          append.appendChild(selectList);
          append.appendChild(label);
          append.appendChild(title);
          append.appendChild(submit);
          $('.bulk #cancel').click (function() {
            location.reload();
          });
        }
      </script>
    </body>
  </html>
