<?php
 $page_title='Delete a user';
 include('includes/header.html');
 echo '<h1>Delete a User</h1>';
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
  if ($_POST['sure'] == 'Yes'){
  $q = "DELETE FROM users where user_id=$id limit 1";
  $r = @mysqli_query($dbc,$q);
  if (mysqli_affected_rows($dbc) == 1){
   echo '<p>The user has been deleted.</p>';
  } else {
    echo '<p class="error">The user could not be deleted due to a system error.</p>';
    echo '<p>'.mysqli_error($dbc).'<br />Query: ' .$q.'</p>';
  }} else
  {
  echo '<p> The user has not been deleted.</p>';
  }
  }else{
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

  }
  mysqli_close($dbc);
 include('includes/footer.html');


?>
