<?php header ('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Collation in PHP</title>
</head>
<body style="font-size: 18pt;">
<?php # Script 14.3 - collation.php

// Create an array of words:
$words = array('chère', 'côté', 'chaise', 'château', 'chaînette', 'châle', 'Chère', 'côte', 'chemise');

// Sort using the default PHP function:
echo '<h3>Using sort()</h3>';
sort($words);
echo implode('<br />', $words);

// Sort using the Collator:
echo '<h3>Using Collator</h3>';
$c = new Collator('fr_FR');
$c->sort($words);
echo implode('<br />', $words);

?>
</body>
</html>
