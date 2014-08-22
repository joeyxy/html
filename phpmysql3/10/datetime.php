<html lang="en">
 <head>

  <title>Contact Me</title>

 </head>

<body>
<h1>Contact Me</h1>

<?php
 date_default_timezone_set('America/New_York');
 if(isset($_POST['submitted'])){
 if(!empty($_POST['name'])&&!empty($_POST['email']) && !empty($_POST['comments'])){
   $body = "Name: {$_POST['name']}\n\nComments: {$_POST['comments']}";

   $body = wordwrap($body,70);

   mail('xiangyang@digisky.com','Contact Form Submission',$body,"From:{$_POST['email']}");

   echo '<p><em>Thank you for contacting me at '.date('g:i a (T)').'on'.date('l F j, Y').'.i will replay some day.</em></p>';
   echo '<p><strong>It took '.(time() - $_POST['start']).'seconds for you to complete and submit the form.</strong></p>';

   $_POST = array();

 }else{
  echo '<p style="font-weight:bold;color:#C00">Please fill out the form completely.';
 }
}


?>
<p>Please fill out this form to contact me</p>

<form action="datetime.php" method="post">
 <p>Name: <input type="text" name="name" size="30" maxlength="60" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>"/></p>
 <p>Email Address: <input type="text" name="email" size="30" maxlength="60" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"/></p>
 <p>Comments: <textarea name="comments" rows="5" size="30" > <?php if(isset($_POST['comments'])) echo $_POST['comments']; ?> </textarea></p>
 <p><input type="submit" name="submit" value="Send!" /></p>
 <input type="hidden" name="submitted" value="TRUE" />
 <input type="hidden" name="start" value="<?php echo time(); ?>" />
</form>
</body>
</html>
