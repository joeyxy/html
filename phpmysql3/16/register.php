<?php
 require_once('includes/config.inc.php');

 $page_title = 'Register';
 include('includes/header.html');

 if (isset($_POST['submitted'])) {
 	require_once(MYSQL);

 	$trimmed = array_map('trim',$_POST);

 	$fn = $ln =$e =$p = FALSE;

	// Check for a first name:
	  if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
		$fn = mysqli_real_escape_string ($dbc, $trimmed['first_name']);
	  } else {
		echo '<p class="error">Please enter your first name!</p>';
	  }
	
	// Check for a last name:
	 if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
		$ln = mysqli_real_escape_string ($dbc, $trimmed['last_name']);
	  } else {
		echo '<p class="error">Please enter your last name!</p>';
	  }
	
	// Check for an email address:
	if (preg_match ('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $trimmed['email'])) {
		$e = mysqli_real_escape_string ($dbc, $trimmed['email']);
	  } else {
		echo '<p class="error">Please enter a valid email address!</p>';
	 }

	// Check for a password and match against the confirmed password:
	if (preg_match ('/^\w{4,20}$/', $trimmed['password1']) ) {
		if ($trimmed['password1'] == $trimmed['password2']) {
			$p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
		} else {
			echo '<p class="error">Your password did not match the confirmed password!</p>';
		}
	   } else {
	  	echo '<p class="error">Please enter a valid password!</p>';
	}

	if ($fn && $ln && $e && $p) {

		$q = "SELECT user_id FROM users WHERE email='$e'";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 0) { // Available.
		$a = md5(uniqid(rand(),true));

		$q = "insert into users(email,pass,first_name,last_name,active,registration_date) values ('$e',sha1('$p'),'$fn','$ln','$a',now())";
		$r = mysqli_query($dbc,$q) or trigger_error("Query:$q\n<br />MySQL Error: ".mysqli_error($dbc));

		if (mysqli_affected_rows($dbc) == 1) {
			$body = "thank you for registering at joey.com . To cactivate your account,please click on this link:\n\n";
			$body .=BASE_URL.'activate.php?x='.urlencode($e)."&y=$a";
			 mail($trimmed['email'], 'Registration Confirmation', $body,'From: joey.x@qq.com');
			echo $body;

			echo '<h3>Thank you for registering! a confirmation email has been sent to your address.Please click on link in that email in order to 
			activate your account.</h3>';
			include('includes/footer.html');
			exit();
		   }else{
			echo '<p class="error">You could not be registered due to a system error.We apologize for any inconvenience.</p>';
		    }
	   }else{
		  echo '<p class="error">That email address has already been registered.If you have forgotten your password,use the link at right to have your password
		 sent to you.</p>';}
	
    }else{
	echo '<p class="error">Please re-enter your password and try again.</p>';
}

		mysqli_close($dbc);
	
}

?>

<h1>Register</h1>
<form action="register.php" method="post">
	<fieldset>
	
	<p><b>First Name:</b> <input type="text" name="first_name" size="20" maxlength="20" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>" /></p>
	
	<p><b>Last Name:</b> <input type="text" name="last_name" size="20" maxlength="40" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>" /></p>
	
	<p><b>Email Address:</b> <input type="text" name="email" size="30" maxlength="80" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" /> </p>
		
	<p><b>Password:</b> <input type="password" name="password1" size="20" maxlength="20" /> <small>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</small></p>
	
	<p><b>Confirm Password:</b> <input type="password" name="password2" size="20" maxlength="20" /></p>
	</fieldset>
	
	<div align="center"><input type="submit" name="submit" value="Register" /></div>
	<input type="hidden" name="submitted" value="TRUE" />

</form>

<?php
include('includes/footer.html');
?>


