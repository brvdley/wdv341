<?php
require_once("brvdleyoConnect.php");
//require_once("localhostConnect.php");
include 'FormValidation.php';
include 'emailer.php';
$validateTool = new FormValidation();
session_start();

if ($_SESSION['validRegister'] == false) {
  header('Location: studentRegister.php');
}

$firstName = "";
$lastName = "";
$password = "";
$email = $_SESSION['userName'];
$major = "";
$minor = "";
$portfolio = "";
$secondary = "";
$linkedIn = "";
$goals = "";
$hometown = "";
$state = "";
$hobbies = "";
$cEmail = "";
$errorMessageFirstName = "";
$errorMessageLastname = "";
$errorMessagePassword = "";
$errorMessageMinor = "";
$errorMessagePortfolio = "";
$errorMessageSecondary = "";
$errorMessageLinkedIn = "";
$errorMessageGoals = "";
$errorMessageHometown = "";
$errorMessageHobbies = "";
$errorMessageCEmail = "";
$successMessage = "";
$isValidFirstName = "";
$isValidLastName = "";
$isValidPassword = "";
$isValidMinor = "";
$isValidPortfolio = "";
$isValidSecondary = "";
$isValidLinkedIn = "";
$isValidGoals = "";
$isValidHometown = "";
$isValidHobbies = "";
$isValidCEmail = "";

