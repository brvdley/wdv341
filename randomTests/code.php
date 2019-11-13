<!DOCTYPE HTML>
<html>
  <head>
      <title>PHP Functions - Unit 2</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <style>
      .word-container {
        display: flex;
        flex-flow: column wrap;
        align-items: center;
        justify-content: center;
      }
      .container {
        display: flex;
        flex-flow: column wrap;
        align-items: center;
        justify-content: center;
      }
      </style>
  </head>

  <body>
    <div class="word-container">
      <h1>WDV 341 - PHP Functions</h1>
      <h2>Formatting and more with PHP</h2>
    </div>
    <div class="container">
      <span id="outputDate"></span> <!-- output for date US -->
      <span id="outputDate2"></span> <!-- output for date International -->
      <span id="outputChars"></span> <!-- output for number of characters in string -->
      <span id="outputTrim"></span> <!-- output for trimmed string -->
      <span id="outputLc"></span> <!-- output for lowercase -->
      <span id="outputSearch"></span> <!-- output for DMACC search -->
      <span id="outputFormat"></span> <!-- output for formatting -->
      <span id="outputCurrency"></span> <!-- output for currency-->
      <?php
        function formUpdate() {
          $date = date_create($_POST["date"]);
          $length = strlen($_POST["string"]);
          $trim = trim($_POST["string"]);
          $lc = strtolower($_POST["string"]);
          $format = number_format($_POST["num"]);
          $money = number_format($_POST["num"], 2);
          echo "<script>var x = document.getElementById('outputDate');
          x.innerHTML = 'United States Format: ".date_format($date,"m/d/Y")."'; </script>";
          echo "<script>var y = document.getElementById('outputDate2');
          y.innerHTML = 'International Format: ".date_format($date,"Y/m/d")."'; </script>";
          echo "<script>var z = document.getElementById('outputChars');
          z.innerHTML = 'Number of Characters in the String Before Trim: ".$length."'; </script>";
          echo "<script>var a = document.getElementById('outputTrim');
          a.innerHTML = 'Trimmed String: ".$trim."'; </script>";
          echo "<script>var b = document.getElementById('outputLc');
          b.innerHTML = 'Lowercase String: ".$lc."'; </script>";
          if (stripos($_POST["string"], 'DMACC')) {
            echo "<script>var c = document.getElementById('outputSearch');
            c.innerHTML = 'This String Contains the Word DMACC!'; </script>";
          }
          else{
            echo "<script>var c = document.getElementById('outputSearch');
            c.innerHTML = 'This String Does Not Contain the Word DMACC!'; </script>";
          }
          echo "<script>var d = document.getElementById('outputFormat');
          d.innerHTML = 'Formatted Number: ".$format."'; </script>";
          echo "<script>var e = document.getElementById('outputCurrency');
          e.innerHTML = 'Money Formatted Number: $".$money."'; </script>";
        }
        formUpdate();
      ?>
    </div>
  </body>
</html>
