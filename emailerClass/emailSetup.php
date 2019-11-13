<?php

  include 'emailer.php';
  $inName = '';
  $inEmail = '';
  $inPhone = '';
  if (isset($_POST['submit'])) {
    $inName = $_POST['name'];
    $inEmail = $_POST['email'];
    $inPhone = $_POST['phone'];
    $sending = new Emailer($inEmail, 'Sent From: BradleyOwens126@gmail.com', 'Thank you for contacting us!', 'Here is your information: Name: ' . $inName . ' Email: ' . $inEmail . ' Phone Number: ' . $inPhone . '');
    if ($sending->send()) 	//puts pieces together and sends the email to your hosting account's smtp (email) server
    {
      echo("<div class='container' style='.container {
        width: 100%;
        height: 800px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin:0;
        padding: 0;
      }'><div class='success' style='width: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #51f353;
      border: 2px solid #3aad3b;
      align-self: center;
      border-radius: 5px;
      height: 80px;'><p>Message successfully sent!</p></div></div>");
    }
    else
    {
      echo("<div class='container' style='.container {
        width: 100%;
        height: 800px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin:0;
        padding: 0;
      }'><div class='failure' style='.failure {
        width: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ff5555;
        border: 2px solid #992020;
        align-self: center;
        border-radius: 5px;
        height: 80px;
      }'><p>Message delivery failed...</p></div></div>");
      echo('<!DOCTYPE html>
      <html>
      <head>
        <link rel="stylesheet" href="index.css">
        <title>Form Submitted</title>
        <meta type="keywords" content="brvdley contact, brvdleyowens, Contact Us">
        <meta type="description" content="php handler for contact form">
        <meta name="author" content="Bradley Owens">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
      body {
        margin: 0 auto;
        padding: 0;
        width: 100vw;
        height: 100vh;
      }
      .success {
        width: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #51f353;
        border: 2px solid #3aad3b;
        align-self: center;
        border-radius: 5px;
        height: 80px;
      }
      .failure {
        width: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ff5555;
        border: 2px solid #992020;
        align-self: center;
        border-radius: 5px;
        height: 80px;
      }
      .container {
        width: 100%;
        height: 800px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin:0;
        padding: 0;
      }
      .containerm {
        width: 100%;
        height: 100%;
        display: flex;
        flex-flow: column wrap;
        align-items: center;
        justify-content: center;
        margin:0;
        padding: 0;
      }
      .wrapper {
        width: 100%;
        height: 100%;
        display: flex;
        flex-flow: column wrap;
        align-items: center;
        justify-content: center;
        margin:0;
        padding: 0;
      }
      form {
        width: 300px;
        height: 400px;
        display: flex;
        flex-flow: column wrap;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin:5px;
        padding: 50px;
        border: 2px solid black;
      }
      h1, label {
        font-family: Arial, Helvetica, sans-serif;
      }
        </style>
      </head>

      <body>
        <div class="containerm">
          <div class="wrapper">
            <h1>Contact Us</h1>
            <form class="" action="emailSetup.php" method="post">
              <label for="name">Name: </label>
              <input type="text" name="name" value=" ' . $inName . '">
              <label for="email">Email: </label>
              <input type="email" name="email" value="' . $inEmail. '">
              <label for="phone">Phone: </label>
              <input type="text" name="phone" value="' . $inPhone . '">
              <input type="submit" name="submit" value="Submit">
              <input type="reset" name="reset">
            </form>
          </div>
        </div>
      </body>
      </html> ');
    }
  }
  else {
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="index.css">
  <title>Form Submitted</title>
  <meta type="keywords" content="brvdley contact, brvdleyowens, Contact Us">
  <meta type="description" content="php handler for contact form">
  <meta name="author" content="Bradley Owens">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
body {
  margin: 0 auto;
  padding: 0;
  width: 100vw;
  height: 100vh;
}
.success {
  width: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #51f353;
  border: 2px solid #3aad3b;
  align-self: center;
  border-radius: 5px;
  height: 80px;
}
.failure {
  width: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #ff5555;
  border: 2px solid #992020;
  align-self: center;
  border-radius: 5px;
  height: 80px;
}
.container {
  width: 100%;
  height: 800px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin:0;
  padding: 0;
}
.containerm {
  width: 100%;
  height: 100%;
  display: flex;
  flex-flow: column wrap;
  align-items: center;
  justify-content: center;
  margin:0;
  padding: 0;
}
.wrapper {
  width: 100%;
  height: 100%;
  display: flex;
  flex-flow: column wrap;
  align-items: center;
  justify-content: center;
  margin:0;
  padding: 0;
}
form {
  width: 300px;
  height: 400px;
  display: flex;
  flex-flow: column wrap;
  align-items: center;
  justify-content: center;
  border-radius: 10px;
  margin:5px;
  padding: 50px;
  border: 2px solid black;
}
h1, label {
  font-family: Arial, Helvetica, sans-serif;
}
  </style>
</head>

<body>
  <div class="containerm">
    <div class="wrapper">
      <h1>Contact Us</h1>
      <form class="" action="emailSetup.php" method="post">
        <label for="name">Name: </label>
        <input type="text" name="name" value="">
        <label for="email">Email: </label>
        <input type="email" name="email" value="">
        <label for="phone">Phone: </label>
        <input type="text" name="phone" value="">
        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset">
      </form>
    </div>
  </div>
</body>
</html>
<?php } ?>
