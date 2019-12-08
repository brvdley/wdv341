<?php
require_once("brvdleyoConnect.php");
session_start();
$u = '';
$p = '';
$error = '';
$validUser = $_SESSION['validUser'];
if ($validUser) {
  header("Location: options.php");
}
else if (isset($_POST['submit'])) {
  $u = $_POST['user'];
  $p = $_POST['pass'];
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  try {
    $sql = 'SELECT * FROM event_user WHERE event_user_name = :username AND event_user_password = :password;';
    $statement = $conn->prepare($sql);
    $statement->bindparam(':username', $u);
    $statement->bindparam(':password', $p);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user) {
      $_SESSION['validUser'] = true;
      $_SESSION['userName'] = $u;
      header("Location: options.php");
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
    <title>Event User Login</title>
    <link rel="stylesheet" href="login.css" type="text/css">
  </head>
  <body>
    <div class="container">
      <nav>
        <ul class="nwrapper">
          <a href="options.php"><li id="home">Home</li></a>
        </ul>
      </nav>
      <main class="mwrapper">
        <div class="fwrapper">
          <h3>Login to Event Admin Area</h3>
          <p class="error"><?php echo $error; ?></p>
          <div class="fcontainer">
            <form class="login" action="login.php" method="post">
              <label>Username:
                <input type="text" class="user" name="user" value="<?php echo $u;?>">
              </label>
              <label>Password:
                <input type="password" class="pass" name="pass" value="<?php echo $p;?>">
              </label>
              <input type="submit" name="submit" value="Login">
            </form>
          </div>
        </div>
        <div class="gwrapper">
        </div>
      </main>
    </div>
  </body>
</html>