if (isset($_POST['submit'])) {
  $firstName = $_POST['fName'];
  $lastName = $_POST['lName'];
  $password = $_POST['password'];
  $email = $_SESSION['userName'];
  $major = $_POST[major];
  $minor = $_POST['minor'];
  $portfolio = $_POST['portfolio'];
  $secondary = $_POST['secondary'];
  $linkedIn = $_POST['linkedin'];
  $goals = $_POST['career'];
  $hometown = $_POST['hometown'];
  $state = $_POST[state];
  $hobbies = $_POST['hobbies'];
  $cEmail = $_POST['cemail'];

  if ($validateTool->validateRequiredStringField($firstName) && $validateTool->characterLimiter($firstName, 100)) {
    $isValidFirstName = true;
    }
    else {
      $isValidFirstName = false;
      $errorMessageFirstName = "This field is Invalid";
      $successMessage = "";
    }
    if ($validateTool->validateRequiredStringField($lastName) && $validateTool->characterLimiter($lastName, 100)) {
      $isValidLastName = true;
      }
      else {
        $isValidLastName = false;
        $errorMessageLastName = "This field is Invalid";
        $successMessage = "";
      }
      if ($validateTool->validateRequiredStringField($password) && $validateTool->characterLimiter($password, 100)) {
        $isValidPassword = true;
        }
        else {
          $isValidPassword = false;
          $errorMessagePassword = "This field is Invalid";
          $successMessage = "";
        }
            if ($validateTool->characterLimiter($minor, 100)) {
              $isValidMinor = true;
              }
              else {
                $isValidMinor = false;
                $errorMessageMinor = "This field is Invalid";
                $successMessage = "";
              }
              if ($validateTool->characterLimiter($portfolio, 100)) {
                $isValidPortfolio = true;
                }
                else {
                  $isValidPortfolio = false;
                  $errorMessagePortfolio = "This field is Invalid";
                  $successMessage = "";
                }
                if ($validateTool->characterLimiter($goals, 100)) {
                  $isValidGoals = true;
                  }
                  else {
                    $isValidGoals = false;
                    $errorMessageGoals = "This field is Invalid";
                    $successMessage = "";
                  }
                  if ($validateTool->characterLimiter($hometown, 100)) {
                    $isValidHometown = true;
                    }
                    else {
                      $isValidHometown = false;
                      $errorMessageHometown = "This field is Invalid";
                      $successMessage = "";
                    }
                      if ($validateTool->characterLimiter($hobbies, 100)) {
                        $isValidHobbies = true;
                        }
                        else {
                          $isValidHobbies = false;
                          $errorMessageHobbies = "This field is Invalid";
                          $successMessage = "";
                        }
                        if ($validateTool->characterLimiter($secondary, 100)) {
                          $isValidSecondary = true;
                          }
                          else {
                            $isValidSecondary = false;
                            $errorMessageSecondary = "This field is Invalid";
                            $successMessage = "";
                          }
                          if ($validateTool->characterLimiter($linkedIn, 100)) {
                            $isValidLinkedIn = true;
                            }
                            else {
                              $isValidLinkedIn = false;
                              $errorMessageLinkedIn = "This field is Invalid";
                              $successMessage = "";
                            }
                            if ($validateTool->characterLimiter($cEmail, 100)) {
                              $isValidCEmail = true;
                              }
                              else {
                                $isValidCEmail  = false;
                                $errorMessageCEmail  = "This field is Invalid";
                                $successMessage = "";
                              }
  if ($isValidPortfolio && $isValidFirstName && $isValidLastName && $isValidPassword && $isValidMinor && $isValidHometown && $isValidGoals && $isValidHobbies && $isValidSecondary && $isValidLinkedIn && $isValidCEmail ) {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
      $stmt = $conn->prepare("INSERT INTO student_info_2020 (student_first_name, student_last_name, student_major, student_portfolio, student_linkedin, student_secondary, student_hometown, student_career_goals, student_hobbies, student_state, student_password, student_username, student_minor, student_contact_email)
      VALUES (:firstName, :lastName, :major, :portfolio, :linkedIn, :secondary, :hometown, :goals, :hobbies, :state, :password, :email, :minor, :cemail);");
      $stmt->bindParam(':firstName', $firstName);
      $stmt->bindParam(':lastName', $lastName);
      $stmt->bindParam(':major', $major);
      $stmt->bindParam(':portfolio', $portfolio);
      $stmt->bindParam(':linkedIn', $linkedIn);
      $stmt->bindParam(':secondary', $secondary);
      $stmt->bindParam(':hometown', $hometown);
      $stmt->bindParam(':goals', $goals);
      $stmt->bindParam(':hobbies', $hobbies);
      $stmt->bindParam(':state', $state);
      $stmt->bindParam(':password', $password);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':minor', $minor);
      $stmt->bindParam(':cemail', $cEmail);
      $stmt->execute();
      header("Location: studentLogin.php"); exit;
    }
    catch(PDOException $e) {
      echo "Process Failed: " . $e->getMessage();
      $sending2 = new Emailer('bradleyowens126@gmail.com', 'Sent From: BradleyOwens126@gmail.com', 'Site Error', "$e->getMessage();");
      $sending2->send();
    }
  }
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="DMACC Portfolio Day 2020 Student Input Form.">
    <meta name="keywords" content="DMACC, Portfolio Day 2020, Web Development, Graphic Design, Photography, Video Production">
    <meta name="author" content="Bradley Owens">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/favicon.png" sizes="32x32" type="image/png">
    <title>DMACC Portfolio Day 2020</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="fContainer">
        <form action="studentInput.php" method="POST" id="input">
          <header id="inputHeader">
            <h1>Welcome Students!</h1>
            <p>This is the DMACC Portfolio Day 2020 student form. Please fill it out to your best ability below. Please use your DMACC email.</p>
          </header>
          <p id="success"><?php echo $successMessage; ?></p>
          <div class="row1">
            <p id="error"><?php echo $errorMessageFirstName; ?></p>
            <label for="fName">First Name:</label>
            <input type="text" name="fName" value="<?php echo $firstName;?>" tabindex="1" id="firstName" required></input>
            <p id="error"><?php echo $errorMessageLastName; ?></p>
            <label for="lName">Last Name:</label>
            <input type="text" name="lName" value="<?php echo $lastName;?>" tabindex="2" id="lastName" required></input>
          </div>
          <div class="row2">
            <p id="error"><?php echo $errorMessagePassword; ?></p>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo $password;?>" tabindex="3" required></input><img id="show" src="assets/eye.svg" title="Show Password" alt="Show Password" height="25px" width="25px">
            <label for="userName">Username (DMACC Email):</label>
            <input type="email" name="userName" value="<?php echo $email;?>" tabindex="4" id="email" disabled></input>
          </div>
          <div class="row3">
            <label for="major">Program:</label>
            <select id="major" name="major" tabindex="5"  value="<?php echo $major?>">
              <option value="default">Please select a major...</option>
              <option value="Graphic Design">Graphic Design</option>
              <option value="Web Development">Web Development</option>
              <option value="Animation">Animation</option>
              <option value="Photography">Photography</option>
              <option value="Video Production">Video Production</option>
            </select>
            <p id="error"><?php echo $errorMessageMinor; ?></p>
            <label for="minor">Emphasis (Optional):</label>
            <input type="text" name="minor" value="<?php echo $minor;?>" tabindex="6" id="minor"></input>
          </div>
          <div class="row4">
            <p id="error"><?php echo $errorMessagePortfolio; ?></p>
            <label for="portfolio">Portfolio Website:</label>
            <input type="text" name="portfolio" value="<?php echo $portfolio;?>" tabindex="7" id="portfolio"></input>
            <p id="error"><?php echo $errorMessageSecondary; ?></p>
            <label for="secondary">Secondary Website (Optional):</label>
            <input type="text" name="secondary" value="<?php echo $secondary;?>" tabindex="8" id="secondary"></input>
          </div>
          <div class="row5">
            <p id="error"><?php echo $errorMessageLinkedIn; ?></p>
            <label for="linkedin">LinkedIn (Optional):</label>
            <input type="text" name="linkedin" value="<?php echo $linkedIn;?>" tabindex="9" id="linkedin"></input>
            <p id="error"><?php echo $errorMessageGoals; ?></p>
            <label for="career">Career Goals:</label>
            <textarea name="career" tabindex="10" id="goals"><?php echo $goals;?></textarea>
          </div>
          <div class="row6">
            <p id="error"><?php echo $errorMessageHometown; ?></p>
            <label for="hometown">Hometown:</label>
            <input type="text" name="hometown" value="<?php echo $hometown;?>" tabindex="11" id="home"></input>
            <label for="state">State:</label>
            <select name="state" id="state" tabindex="12" value="<?php echo $state?>">
              <option value="default">Please select a state...</option>
	             <option value="AL">Alabama</option>
	             <option value="AK">Alaska</option>
	             <option value="AZ">Arizona</option>
	             <option value="AR">Arkansas</option>
	             <option value="CA">California</option>
	             <option value="CO">Colorado</option>
	             <option value="CT">Connecticut</option>
	             <option value="DE">Delaware</option>
	             <option value="DC">District Of Columbia</option>
	             <option value="FL">Florida</option>
	             <option value="GA">Georgia</option>
	             <option value="HI">Hawaii</option>
	             <option value="ID">Idaho</option>
	             <option value="IL">Illinois</option>
	             <option value="IN">Indiana</option>
  	           <option value="IA">Iowa</option>
  	           <option value="KS">Kansas</option>
	             <option value="KY">Kentucky</option>
	             <option value="LA">Louisiana</option>
	             <option value="ME">Maine</option>
	             <option value="MD">Maryland</option>
	             <option value="MA">Massachusetts</option>
	             <option value="MI">Michigan</option>
	             <option value="MN">Minnesota</option>
	             <option value="MS">Mississippi</option>
	             <option value="MO">Missouri</option>
	             <option value="MT">Montana</option>
	             <option value="NE">Nebraska</option>
	             <option value="NV">Nevada</option>
	             <option value="NH">New Hampshire</option>
	             <option value="NJ">New Jersey</option>
	             <option value="NM">New Mexico</option>
	             <option value="NY">New York</option>
	             <option value="NC">North Carolina</option>
	             <option value="ND">North Dakota</option>
	             <option value="OH">Ohio</option>
	             <option value="OK">Oklahoma</option>
	             <option value="OR">Oregon</option>
	             <option value="PA">Pennsylvania</option>
	             <option value="RI">Rhode Island</option>
	             <option value="SC">South Carolina</option>
	             <option value="SD">South Dakota</option>
	             <option value="TN">Tennessee</option>
	             <option value="TX">Texas</option>
	             <option value="UT">Utah</option>
	             <option value="VT">Vermont</option>
	             <option value="VA">Virginia</option>
	             <option value="WA">Washington</option>
	             <option value="WV">West Virginia</option>
	             <option value="WI">Wisconsin</option>
	             <option value="WY">Wyoming</option>
            </select>
          </div>
          <div class="row7">
            <p id="error"><?php echo $errorMessageHobbies; ?></p>
            <label for="hobbies">Hobbies:</label>
            <textarea name="hobbies" tabindex="13" id="hobbies"><?php echo $hobbies;?></textarea>
            <p id="error"><?php echo $errorMessageCEmail; ?></p>
            <label for="cemail">Contact Email (Optional):</label>
            <input type="email" name="cemail" value="<?php echo $cEmail;?>" tabindex="14" id="cemail"></input>
          </div>
          <div class="row8">
            <input id="submit" type="submit" name="submit" value="Submit" tabindex="15">
            <input type="reset" name="reset" value="Reset" tabindex="16">
          </div>
        </form>
      </div>
      <footer>
        <div class="social">
          <a href="https://www.facebook.com/dmaccportfolioday/" target="_blank"><img src="https://icongr.am/devicon/facebook-original.svg?size=40"></a>
          <a href="https://twitter.com/DMACCNews" target="_blank"><img src="https://icongr.am/devicon/twitter-original.svg?size=40"></a>
          <a href="https://www.instagram.com/dmaccportfolioday/" target="_blank"><img src="https://bit.ly/2vz3hjf" height="40px" width="40px"></a>
        </div>
        <div class="credit">
          <p>Icons by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></p>
        </div>
      </footer>
    </div>
    <script>
    $('#show').click(function() {
      if ($('#password').attr('type', 'password')) {
      $('#password').attr('type', 'text');}
    });
    </script>
  </body>
</html>
