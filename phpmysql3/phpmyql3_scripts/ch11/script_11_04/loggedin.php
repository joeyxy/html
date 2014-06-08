<?php # Script 11.4 - loggedin.php

// The user is redirected here from login.php.

// If no cookie is present, redirect the user:
if (!isset($_COOKIE['user_id'])) {

	// Need the functions to create an absolute URL:
	require_once ('includes/login_functions.inc.php');
	$url = absolute_url();
	header("Location: $url");
	exit(); // Quit the script.
	
}

// Set the page title and include the HTML header:
$page_title = 'Logged In!';
include ('includes/header.html');

// Print a customized message:
echo "<h1>Logged In!</h1>
<p>You are now logged in, {$_COOKIE['first_name']}!</p>
<p><a href=\"logout.php\">Logout</a></p>";

include ('includes/footer.html');
?>
