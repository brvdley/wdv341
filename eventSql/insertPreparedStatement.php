<?php
include 'FormValidation.php';
require_once("brvdleyoConnect.php");

$validateTool = new FormValidation();

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$inName = '';
$inPresenter = '';
$inDescription = '';
$inDay = '';
$inMonth = '';
$inYear = '';
$inHour = '';
$inMinute = '';
$formattedDate = '';
$formattedTime = '';
$errorMessage1 = '';
$errorMessage2 = '';
$errorMessage3 = '';
$errorMessage4 = '';
$errorMessage5 = '';
$successMessage = '';
$test1 = 'am';
$test2 = 'pm';
$isPM = false;
$radioS = '';
if (isset($_POST['submit'])) {
  if (isset($_POST['time'])) {
    $radioS = $_POST['time'];
    if ($radioS = 'pm') {
      $isPM = true;
    }
  }
$inName = $_POST['textfield'];
$inMonth = $_POST['textfield4'];
$inDay = $_POST['textfield5'];
$inYear = $_POST['textfield6'];
$inHour = $_POST['textfield7'];
$inMinute = $_POST['textfield8'];
$inPresenter = $_POST['textfield3'];
$inDescription = $_POST['textarea'];
if ($validateTool->validateRequiredStringField($inName)) {
  $isValid1 = true;
  }
  else {
    $isValid1 = false;
    $allCorrect = false;
    $errorMessage1 = "This field is Invalid";
    $successMessage = "";
  }
  if ($validateTool->validateRequiredStringField($inPresenter)) {
    $isValid2 = true;
    }
    else {
      $isValid2 = false;
      $allCorrect = false;
      $errorMessage2 = "This field is Invalid";
      $successMessage = "";
    }
    if ($validateTool->validateRequiredStringField($inDescription) && $validateTool->characterLimiter($inDescription, 200)) {
      $isValid3 = true;
      }
      else {
        $isValid3 = false;
        $allCorrect = false;
        $errorMessage3 = "This field is Invalid";
        $successMessage = "";
      }
      if ($validateTool->validateRequiredNumeric($inMonth) && $validateTool->validateRequiredNumeric($inDay) && $validateTool->validateRequiredNumeric($inYear)) {
        $formattedDate = date("Y-m-d", mktime(0,0,0,$inMonth,$inDay,$inYear));
        $isValid4 = true;
        }
        else {
          $isValid4 = false;
          $allCorrect = false;
          $errorMessage4 = "This field is Invalid";
          $successMessage = "";
        }
        if ($validateTool->validateRequiredNumeric($inHour) && $validateTool->validateRequiredNumeric($inMinute) && $validateTool->validateRequiredField($radioS)) {
          if ($isPM) {$inHour += 12;};
          $formattedTime = date("H:i:s", mktime($inHour,$inMinute,0));
          $isValid5 = true;
          }
          else {
            $isValid5 = false;
            $allCorrect = false;
            $errorMessage5 = "This field is Invalid";
            $successMessage = "";
          }
      	if ($isValid1 && $isValid2 && $isValid3 && $isValid4 && $isValid5) {
          try {
            $sql = "INSERT INTO events (events_id, events_name, events_description, events_presenter, events_date, events_time)
            VALUES (NULL, :eName, :eDescription, :ePresenter, :eDate, :eTime);";

            $statement = $conn->prepare($sql);
            $statement->bindParam(':eName', $inName);
            $statement->bindParam(':eDescription', $inDescription);
            $statement->bindParam(':ePresenter', $inPresenter);
            $statement->bindParam(':eDate', $formattedDate);
            $statement->bindParam(':eTime', $formattedTime);

            $statement->execute();

          }
          catch(PDOException $e) {
            echo "Process Failed: " . $e->getMessage();
          }
          $allCorrect = true;
          $errorMessage1 = "";
          $errorMessage2 = "";
          $errorMessage3 = "";
          $successMessage = "Thanks for your submission";
          $inName = '';
          $inPresenter = '';
          $inDescription = '';
          $inMonth = '';
          $inDay = '';
          $inYear = '';
          $inMonth = '';
          $inHour = '';
          $inMinute = '';
        }
}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <title>Insert Prepared Statement</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <style>
    .error {
      color: red;
      font-weight: bold;
    }
    .success {
      color: green;
      font-weight: bold;
    }
    body, textarea, input[type='submit'], input[type='reset'] {
      font-family: Arial, Helvetica, sans-serif;
    }
    body {
      height: 98vh;
      width: 98vw;
    }
    input {
      margin-top: 5px;
      margin-bottom: 5px;
    }
    .form {
      height: 70%;
      width: 70%;
      display: flex;
      flex-flow: column;
      align-items: center;
      align-content: center;
      justify-content: center;
    }
    .Rcontainer {
      height: 100%;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-flow: column;
    }
    form {
      display: flex;
      flex-flow: column;
      align-items: center;
      justify-content: center;
    }
    #one, #two, #three, #four {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-flow: row wrap;
      height: 50%;
      width: 30%;
    }
    #five, #six {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-flow: column wrap;
    }
    #five input[type="text"], #six input[type="text"] {
      height: 20px;
      width: 20px;
    }
    #five input[name="textfield6"] {
      height: 20px;
      width: 30px;
    }
    p, label {
      text-align: center;
    }
   </style>
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>
 </head>

 <body>
   <div class="Rcontainer">

     <div class="form">
       <div class="titleC">
         <h1>Contact Us: </h1>
       </div>
       <form name="form" class="contact" method="post" action="insertPreparedStatement.php">
         <p class="success"><?php echo $successMessage ?></p>
         <div id="one">
           <p class="error"><?php echo $errorMessage1 ?></p>
           <label for="textfield">Event Name:</label>
           <input type="text" name="textfield" id="textfield" placeholder="WDV 341" value="<?php echo $inName; ?>">
         </div>
         <div id="three">
           <p class="error"><?php echo $errorMessage3?></p>
           <label for="textarea">Event Description: (Limit 200 characters & No Special Characters)<br>
           </label>
           <textarea name="textarea" cols="40" rows="5" id="textarea" placeholder="Type Message Here..."value=""><?php echo $inDescription ?></textarea><span id="counter"></span>
           <script>document.getElementById('counter').innerHTML = document.getElementById('textarea').value.length + "/200"; document.getElementById('textarea').onkeyup = function () {
             document.getElementById('counter').innerHTML = this.value.length + "/200";
           };</script>
         </div>
         <div id="two">
           <p class="error"><?php echo $errorMessage2 ?></p>
           <label for="textfield3">Event Presenter: </label>
           <input type="text" name="textfield3" id="textfield3" placeholder="Jeff Gullion" value="<?php echo $inPresenter; ?>">
         </div>
         <div id="five">
           <p class="error"><?php echo $errorMessage4 ?></p>
           <label for="textfield4">Event Date: </label><br>
          <div class="dateG">
           <input type="text" name="textfield4" id="textfield4" maxlength="2" placeholder="MM" value="<?php echo $inMonth ?>">-
           <input type="text" name="textfield5" id="textfield5" maxlength="2" placeholder="DD" value="<?php echo $inDay ?>">-
           <input type="text" name="textfield6" id="textfield6" maxlength="4" min="1000" placeholder="YYYY" value="<?php echo $inYear ?>">
          </div>
         </div>
         <div id="six">
           <p class="error"><?php echo $errorMessage5 ?></p>
           <label for="textfield7">Event Time: </label><br>
          <div class="timeG">
           <input type="text" name="textfield7" id="textfield7" placeholder="HH" value="<?php echo $inHour; ?>">:
           <input type="text" name="textfield8" id="textfield8" placeholder="MM" value="<?php echo $inMinute; ?>">
           <label>AM
           <input type="radio" name="time[]" id="am" value="am" <?php if (isset($_POST['submit']) && is_array($radioS) && in_array($test1, $radioS) == "1") { echo 'checked';  } else {echo '';} ?>>
           </label>
           <label>PM
           <input type="radio" name="time[]" id="pm" value="pm" <?php if (isset($_POST['submit']) && is_array($radioS) && in_array($test2, $radioS) == "1") { echo 'checked';  } else {echo '';} ?>>
           </label>
          </div>
         </div>
         <div id="four">
           <div class="g-recaptcha" data-sitekey="6Ld3XsIUAAAAALjUwj0I6T73vexFu1Zq5E7uA74c"></div>
           <br/>
           <input type="submit" name="submit" value="Submit">
           <input type="reset" value="Reset" onClick="resetThis()">
         </div>
       </form>
     </div>
   </div>
</body>
</html>
