<?php

require_once('includes/config.inc.php');

$page_title = 'Login';

include('includes/header.html');

if (isset($_POST['submitted'])) {
	require_once(MYSQL);

	if (!empty($_POST['email'])) {
		$e = mysqli_real_escape_string($dbc,$_POST['email']);
	}else{
		$e = FALSE;
		echo '<p class="error">You forgot to enter your email address!</p>';
	}


	if (!empty($_POST['pass'])) {
		$p = mysqli_real_escape_string($dbc,$_POST['pass']);
	}else{
		$p = FALSE;
		echo '<p class="error">You forgot to enter your password!</p>';
	}

	if ($e && $p) {
		$q = "select user_id,first_name,user_level from users where (email ='$e' and pass=sha1('$p')) and active IS NULL";
	
		$r = mysqli_query($dbc,$q) or trigger_error("Query:$q\n <br />MySQL Error:".mysqli_error($dbc));

		if (@mysqli_num_rows($r) == 1) {
			$_SESSION = mysqli_fetch_array($r,MYSQLI_ASSOC);
			mysqli_free_result($r);
			mysqli_close($dbc);

			$url = BASE_URL.'index.php';
			ob_end_clean();
			header("Location:$url");
			exit();
			
		} else{
			echo '<p class="error">Either the email address and password entered do not match those on file or you have not yet activated your account.</p>';
		}
	}else{
		echo '<p class="error">Please try again.</p>';
	}
	 mysqli_close($dbc);

	}


?>

<h1>Login</h1>
<p>Your browser must allow cookies in order to log in.</p>
<form action="login.php" method="post">
	<fieldset>
		<p><b>Email Address:</b><input type="text" name="email" size="20" maxlength="40" /></p>
		<p><b>Password:</b><input type="password" name="pass" size="20" maxlength="20" /></p>
		<div align="center"><input type="submit" name="submit" value="login" /></div>
		<input type="hidden" name="submitted" value="TRUE" />
	</fieldset>

</form>

<?php
include('includes/footer.html');

?>