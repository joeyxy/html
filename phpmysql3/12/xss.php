<html lang="en">
<head>
<title>xss test</title>
</head>

<body>
<?php
if (isset($_POST['submitted'])) {
	echo "<h2>original</h2><p>{$_POST['data']}</p>";
	echo "<h2>After htmlentities()</h2><p>".htmlentities($_POST['data'])."</p>";
	echo "<h2>After strip_tags()</h2><p>".strip_tags($_POST['data'])."</p>";
}

?>

<form action="xss.php" method="post">
  <p>Do your worst<textarea name="data" rows="3" cols="40"></textarea></p>
  <div align="center"><input type="submit" name="submit" value="Submit" /></div>
  <input type="hidden" name="submitted" value="TRUE" />
</form>


</body>

</html>