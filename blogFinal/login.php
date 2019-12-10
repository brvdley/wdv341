<?php
require_once("brvdleyoConnect.php");
session_start();
$u = '';
$p = '';
$error = '';
$validUser = $_SESSION['validUser'];
if ($validUser) {
  header("Location: index.php");
}
else if (isset($_POST['submit'])) {
  $u = $_POST['user'];
  $p = $_POST['pass'];
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  try {
    $sql = 'SELECT * FROM blog_users WHERE user_name = :username AND user_password = :password;';
    $statement = $conn->prepare($sql);
    $statement->bindparam(':username', $u);
    $statement->bindparam(':password', $p);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user) {
      $_SESSION['validUser'] = true;
      $_SESSION['userName'] = $u;
      header("Location: index.php");
    }
    else {$error ="Invalid Username or Password. Please Try Again.";}
    }
    catch(PDOException $e) {
      echo "Process Failed: " . $e->getMessage();
    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Blog Login</title>
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
            <a href="register.php"><li id="register">REGISTER</li></a>
          </div>
        </ul>
      </nav>
      <main class="mwrapper">
        <div class="fwrapper">
          <h3 class="ani">Welcome!</h3>
          <div class="fcontainer">
            <h2>Please start by signing in.</h2>
            <p class="error"><?php echo $error; ?></p>
            <form class="login" action="login.php" method="post">
              <div class="user">
                <label for="user">Username -</label>
                <input type="text" class="user" name="user" value="<?php echo $u;?>">
              </div>
              <div class="pass">
                <label for="pass">Password -</label>
                <input type="password" class="pass" name="pass" value="<?php echo $p;?>">
              </div>
              <input type="submit" name="submit" value="Login">
            </form>
            <h4>OR</h4>
            <a href="register.php"><input type="button" value="Register" name="register" id="registerc2a"></a>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
