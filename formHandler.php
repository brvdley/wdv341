<?php
//Model-Controller Area.  The PHP processing code goes in this area.

	//Method 2.  This method pulls the individual name-value pairs from the $_POST using the name
	//as the key in an associative array.

	$inFirstName = $_POST["firstName"];		//Get the value entered in the first name field
	$inLastName = $_POST["lastName"];		//Get the value entered in the last name field
	$inSchool = $_POST["school"];  //Get the value entered in the school field
  $inRadio = $_POST["radioGroup"];
  $inCheck1 = $_POST["check1"];	//get the value chosen from radio
  $inCheck2 = $_POST["check2"];
  $inCheck3 = $_POST["check3"];


?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV 341 Intro PHP - Code Example</title>
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
  <input type="checkbox" name="check4" value="Option 4" id="check4" />
</p>
  <p>
    <input type="submit" name="button" id="button" value="Submit" />
    <input type="reset" name="button2" id="button2" value="Reset" />
  </p>
</form>

<h3>Display the values from the form using Method 2. Displays the individual values.</h3>
<?php $honeypot = FALSE;
if (!empty($_REQUEST['check4']) && (bool) $_REQUEST['check4'] == TRUE) {
    $honeypot = TRUE;
    log_spambot($_REQUEST);
    # treat as spambot
} else { ?>
<p>School: <?php echo $inSchool; ?></p>
<p>First Name: <?php echo $inFirstName; ?></p>
<p>Last Name: <?php echo $inLastName; ?></p>
<p>Chosen Guess: <?php echo $inRadio; ?></p>
<p>Chosen Option/s: <?php echo $inCheck1; ?>, <?php echo $inCheck2; ?>, <?php echo $inCheck3; ?></p>
<?php } ?>
</body>
</html>
