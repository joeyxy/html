<?php header ('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Locales</title>
</head>
<body style="font-size: 18pt;">
<?php # Script 14.5 - locales.php

// Set the default timezone:
date_default_timezone_set('UTC');

// Need a date object:
$d = new DateTime();

// Create a list of locales:
$locales = array('en_US', 'fr_FR', 'es_BO', 'zh_Hans_CN', 'ru_RU', 'el_GR', 'is_IS');

// Print the date in each locale:
foreach ($locales as $locale) {

	// Set the locale:
	locale_set_default($locale);
	
	// Print the date:
	echo "<p>$locale: " . strtotitle(date_format_locale($d, 'l, j F Y')) . "</p>\n";

}

?>
</body>
</html>
