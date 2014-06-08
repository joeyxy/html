<?php # Script 9.3 - login.php

// This page processes the login form submission.
// Upon successful login, the user is redirected.
// Two included files are necessary.
// Send NOTHING to the Web browser prior to the setcookie() lines!

// Check if the form has been submitted:
if (isset($_POST['submitted'])) {

	// For processing the login:
	require_once ('includes/login_functions.inc.php');
	
	// Need the database connection:
	require_once ('../mysqli_connect.php');
		
	// Check the login:
	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);
	
	if ($check) { // OK!
			
		// Set the cookies:
		setcookie ('user_id', $data['user_id']);
		setcookie ('first_name', $data['first_name']);
		
		// Redirect:
		$url = absolute_url ('loggedin.php');
		header("Location: $url");
		exit(); // Quit the script.
			
	} else { // Unsuccessful!

		// Assign $data to $errors for error reporting
		// in the login_page.inc.php file.
		$errors = $data;

	}
		
	mysqli_close($dbc); // Close the database connection.

} // End of the main submit conditional.

// Create the page:
include ('includes/login_page.inc.php');
?>
