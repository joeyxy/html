<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Testing PCRE</title></head>

<body>
<?php 
 if (isset($_POST['submitted'])) {
 	$pattern = trim($_POST['pattern']);
 	$subject = trim($_POST['subject']);
 	
 	
 	
 	echo "<p> the results of checking<br /><b>$pattern</b><br />against<br />$subject<br />is ";
 	
 	if (preg_match_all($pattern,$subject,$matches)) {
		echo 'TRUE!</p>';
		echo '<pre>'.print_r($matches,1).'</pre>';
 	}else {
   echo 'False!</p>';
}
 }
?>

<form action="matches.php" method="post">
<p>Regular exp pattern:<input type="text" name="pattern" value="<?php if (isset($_POST['pattern'])) {
	echo $pattern;
}?>" size="30" /> </p>

<p>Test subject:<input type="text" name="subject" value="<?php if (isset($_POST['subject'])) echo $subject;?>" size="30"/>

<input type="submit" name="submit" value="test" />
<input type="hidden" name="submitted" value="TRUE" />

</form>


</body>

</html>
