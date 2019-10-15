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
      form {
        display: flex;
        flex-flow: column wrap;
        align-items: center;
        justify-content: center;
      }
      form > * {
        margin: 5px;
      }
      </style>
  </head>

  <body>
    <div class="word-container">
      <h1>WDV 341 - PHP Functions</h1>
      <h2>Formatting and more with PHP</h2>
    </div>
    <div class="container">
      <form action="/classes/341/func/code.php" method="post"> <!-- link to code php func file -->
        <label for="date">Date:</label>
        <input type="text" name="date" placeholder="08-08-2018 or 2018-08-08"> <!-- input for date -->
        <span>Must be in num-num-num format</span>
        <label for="string">String:</label>
        <input type="text" name="string"> <!-- input for string -->
        <label for="num">Number:</label>
        <input type="text" name="num"> <!-- input for number -->
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
      </form>
    </div>
  </body>
</html>
