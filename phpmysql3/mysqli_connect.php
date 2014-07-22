<?php

DEFINE('DB_USER','test');
DEFINE('DB_PASSWORD','test');
DEFINE('DB_HOST','localhost');

DEFINE('DB_NAME','sitename');

#$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) ;
$dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('could not connect to mysql:'.mysqli_connect_error());


?>
