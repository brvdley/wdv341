<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV 341 Intro PHP - Code Example</title>
<?php echo "<style>
#check4 {

}
</style>"?>
</head>

<body>
<h1>WDV341 Intro PHP</h1>
<h2>Form Handler Result Page - Code Example</h2>

<form id="form1" name="form1" method="post" action="formHandler.php">
  <p>First Name:
    <input type="text" name="firstName" id="firstName" />
</p>
  <p>Last Name:
    <input type="text" name="lastName" id="lastName" />
  </p>
  <p>School:
    <input type="text" name="school" id="school" />
  </p>
  <p>Check One:
    <input type="radio" name="radioGroup" value="Guess 1" id="radio1" />
    <input type="radio" name="radioGroup" value="Guess 2" id="radio2" />
    <input type="radio" name="radioGroup" value="Guess 3" id="radio3" />
</p>
<p>Check As Many As You'd Like:
  <input type="checkbox" name="check1" value="Option 1" id="check1" />
  <input type="checkbox" name="check2" value="Option 2" id="check2" />
  <input type="checkbox" name="check3" value="Option 3" id="check3" />
  <input type="checkbox" name="check4" value="Option 4" style="display:none !important" tabindex="-1" autocomplete="off" id="check4" />
</p>
  <p>
    <input type="submit" name="button" id="button" value="Submit" />
    <input type="reset" name="button2" id="button2" value="Reset" />
  </p>
</form>
</body>
</html>
