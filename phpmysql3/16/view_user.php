<?php

include_once('includes/config.inc.php');
$page_title= "view all users";
include('includes/header.html');

if ($_SESSION['user_level'] == 1) {
	require_once(MYSQL);
	$q =" select * from users";
	$r = mysqli_query($dbc,$q) or trigger_error("Query:$q\n<br />MySQL Error:".mysqli_error($dbc));

	if (mysqli_num_rows($r) > 0) {
		
		echo '<table border="1">';
     while ($messages = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
     	echo '<tr>';
     	echo "<td>{$messages['first_name']}</td>\n";
     	echo "<td>{$messages['email']}</td>\n";
     } 
     echo '</tr>';
     echo '</table>';
	}else{
		echo '<p class="error">no users to display2.</p>';
	}
}else{
	echo '<p class="error"> you have no permission to view this page.</p>';
}

include('includes/footer.html');

?>