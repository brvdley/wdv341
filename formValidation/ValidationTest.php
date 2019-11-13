<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Form Validation Test</title>
</head>

<body>
  <?php
    include 'FormValidation.php';
    $validateTool = new FormValidation(); //instantiate new object
    //expected failing tests
    echo "<b>" . "Expected Failures:" . "</b></br>";
    echo "Empty Quotes Test: " . $validateTool->validateRequiredStringField("") . "</br>"; // testing empty Quotes
    echo "Space Test: " . $validateTool->validateRequiredStringField(" ") . "</br>"; // testing space between Quotes
    echo "Special Chars. Test: " . $validateTool->validateRequiredStringField("$/[{}])*") . "</br>"; // testing space between Quotes
    echo "is_numeric Test: " . $validateTool->validateRequiredNumeric("sdf") . "</br>"; // required numeric
    echo "Double Space Test: " . $validateTool->validateRequiredStringField("  ") . "</br>"; // testing double space between Quotes
    echo "NULL Test: " . $validateTool->validateRequiredStringField(NULL) . "</br>"; // testing null
    echo "NULL String Test: " . $validateTool->validateRequiredStringField("nUll") . "</br>"; // testing null string
    echo "Undefined String Test: " . $validateTool->validateRequiredStringField("UnDeFiNeD") . "</br>"; // testing undefined string
    echo "Email Test: " .$validateTool->validateEmail("jeor238430gmail.com") . "</br>"; // removed @ from email
    echo "Phone Test paren: " .$validateTool->validatePhone("(641)2038710") . "</br>"; // added parenthesis
    echo "Phone Test letter: " .$validateTool->validatePhone("64a2038710") . "</br>"; //added letter (kept 10 chars)
    echo "Character Limiter: " .$validateTool->characterLimiter("a.cd3", 5) . "</br>"; // limiter with 5 chars (tested all types of chars)
    //expected passing tests
    echo "<b>" . "Expected Passes:" . "</b></br>";
    echo "Letter Test: " . $validateTool->validateRequiredStringField("a") . "</br>"; // testing Letters
    echo "Number Test: " . $validateTool->validateRequiredStringField("4") . "</br>"; // testing Numbers
    echo "is_numeric Test: " . $validateTool->validateRequiredNumeric("5434") . "</br>"; // required numeric
    echo "Email Test: " .$validateTool->validateEmail("jeor238430@gmail.com") . "</br>"; // required email
    echo "Phone Test: " .$validateTool->validatePhone("6412038710") . "</br>"; // required 10 digit phone
    echo "Character Limiter: " .$validateTool->characterLimiter("4f[d", 5) . "</br>"; // limiter with 4 chars (tested all types of chars)
  ?>
</body>
</html>
