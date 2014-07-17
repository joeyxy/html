<html lang="en">
<head>
 <title>Display errors</title>
 
</head>

<body>
 <h2>Testing Display errors</h2>

<?php

define('LIVE',TRUE);

function my_error_handler($e_number,$e_message,$e_file,$e_line,$e_vars){

 $message = "an error occurred in script '$e_file' on line $e_line:$e_message\n";
 
  $message .=print_r($e_vars,1);
  if(!LIVE){
   echo '<pre>'.$message."\n";
   debug_print_backtrace();
   echo '</pre><br />';
  }else{
   echo '<div class="error">A system error occured.We apologize for the inconvenience.</div><br />';
  }

}


set_error_handler('my_error_handler');

foreach($var as $v){}
$result = 1/0;

?>

</body>

</html>
