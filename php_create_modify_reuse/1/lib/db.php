<?php
define('db_host','localhost');
define('db_user','test');
define('db_password', 'test');
define('db_schema', 'wrox_database');
define('DB_TBL_PREFIX','wrox_');

if (!$GLOBALS['DB'] = mysql_connect(db_host,db_user,db_password)) {
	die('Error:Unable to connect to database server.');
}

if (!mysql_select_db(db_schema,$GLOBALS['DB'])) {
	mysql_close($GLOBALS[DB]);
	die('Error:unable to select database schema.');
}


?>