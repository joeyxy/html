<?php # Script 11.5 - login.php #2

if (isset($_POST['submitted'])) {

	require_once ('includes/login_functions.inc.php');
	require_once ('../mysqli_connect.php');
	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);
	
	if ($check) { // OK!
			
		// Set the cookies:
		setcookie ('user_id', $data['user_id'], time()+3600, '/', '', 0, 0);
		setcookie ('first_name', $data['first_name'], time()+3600, '/', '', 0, 0);
		
		// Redirect:
		$url = absolute_url ('loggedin.php');
		header("Location: $url");
		exit(); 
			
	} else { // Unsuccessful!
		$errors = $data;
	}
		
	mysqli_close($dbc);

} // End of the main submit conditional.

include ('includes/login_page.inc.php');
?>
