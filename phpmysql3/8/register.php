<?php
$page_title = 'Register';
include ('includes/header.html');

if (isset($_POST['submitted'])){

 $errors = array();

 if (empty($_POST['first_name'])){
  $error[]= 'You forgot to enter your first name.';
 }else {
 $fn = trim($_POST['first_name']);
 }

 if (empty($_POST['last_name'])){
   $error[]= 'You forgot to enter your last name.';
    }else {
     $ln = trim($_POST['last_name']);
  }

 if (empty($_POST['email'])){
    $error[]= 'You forgot to enter your email address.';
        }else {
             $e = trim($_POST['email']);
      }

 if (!empty($_POST['pass1'])){
   if ($_POST['pass1'] != $_POST['pass2']){ 
    $error[]= 'Your password did not match the confirmed password.';
    }else{
     $p=trim($_POST['pass1']);
    }
        }else {
            $error[]='You forgot to enter your password.'; 
             }

if(empty($errors)){
 require_once('../mysqli_connect.php');
 $q = "INSERT INTO users(first_name,last_name,email,pass,registration_date) VALUES ('$fn','$ln','$e',SHA('$P'),NOW())";
 $r = @mysqli_query($dbc,$q);
 if ($r){
  echo '<h1>Thank you!</h1>
  <p>You are now registered.In chapter 11 you will actually be able toi log in!</p><p><br /></p>';
 }else{
  echo '<h1>System error</h1>
   <p class="error">You could not be registered due to a system error.We apologize for any inconvenience.</p>';
 }

 mysqli_close($dbc);
 include('include/footer.html');
 exit();
} else {

 echo '<h1>Error!</h1> <p class="error"> The following error(s) occurred:<br />';
 foreach($error as $msg){
  echo " - $msg<br /> \n";
 }
 echo '</p><p>please try again.</p><p><br /></p>';


}


}

?>

<h1>Register</h1>

<form action="register.php" method="post">

</form>

<?php
include('includes/footer.html');
?>
