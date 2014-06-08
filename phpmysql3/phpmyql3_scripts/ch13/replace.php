<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>Testing PCRE Replace</title>
</head>
<body>
<?php // Script 13.3 - replace.php

// This script takes a submitted string and checks it against a submitted pattern.
// This version replaces one value with another.

if (isset($_POST['submitted'])) {

	// Trim the strings:
	$pattern = trim($_POST['pattern']);
	$subject = trim($_POST['subject']);
	$replace = trim($_POST['replace']);
			
	// Print a caption:
	echo "<p>The result of replacing<br /><b>$pattern</b><br />with<br />$replace<br />in<br />$subject<br /><br />";

	// Check for a match:
	if (preg_match ($pattern, $subject) ) {
		echo preg_replace($pattern, $replace, $subject) . '</p>';
	} else {
		echo 'The pattern was not found!</p>';
	}
	
} // End of submission IF.
// Display the HTML form.
?>
<form action="replace.php" method="post">
	<p>Regular Expression Pattern: <input type="text" name="pattern" value="<?php if (isset($pattern)) echo $pattern; ?>" size="30" /> (include the delimiters)</p>
	<p>Replacement: <input type="text" name="replace" value="<?php if (isset($replace)) echo $replace; ?>" size="30" /></p>
	<p>Test Subject: <textarea name="subject" rows="5" cols="30"><?php if (isset($subject)) echo $subject; ?></textarea></p>
	<input type="submit" name="submit" value="Test!" />
	<input type="hidden" name="submitted" value="TRUE" />
</form>
</body>
</html>
