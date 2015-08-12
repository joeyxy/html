<?php

require_once('includes/config.inc.php');
$page_title = 'Activate your account';
include('includes/header.html');

$x=$y=FALSE;

if (isset($_GET['x'])&& preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/',$_GET['x'])) {
	$x = $_GET['x'];
}

if (isset($_GET['y']) && (strlen($_GET['y']) ==32 )) {
	$y = $_GET['y'];
}

if ($x && $y) {
	require_once(MYSQL);
	$q = "update users set active=NULL where (email='".mysqli_real_escape_string($dbc,$x)."' and active ='".mysqli_real_escape_string($dbc,$y). "') limit 1";
	$r = mysqli_query($dbc,$q) or trigger_error("query:$q\n<br />MySQL Error:".mysqli_error($dbc));

	if (mysqli_affected_rows($dbc) == 1) {
		echo "<h3>Your account is now active.You may now log in.</h3>";
	} else{
		echo '<p class="error">Your account could not be activated.please check the link or contact the system administrator.</font></p>';
	}
	mysqli_close($dbc);
}else{
	$url = BASE_URL.'index.php';
	ob_end_clean();
	header("Location:$url");
	exit();
}
include('includes/footer.html');
?>