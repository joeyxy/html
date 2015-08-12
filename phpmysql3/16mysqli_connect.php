<?php

  define('db_user', 'test');
  define('db_password', 'test');
  define('db_host', 'localhost');
  define('db_name','ch16');


  $dbc = @mysqli_connect(db_host,db_user,db_password,db_name);

  if(!$dbc){
  	trigger_error('could not connect to MySQL: '.mysqli_connect_error());
  }

?>