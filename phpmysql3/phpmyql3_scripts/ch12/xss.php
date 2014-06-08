<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>XSS Attacks</title>
</head>
<body>
<?php # Script 12.3 - xss.php

if (isset($_POST['submitted'])) {

	// Apply the different functions, printing the results:
	echo "<h2>Original</h2><p>{$_POST['data']}</p>";
	echo '<h2>After htmlentities()</h2><p>' . htmlentities($_POST['data']). '</p>';
	echo '<h2>After strip_tags()</h2><p>' . strip_tags($_POST['data']). '</p>';

}

// Display the form:
?>
<form action="xss.php" method="post">

	<p>Do your worst! <textarea name="data" rows="3" cols="40"></textarea></p>
	<div align="center"><input type="submit" name="submit" value="Submit" /></div>
	<input type="hidden" name="submitted" value="TRUE" />

</form>
</body>
</html>
