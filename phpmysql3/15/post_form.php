<?php

  if (!isset($words)) {
  	header("Location:http://www.baidu.com");
  	exit();
  }

  if (isset($_SESSION['user_id'])) {
  	echo '<form action="post.php" method="post" accept-charset="utf-8">';

  	if (isset($tid) && $tid) {
  		echo '<h3>'.$words['post_a_reply'].'</h3>';

  		echo '<input name="tid" type="hidden" value="'.$tid.'" />';
  	}else{
  		echo '<h3>'.$words['new_thread'].'</h3>';
  		echo '<p><em>'.$words['subject'].'</em>:<input name="subject" type="text" size="60" maxlength="100" ';

  		if (isset($subject)) {
  			echo "value=\"$subject\" ";

  		}
  		echo '/></p>';
  	}

  	echo '<p><em>'.$words['body'].'</em>:<textarea name="body" rows="10" cols="60">';

  	if (isset($body)) {
  		echo $body;
  	}
  	echo '</textarea></p>';
  	echo '<input name="submit" type="submit" value="'.$words['submit'].'"/><input name="submitted" type="hidden" value="TRUE" /></form>';
  }else{
  	echo '<p> You must be logged in to post messages.</p>';
  }


?>