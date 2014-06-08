<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>Testing PCRE</title>
</head>
<body>
<?php // Script 13.1 - pcre.php

// This script takes a submitted string and checks it against a submitted pattern.

if (isset($_POST['submitted'])) {
	
	// Trim the strings:
	$pattern = trim($_POST['pattern']);
	$subject = trim($_POST['subject']);
			
	// Print a caption:
	echo "<p>The result of checking<br /><b>$pattern</b><br />against<br />$subject<br />is ";
	
	// Test:
	if (preg_match ($pattern, $subject) ) {
		echo 'TRUE!</p>';
	} else {
		echo 'FALSE!</p>';
	}
	
} // End of submission IF.
// Display the HTML form.
?>
<form action="pcre.php" method="post">
	<p>Regular Expression Pattern: <input type="text" name="pattern" value="<?php if (isset($pattern)) echo $pattern; ?>" size="30" /> (include the delimiters)</p>
	<p>Test Subject: <input type="text" name="subject" value="<?php if (isset($subject)) echo $subject; ?>" size="30" /></p>
	<input type="submit" name="submit" value="Test!" />
	<input type="hidden" name="submitted" value="TRUE" />
</form>
</body>
</html>
