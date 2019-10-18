<?php
include 'FormValidation.php';
$validateTool = new FormValidation();
	$inName = ''; //Initially setting all sections to blank
	$inPhone = '';
	$inEmail = '';
	$regType = '';
	$bagRad = '';
	$check1 = '';
	$check2 = '';
	$check3 = '';
	$check4 = '';
	$inText = '';
	$test1 = "main";
	$test2 = "presenter";
	$test3 = "attendee";
	$test4 = "volunteer";
	$test5 = "guest";
	$test6 = "radio";
	$test7 = "radio2";
	$test8 = "radio3";
	$isValid1 = true;
	$isValid2 = true;
	$isValid3 = true;
	$isValid4 = true;
	$isValid5 = true;
	$isValid6 = true;
	$isValid7 = true;
	$allCorrect = true;
	$errorMessage1 = "";
	$errorMessage2 = "";
	$errorMessage3 = "";
	$errorMessage4 = "";
	$errorMessage5 = "";
	$errorMessage6 = "";
	$errorMessage7 = "";
	$successMessage = "";
	if (isset($_POST['submit'])) {
		if (isset($_POST['radiog'])) {
	    $bagRad = $_POST['radiog'];
	  }
    $inName = $_POST['textfield'];
		$inPhone = $_POST['textfield2'];
		$inEmail = $_POST['textfield3'];
		$check1 = isset($_POST['checkbox1']);
		$check2 = isset($_POST['checkbox2']);
		$check3 = isset($_POST['checkbox3']);
		$regType = $_POST['select'];
		$inText = $_POST['textarea'];

		if ($validateTool->validateRequiredStringField($inName)) {
      $isValid1 = true;
      }
      else {
        $isValid1 = false;
				$allCorrect = false;
        $errorMessage1 = "This field is Invalid";
        $successMessage = "";
      }

			if ($validateTool->validatePhone($inPhone)) {
				$isValid2 = true;
				}
				else {
					$isValid2 = false;
					$allCorrect = false;
					$errorMessage2 = "This field is Invalid";
					$successMessage = "";
				}

			if ($validateTool->validateEmail($inEmail)) {
				$isValid3 = true;
				}
				else {
					$isValid3 = false;
					$allCorrect = false;
					$errorMessage3 = "This field is Invalid";
					$successMessage = "";
				}

				if (isset($_POST['submit']) && array_search($test1, $regType) != "main") {
		      $isValid4 = true;
		      }
		      else {
		        $isValid4 = false;
						$allCorrect = false;
		        $errorMessage4 = "This field is Invalid";
		        $successMessage = "";
		      }

					if ($validateTool->validateRequiredField($bagRad)) {
			      $isValid5 = true;
			      }
			      else {
			        $isValid5 = false;
							$allCorrect = false;
			        $errorMessage5 = "This field is Invalid";
			        $successMessage = "";
			      }
						if ($validateTool->validateRequiredStringField($inText) && $validateTool->characterLimiter($inText, 200)) {
				      $isValid7 = true;
				      }
				      else {
				        $isValid7 = false;
								$allCorrect = false;
				        $errorMessage7 = "This field is Invalid";
				        $successMessage = "";
				      }
							if ($isValid1 && $isValid2 && $isValid3 && $isValid4 && $isValid5 && $isValid6 && $isValid7) {
								$allCorrect = true;
				        $errorMessage1 = "";
				        $errorMessage2 = "";
								$errorMessage3 = "";
								$errorMessage4 = "";
								$errorMessage5 = "";
								$errorMessage6 = "";
								$errorMessage7 = "";
				        $successMessage = "Thanks for your submission";
								$inName = '';
								$inPhone = '';
								$inEmail = '';
								$bagRad = '';
								$check1 = '';
								$check2 = '';
								$check3 = '';
								$check4 = '';
								$inText = '';
				        }

}
	if (isset($_POST['checkbox4'])) {
		echo "<h1 style='color: red;'>BOT ALERT BOT ALERT, HONEYPOT ACTIVATED!</h1>";
	}?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Self Posting Form</title>
<style>

#orderArea	{
	width:600px;
	border:thin solid black;
	margin: auto auto;
	padding-left: 20px;
}

textarea {
	font-family: Arial, Helvetica, sans-serif;
}

#orderArea h3	{
	text-align:center;
}
.error {
  color: red;
  margin: 0;
  padding: 0;
}

.success {
  color: green;
  margin: 0;
  padding: 0;
}
#checkbox4 {
	visibility: hidden;
}
#c4 {
	visibility: hidden;
}
#counter {
	margin-left: 5px;
}
</style>
</head>


<body>
<h1>WDV341 Intro PHP</h1>
<h2>Unit-5 and Unit-6 Self Posting - Form Validation Assignment


</h2>
<p>&nbsp;</p>


