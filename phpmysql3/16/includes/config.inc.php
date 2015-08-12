<?php

define('LIVE',FALSE);

//define('LIVE',TRUE);

define ('EMAIL','joey.x@icloud.com');

define('BASE_URL','http://127.0.0.1/test/phpmysql3/16/');

define('MYSQL','../16mysqli_connect.php');


date_default_timezone_set('US/Eastern');

function my_error_handler($e_number,$e_message,$e_file,$e_file,$e_line,$e_vars){
	$message = "<p> an error occurred in script '$e_file' on line $e_line:$e_message\n<br />";

	$message .= "Date/Time: ".date('n-j-Y H:i:s')."\n<br />";

	$message .= "<pre>" . print_r($e_vars,1)."</pre>\n</p>";

	if (!LIVE) {
	 	echo '<div id="Error">'.$message.'</div><br />';
	 } else {
	 	mail(EMAIL,'site error!',$message,'From: joey.x@qq.com');

	 	if ($e_number != E_NOTICE) {
	 		echo '<div id="Error">A system error occurred.We apologize for the inconvenience.</div><br />';
	 	}
	 }

}

set_error_handler('my_error_handler');

?>