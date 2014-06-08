<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>Report Errors</title>
</head>
<body>
<h2>Testing Error Reporting</h2>
<?php # Script 7.2 - report_errors.php

// Show errors:
ini_set('display_errors', 1);

// Adjust error reporting:
error_reporting(E_ALL);

// Create errors:
foreach ($var as $v) {}
$result = 1/0;

?>
</body>
</html>