<div id="orderArea">
<form name="form3" method="post" action="custReg.php">
  <h3>Customer Registration Form</h3>
	<p class="success"><?php echo $successMessage ?></p>
      <p>
				<p class="error"><?php echo $errorMessage1 ?></p>
        <label for="textfield">Name:</label>
        <input type="text" name="textfield" id="textfield" placeholder="John" value="<?php echo $inName; ?>">
      </p>
      <p>
				<p class="error"><?php echo $errorMessage2 ?></p>
        <label for="textfield2">Phone Number:</label>
        <input type="text" name="textfield2" id="textfield2" placeholder="5556667777" value="<?php echo $inPhone; ?>">
      </p>
      <p>
				<p class="error"><?php echo $errorMessage3 ?></p>
        <label for="textfield3">Email Address: </label>
        <input type="text" name="textfield3" id="textfield3" placeholder="example@example.com" value="<?php echo $inEmail; ?>">
      </p>
      <p>
				<p class="error"><?php echo $errorMessage4 ?></p>
        <label for="select[]">Registration: </label>
        <select name="select[]" id="select" value="<?php print_r($regType)  ?>">
					<option value="main" <?php if (isset($_POST['submit']) && array_search($test1, $regType) == "main") {echo "selected";} else if ($allCorrect = true) {echo "selected";} else {echo "";}?>>Select an Option</option>
					<option value="attendee" class="checker" <?php if (isset($_POST['submit']) && array_search($test3, $regType) == "attendee") {echo "selected";} else {echo "";}?>>Attendee</option>
					<option value="presenter" class="checker" <?php if (isset($_POST['submit']) && array_search($test2, $regType) == "presenter") {echo "selected";} else {echo "";}?>>Presenter</option>
					<option value="volunteer" class="checker" <?php if (isset($_POST['submit']) && array_search($test4, $regType) == "volunteer") {echo "selected";} else {echo "";}?>>Volunteer</option>
					<option value="guest" class="checker" <?php if (isset($_POST['submit']) && array_search($test5, $regType) == "guest") {echo "selected";} else {echo "";}?>>Guest</option>
        </select>
      </p>
			<p class="error"><?php echo $errorMessage5 ?></p>
      <p style="margin: 0; padding: 0;">Badge Holder:</p>
      <p>
				<label for="radio">Clip</label>
        <input type="radio" name="radiog[]" id="radio" value="radio" <?php if (isset($_POST['submit']) && is_array($bagRad) && in_array($test6, $bagRad) == "1") { echo 'checked'; } else {echo '';} ?>> <br>
				<label for="radio2">Lanyard</label>
				<input type="radio" name="radiog[]" id="radio2" value="radio2" <?php if (isset($_POST['submit']) && is_array($bagRad) && in_array($test7, $bagRad) == "1") { echo 'checked'; } else {echo '';}?>> <br>
        <label for="radio3">Magnet</label>
        <input type="radio" name="radiog[]" id="radio3" value="radio3" <?php if (isset($_POST['submit']) && is_array($bagRad) && in_array($test8, $bagRad) == "1") { echo 'checked'; } else {echo '';}?>>
      </p>
			<p class="error"><?php echo $errorMessage6 ?></p>
      <p>Provided Meals (Select all that apply):</p>
      <p>
        <input type="checkbox" name="checkbox1" id="checkbox" value="fri" <?php if($check1) {echo "checked";} else {$check1 = '';}?>>
        <label for="checkbox" id="c1">Friday Dinner</label><br>
        <input type="checkbox" name="checkbox2" id="checkbox2" value="sat" <?php if($check2) {echo "checked";} else {$check2 = '';}?>>
        <label for="checkbox2" id="c2">Saturday Lunch</label><br>
        <input type="checkbox" name="checkbox3" id="checkbox3" value="sun" <?php if($check3) {echo "checked";} else {$check3 = '';}?>>
        <label for="checkbox3" id="c3">Sunday Award Brunch</label><br>
				<input type="checkbox" name="checkbox4" id="checkbox4" value="mon" <?php if($check4) {echo "checked";} else {$check4 = '';}?> tabindex="-1" autocomplete="off">
        <label for="checkbox4" id="c4">Monday Breakfast</label>
      </p>
      <p>
				<p class="error"><?php echo $errorMessage7?></p>
        <label for="textarea">Special Requests/Requirements: (Limit 200 characters & No Special Characters)<br>
        </label>
        <textarea name="textarea" cols="40" rows="5" id="textarea" placeholder="Type Message Here..."value=""><?php echo $inText ?></textarea><span id="counter"></span>
				<script>document.getElementById('counter').innerHTML = document.getElementById('textarea').value.length + "/200"; document.getElementById('textarea').onkeyup = function () {
  document.getElementById('counter').innerHTML = this.value.length + "/200";
};</script>
      </p>
  <p>
    <input type="submit" name="submit" id="button3" value="Submit" onClick="selectorReset()">
    <input type="reset" name="reset" id="button4" value="Reset" onClick="selectorReset()">
  </p>
</form>
</div>

</body>
<script>
//var types = ['Attendee', 'Presenter', 'Volunteer', 'Guest'];

//for (i = 0; i < types.length; i++) {
	//var opt = document.createElement("option");
  //document.getElementById("select").innerHTML += '<option value="' + types[i] + '">' + types[i] + '</option>';
//}
</script>
</html>
