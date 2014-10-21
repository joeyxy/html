<?php

$page_title='Login';
include('includes/header.html');


if(!empty($errors)){

 echo '<h1>Error!</h1>
<p class="error">The followind erro occurred:<br />';

 foreach ($errors as $msg){
  echo "- $msg<br />\n";
}
 echo '</p><p>Please try again.</p>';
}

?>

<h1>Login</h1>
<form action="login.php" method="post">
 <p>Email Address:<input type="text" name="email" size="20" maxlength="90" /> </p>
 <p>Password:<input type="password" name="pass" size="20" maxlength="20" /></p>
  <p><input type="submit" name="submit" value="Login" /></p>
 <input type="hidden" name="submitted" value="TRUE" />

</form>

<?php
 include('includes/footer.html');
?>
