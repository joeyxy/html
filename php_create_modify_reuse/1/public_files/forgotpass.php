<?php
  include '../lib/common.php';
  include '../lib/db.php';
  include '../lib/functions.php';
  include '../lib/User.php';

  ob_start();
?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
	method="post">
	<p>Enter your username.A new password will be sent to your email.</P>
 <table>
 	<tr>
 		<td><label for="username">username</label></td>
 		<td><input type="text" name="username" id="username"
 			value="<?php if(isset($_POST['username'])) echo htmlspecialchars($_POST['username']); ?>"/></td>
 	</tr><tr>
   <td></td>
   <td><input type="submit" value="Submit"/></td>
   <td><input type="hidden" name="submitted" value="1" /></td>
 </tr><tr>
 </table>
</form>
<?php
$form = ob_get_clean();

if (!isset($_POST['submitted'])) {
	$GLOBALS['TEMPLATE']['content'] = $form;

}else
{
	if (User::validateUsername($_POST['username'])) {
		$user = User::getByUsername($_POST['username']);
		if (!$user->userId) {
			$GLOBALS['TEMPLATE']['content'] = '<p><strong>Sorry,that '.
			'accout does not exist.</strong></p>please try again.';
			$GLOBALS['TEMPLATE']['content'] .= $form;
		}else
		{
			$password = random_text(8);

			$message = 'Your new password is:'.$password;
			mail($user->emailAddr, 'New password', $message);
			$GLOBALS['TEMPLATE']['content'] = '<p><strong>A new '.
			'password has been emailed to you.</strong></p>';
			$user->password = $password;
			$user->save();
		}
	}
	else
	{
		$GLOBALS['TEMPLATE']['content'] .='<p><strong>You did not '.
		'provide a valid username.please try again.</strong></p>';
		$GLOBALS['TEMPLATE']['content'] .= $form; 
	}
}

include '../templates/template-page.php';
?>