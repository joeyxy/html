<?php
$page_title = 'Change your password';
include ('includes/header.html');

if (isset($_POST['submitted'])){

 $errors = array();


 if (empty($_POST['pass'])){
   $errors[]= 'You forgot to enter your current password.';
    }else {
     $p = trim($_POST['pass']);
  }

 if (empty($_POST['email'])){
    $errors[]= 'You forgot to enter your email address.';
        }else {
             $e = trim($_POST['email']);
      }

 if (!empty($_POST['pass1'])){
   if ($_POST['pass1'] != $_POST['pass2']){ 
    $errors[]= 'Your password did not match the confirmed password.';
    }else{
     $np=trim($_POST['pass1']);
     //echo '<p>'.$p.'</p>';
    }
        }else {
            $errors[]='You forgot to enter your password.'; 
             }

if(empty($errors)){
 require_once('../mysqli_connect.php');
 $q = "select user_id from users where (email='$e' AND pass=SHA1('$P'))";
// echo '<p>'.$q.'</p>';

 $r = @mysqli_query($dbc,$q) ;
 $num = @mysqli_num_rows($r);
 //$r = mysqli_query($dbc,$q) OR die('Could not connect to Mysql:'.mysqli_error($dbc));
 if ($num == 1){
   $row = mysqli_fetch_array($r,MYSQLI_NUM);

   $q = "UPDATE users set pass=SHA1('$np') WHERE user_id=$row[0]";
   $r = @mysqli_query($dbc,$q);

   if(mysqli_affected_rows($dbc) == 1 ){


  echo '<h1>Thank you!</h1>
  <p>Your password have been updated.In chapter 11 you will actually be able to log in!</p><p><br /></p>';
 }else{
  echo '<h1>System error</h1>
   <p class="error">You could not be changed due to a system error.We apologize for any inconvenience.</p>';
   echo '<p>'.mysqli_error($dbc).'<br /><br />Query: '.$q.'</p>';
 }

 mysqli_close($dbc);
 include('includes/footer.html');
 exit();

} else {
   echo '<h1>error!</h1>
   <p class="error">The email address and password do not match those  on file.</p>';
}

}else {

 echo '<h1>Error!</h1> <p class="error"> The following error(s) occurred:<br />';
 foreach($errors as $msg){
  echo " - $msg<br /> \n";
 }
 echo '</p><p>please try again.</p><p><br /></p>';


}


}

?>

<h1>Change Your Password</h1>

<form action="password.php" method="post">
 <p>Email Address:<input type="text" name="email" size="15" maxlength="80" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
 <p>Current password:<input type="password" name="pass" size="15" maxlength="20" /></p>
 <p>New Password:<input type="password" name="pass1" size="10" maxlength="20" /></p>
 <p>Confirm  New Password:<input type="password" name="pass2" size="10" maxlength="20" /></p>
 <p><input type="submit" name="submit" value="Change password" /></p>
 <input type="hidden" name="submitted" value="TRUE" />
</form>

<?php
include('includes/footer.html');
?>
