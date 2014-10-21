<?php

if (isset($_POST['submitted'])){
  require_once('includes/login_functions.inc.php');

  require_once('../mysqli_connect.php');

  list($check,$data) = check_login($dbc,$_POST['email'],$_POST['pass']);

  if($check){
   setcookie('user_id',$data['user_id'],time()+3600,'/','',0,0);
   setcookie('first_name',$data['first_name'],time()+3600,'/','',0,0);

   $url = absolute_url('loggedin.php');
   header("Location:$url");
  exit();
}else {
  $errors = $data;
}

 mysqli_close($dbc);
}

include('includes/login_page.inc.php');

?>
