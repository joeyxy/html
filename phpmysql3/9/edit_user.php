<?php
 $page_title='Edit a user';
 include('includes/header.html');
 echo '<h1>Edit a User</h1>';
// echo 'user id :'.$_POST['id'];

 if((isset($_GET['id'])) && (is_numeric($_GET['id']))){
 //if(isset($_GET['id'])) {
  $id = $_GET['id'];
// }elseif(isset($_POST['id'])){
 }elseif((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
   $id = $_POST['id'];
 }else {
   echo '<p class="error">This page has been accessed in error.</p>';
   include('includes/footer.html');
   exit();
 }

 require_once('../mysqli_connect.php');

 if (isset($_POST['submitted'])){
   
   if(empty($_POST['first_name'])){
   $errors[] = 'You forgot to enter your first name.';
   }else{
   $fn = mysqli_real_escape_string($dbc,trim($POST['first_name']));
   }

   if(empty($_POST['last_name'])){
    $errors[] = 'You forgot to enter your last name.';
     }else{
     $ln = mysqli_real_escape_string($dbc,trim($POST['last_name']));
   }

    if(empty($_POST['email'])){
     $errors[] = 'You forgot to enter your email address.';
     }else{
     $e = mysqli_real_escape_string($dbc,trim($POST['email']));
    }

 if(empty($errors)){

  $q = "select user_id FROM users where email='$e' and user_id != $id";
  $r = @mysqli_query($dbc,$q);
  if (mysqli_num_rows($r) == 0){
  $q = "update users set first_name='$fn',last_name='$ln',email='$e' where user_id=$id limit 1";
  $r = @mysqli_query($dbc,$q);
if(mysqli_affected_rows($dbc) == 1){

   echo '<p>The user has been edited.</p>';
  } else {
    echo '<p class="error">The user could not be edited due to a system error.</p>';
    echo '<p>'.mysqli_error($dbc).'<br />Query: ' .$q.'</p>';
  } else
  {
  echo '<p class="error"> The email address has already been registered.</p>';
  }
  }else{
   echo '<p class="error">The following error occurred:<br />';
   foreach ($erros as $msg){

   }
  }
  $q = "select concat(last_name,',',first_name) from users where user_id=$id";
  $r = @mysqli_query($dbc,$q);

  if(mysqli_num_rows($r) == 1){
   $row= mysqli_fetch_array($r,MYSQLI_NUM);
   echo '<form action="delete_user.php" method="post">
   <h3>Name:'.$row[0].'</h3>
   <p>Are you sure you want to delete this user?<br />
   <input type="radio" name="sure" value="Yes" />Yes
   <input type="radio" name="sure" value="No" checked="checked" />No </p>
   <p><input type="submit" name="submit" value="Submit" /></P>
   <input type="hidden" name="submitted" value="True" />
   <input type="hidden" name="id" value="'.$id.'" />
   </form> 
   ';
  }else{
  echo '<p class="error">This page has been accessed in error.</p>';
  }

  
  mysqli_close($dbc);
 include('includes/footer.html');


?>
