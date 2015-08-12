<?php

include('includes/header.html');

$tid = FALSE;

if (isset($_GET['tid']) && is_numeric($_GET['tid'])) {
	$tid = (int)$_GET['tid'];


if ($tid>0) {
	if (isset($_SESSION['user_tz'])) {
		$posted ="CONVERT_TZ(p.posted_on,'UTC','{$_SESSION['user_tz']}')";
	} else{
		$posted = 'p.posted_on';
	}

   $q = "select t.subject,p.message,username,date_format($posted,'%e-%b-%y %l:%i %p') as posted from threads as t left join 
   posts as p using (thread_id) inner join users as u on p.user_id = u.user_id where t.thread_id = $tid order by p.posted_on asc";

   $r = mysqli_query($dbc,$q);

   if (!(mysqli_num_rows($r)>0)) {
   	  $tid = FALSE;
   }
}
}

if ($tid){
     $printed = FALSE;
     while ($messages = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
     	if (!$printed) {
     		echo "<h2>{$messages['subject']}</h2>\n";
     		$printed =TRUE;
     	}
     	echo "<p>{$messages['username']}({$messages['posted']})<br />{$messages['message']}</p><br />\n";
     }
    include('post_form.php');

}else{
	echo '<p>this page has been accessed in error.</p>';
}

include('includes/footer.html');

?>