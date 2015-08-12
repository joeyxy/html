<?php
require_once('includes/config.inc.php');
$page_title = 'Forgot Your password';
include('includes/header.html');


if (isset($_POST['submitted'])) {
	require_once(MYSQL);

	$uid = FALSE;

	if (!empty($_POST['email'])) {
		$q = 'select user_id from users where email="'.mysqli_real_escape_string($dbc,$_POST['email']).'"';
		$r = mysqli_query($dbc,$q) or trigger_error("Query:$q\n<br />MySQL Error:".mysqli_error($dbc));

		if (mysqli_num_rows($r) ==1 ) {
			list($uid) = mysqli_fetch_array($r,MYSQLI_NUM);
		}else{
			echo '<p class="error">The submitted email address does not match those on file!</p>';
		}
	}else{
		echo '<p class="error">You forgot to enter your email address!</p>';
	}

	if ($uid) {
		$p = substr(md5(uniqid(rand(),true)), 3,10);
		$q = "update users set pass=sha1('$p') where user_id=$uid limit 1";
		$r = mysqli_query($dbc,$q) or trigger_error("Query:$q\n<br />MySQL Error:".mysqli_error($dbc));

		if (mysqli_affected_rows($dbc) == 1) {
			$body = "Your password to log into joey.com has been temporarily changed to '$p'.Please log in using this password and this email address.
			Then you may change your password to something more familiar.";
			mail($_POST['email'], 'Your temporary password.', $body,'From:joey.x@qq.com');

			echo '<h3>Your password has been changed.You will receive the new,temporary password at the email address with which you registered.Once 
			you have logged in with this password,you may change it by clicking on the "Change password" link.</h3>';
			mysqli_close($dbc);
			include('includes/footer.html');
			exit();
		} else{
			echo '<p class="error">Your password could not be changed due to a system error.We apologize for any inconvenience.</p>';
		}
	} else {
		echo '<p class="error">please try again</p>';
	}
   mysqli_close($dbc);
}

?>


<h1>Reset Your Password</h1>
<p>Enter your email address below and your password will be reset.</p>
<form action="forgot_password.php" method="post">
	<fieldset>
		<p><b>Email address:</b><input type="text" name="email" size="20" maxlength="40" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
	</fieldset>
    <div align="center"><input type="submit" name="submit" value="Reset My Password" /></div>
    <input type="hidden" name="submitted" value="TRUE" />
</form>

<?php
	include('includes/footer.html');
?>