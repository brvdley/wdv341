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
  width: 100%;
  height: 100%;
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
</style>
</head>
<body>
<?php

  include 'emailer.php';
  $sending = new Emailer('Bradleyowens126@gmail.com', 'Test', 'Test', 'Test');
  if ($sending->send()) 	//puts pieces together and sends the email to your hosting account's smtp (email) server
  {
    echo("<div class='container'><div class='success'><p>Message successfully sent!</p></div></div>");
  }
  else
  {
    echo("<div class='container'><div class='failure'><p>Message delivery failed...</p></div></div>");
  }

?>
</body>
</html>
