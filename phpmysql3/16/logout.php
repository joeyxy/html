<?php
  require_once('includes/config.inc.php');
  $page_title='Logout';
  include('includes/header.html');

  if (!isset($_SESSION['first_name'])) {
  	$url = BASE_URL.'index.php';
  	ob_end_clean();
  	header("Location:$url");
  	exit();
  }else{
  	$_SESSION = array();
  	session_destroy();
  	setcookie(session_name(),'',time()-300);
  }

  echo '<h3>You are now logged out.</h3>';
  echo '<a href="http://127.0.0.1/test/phpmysql3/16/">back to index</a>';
  includes('includes/footer.html');

?>