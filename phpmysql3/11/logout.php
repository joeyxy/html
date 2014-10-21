<?php
 if(!isset($_COOKIE['user_id'])){
  require_once('includes/login_functions.inc.php');
  $url = absolute_url();
  header("Location:$url");
  exit();
}else {
  setcookie('user_id','',time()-3600,'/','',0,0);
  setcookie('first_name','',time()-3600,'/','',0,0);
}

$page_title = 'Logged Out!';
include('includes/header.html');


echo "<h1>Logged out!</h1>
<p>You are now logged out,{$_COOOKIE['first_name']}!</p>";



?>
