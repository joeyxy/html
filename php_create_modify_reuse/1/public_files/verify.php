<?php
include '../lib/common.php';
include '../lib/db.php';
include '../lib/functions.php';
include '../lib/User.php';

if (!isset($_GET['uid'])||!isset($_GET['token'])) {
	$GLOBALS['TEMPLATE']['content'] = '<p><strong>incomplete information'.'was received.</strong></p>
	<p>Please try again.</p>';
	include '../templates/template-page.php';
	exit();
}

if (!$user = User::getById($_GET['uid'])) {
	$GLOBALS['TEMPLATE']['content'] = '<p><strong>No such account.</strong>'.'</p><p>Please try again.</p>';
}
else{
	if ($user->isActive) {
		$GLOBALS['TEMPLATE']['content'] = '<p><strong>That account'.'has already been verified.</strong></p>';
	}else
	{
		if ($user->setActive($_GET['token'])) {
			$GLOBALS['TEMPLATE']['content'] = '<p><strong>Thank you '. 'for verifying your account.</strong>
			</p><p>You may '.'now <a href="login.php"> login </a> . </p>';
		}else
		{
			$GLOBALS['TEMPLATE']['content'] = '<p><strong>You provided '. 'invalid data.</strong></p><p>Please try again.</p>';
					}

	}
}

include '../templates/template-page.php';


?>