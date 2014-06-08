<?php header ('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Unicode in PHP</title>
</head>
<body style="font-size: 18pt;">
<em>Names from Around the World</em>
<?php # Script 14.2 - unicode.php

// Create an array of names:
$names = array('João', 'Γιώργος', 'Anton', 'Tomáš', 'Kamilė', 'Frančiška', '愛子', '杰西卡');

// Loop through the array:
foreach ($names as $name) {
	echo "<p>$name has " . strlen($name) . " characters<br />\n" . strtoupper($name) . " in capital letters</p>\n";
}

?>
</body>
</html>
