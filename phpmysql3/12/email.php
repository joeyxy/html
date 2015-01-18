<html lang="en">
<head>
<title>Contact me</title>

</head>

<body>
<h1>
Contact me
</h1>

<?php
if (isset($_POST['submitted'])) {
     function spam_scrubber($value){
     	$very_bad = array('to:','cc:','content-type','mimi-version:');
     	foreach ($very_bad as $key ) {
     		if (stripos($value, $key) != false) {
				return '';     			
     		}
     		
     	}
     	$value = str_replace(array("\r", "\n","%0a","%0d"),'', $value);

     	return trim($value);
     }	

     $scrubbed = array_map('spam_scrubber', $_POST);

     if (!empty($scrubbed['name'])&& !empty($scrubbed['email'])&& !empty($scrubbed['comments'])) {     
     	$body = "Name: {$scrubbed['name']}\n\nComments:{$scrubbed['comments']}";
     	$body = wordwrap($body,70);

     	mail('joey.x@icloud.com','Contact Form Submission',$body,"From:{$scrubbed['email']}");

     	echo "<p><em>thank you for Contact me. i will reply some day.</em></p>";
     	$_POST =  array();

     } else {
     	echo '<p style="font-weight:bold;color:#C00">please fill out the form completely.</p>';
     }
}

?>
<p>Please fill out this form to contact me.</p>

<form action="email.php" method="post">
 <p>Name:<input type="text" name="name" size="30" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" /></p>
 <p>Email Address:<input type="text" name="email" size="30" maxlength="80" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
 <p>Comments:<textarea name="comments" rows="5" cols="30"><?php if(isset($_POST['comments'])) echo $_POST['comments']; ?></textarea></p>
 <p><input type="submit" name="submit" value="Send!" /></p>
 <input type="hidden" name="submitted" value="TRUE" />
</form>

</body>

</html>