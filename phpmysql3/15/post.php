<?php

include('includes/header.html');

if (isset($_POST['submitted'])) {
	$tid = FALSE;
	if (isset($_POST['tid']) && is_numeric($_POST['tid'])) {
		$tid =(int)$_POST['tid'];
		if($tid <= 0){
			$tid = FALSE;
		}
	}

	if (!$tid && empty($_POST['subject'])) {
		$subject = FALSE;
		echo '<p>Please enter a subject for this post.</p>';
	}elseif (!$tid && !empty($_POST['subject'])) {
		$subject = htmlspecialchars(strip_tags($_POST['subject']));
	}else{
		$subject = TRUE;
	}

	if (!empty($_POST['body'])) {
		$body = htmlentities($_POST['body']);
	}else{
		$body = FALSE;
		echo '<p> Please enter a body for this post.</p>';
	}

	if ($subject && $body) {
		if (!$tid) {
	
		$q = "insert into threads(lang_id,user_id,subject) values ({$_SESSION['lid']},{$_SESSION['user_id']},'".mysqli_real_escape_string($dbc,$subject)."')";
		$r = mysqli_query($dbc,$q) or die(mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1 ) {
			$tid = mysqli_insert_id($dbc);
		}else{
			echo '<p>Your post could not be handled due to a system error1.</p>';
		}
	}

	if ($tid) {
		$q = "insert into posts(thread_id,user_id,message,posted_on) values ($tid,{$_SESSION['user_id']},'".mysqli_real_escape_string($dbc,$body)."',UTC_TIMESTAMP())";
		$r = mysqli_query($dbc,$q);
		if (mysqli_affected_rows($dbc) == 1) {
					echo '<p>Your post has been entered.</p>';
				}else{
					echo '<p>Your post could not be handled due to a system error2.</p>';
				}		
	}

} else{
	include('post_form.php');
}
} else{
	include('post_form.php');
}
include('includes/footer.html');
?>