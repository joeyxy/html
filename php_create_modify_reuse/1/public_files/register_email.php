<?php
include '../lib/common.php';
include '../lib/db.php';
include '../lib/functions.php';
include '../lib/User.php';

session_start();
header('Cache-control:private');

ob_start();
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
 <table>
 <tr>
 <td> <label for="username">Username</label></td>
 <td><input type="text" name="username" id="username" value="<?php if(isset($_POST['username']))
     echo htmlspecialchars($_POST['username']); ?>" /></td>
     </tr> <tr> 
     <td><label for="password1">Password</label></td>
     <td><input type="password" name="password1" id="password1" value="" /></td>
 </tr><tr>
 <td><label for="password2">Password Again</label></td>
 <td><input type="password" name="password2" id="password2" value=""/></td>
</tr><tr>
    <td><label for="email">Email address</label></td>
    <td><input type="text" name="email" id="email" value="<?php if (isset($_POST['email'])) 
    echo htmlspecialchars($_POST['email']); ?>"></td>
</tr><tr>
<td><label for="captcha">Verify</label></td>
    <td>Enter text seen in this image <br />
    	<img src="img/captcha.php?nocache=<?php echo time(); ?>" alt=""/><br />
    	<input type="text" name="captcha" id="captcha" /></td>
    </tr><tr>
    <td></td>
    <td><input type="submit" value="Sign up" /></td>
    <td><input type="hidden" name="submitted" value="1" /></td>
     </tr><tr>
 </table>
</form>
<?php
$form = ob_get_clean();

if (!isset($_POST['submitted'])) {
	$GLOBALS['TEMPLATE']['content'] = $form;
}else{
	$password1=(isset($_POST['password1']))?$_POST['password1']:'';
	$password2=(isset($_POST['password2']))?$_POST['password2']:'';
	$password = ($password1 && $password1 == $password2)? sha1($password1):'';
	$captcha = (isset($_POST['captcha'])&&strtoupper($_POST['captcha']==$_SESSION['captcha']));

if (User::validateUsername($_POST['username'])&&$password&&User::validateEmailAddr($_POST['email'])&&$captcha) {
	$user = User::getByUsername($_POST['username']);
	if ($user->userId) {
		$GLOBALS['TEMPLATE']['content'] = '<p><strong>Sorry,that'.'account already exists.</strong></p><p>please try a 
		 '.'different username.</p>';
		 $GLOBALS['TEMPLATE']['content'] .= $form;
	}else
	{
		$user = new User();
		$user->username = $_POST['username'];
		$user->password = $password;
		$user->emailAddr = $_POST['email'];
		$token = $user->setInactive();

		$message = 'Thank you fro signing up for account!before you'.
		'can login you need to verify your account.you can do so by visiting '.
		'http://127.0.0.1/test/php_create_modify_reuse/1/public_files/verify.php?uid='.$user->userId.'&token='.$token.'.';

		if (@mail($user->emailAddr, 'Activate your new account', $message)) {
			$GLOBALS['TEMPLATE']['content'] = '<p><strong>Thank you for '.'registering.</strong></p><p> Please check your email for activate.</p>';
			
		}else
       {
		$GLOBALS['TEMPLATE']['content'] = '<p><strong>There was an error sending you the activation link.</strong></p><p> Please contact admin at '.
		'<a href="mailto:joey.x@icloud.com"> joey.x@icloud.com</a></p>';
	}
	}
}else{
  $GLOBALS['TEMPLATE']['content'] .= '<p><strong>You provided some '.'invalid data.</strong></p><p>Please fill in all 
  field '.'corrently so we can register your user account.</p>';
  $GLOBALS['TEMPLATE']['content'] .= $form;
}
}
 include '../templates/template-page.php';

?>
