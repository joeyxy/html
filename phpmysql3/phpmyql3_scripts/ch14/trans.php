<?php header ('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Transliteration</title>
</head>
<body style="font-size: 18pt;">
<em>What's my name?</em>
<?php # Script 14.4 - trans.php

// Your name:
$me = 'Larry Ullman';

// Create an array of scripts:
$scripts = array('Greek', 'Cyrillic', 'Hebrew', 'Arabic', 'Hangul');

// Loop through each script:
foreach ($scripts as $script) {
	echo "<p>$me is " . str_transliterate($me, 'Latin', $script) . " in $script.</p>\n";
}

?>
</body>
</html>
