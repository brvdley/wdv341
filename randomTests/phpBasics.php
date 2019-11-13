<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - PHP Basics</title>

</head>

<body>
<?php echo "<h1>PHP Basics</h1>" ?>
<?php $yourName = "Bradley Owens"; ?>
<?php $numberOne = "2"; ?>
<?php $numberTwo = "3"; ?>
<?php $total = "5"; ?>
<h2><?php echo $yourName ?></h2>
<p><?php echo $numberOne . " + " . $numberTwo . " = " . $total;?></p>
<span id="langs"></span></br>
<button onclick="displayLangs()">Display Array</button>
<?php echo
"<script>
function displayLangs() {
	var langTypes = ['PHP', 'HTML', 'JavaScript'];
	var x = langTypes.toString();
	document.getElementById('langs').innerHTML = x;
}
</script>"?>
</body>
</html>
