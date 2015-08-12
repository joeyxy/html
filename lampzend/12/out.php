<?php
  function replace($row,$username='',$password='',$introduce=''){
  	$row = str_replace("%username%", $username, $row);
  	$row = str_replace("%password%", $password, $row);
  	$row = str_replace("%introduce%", $introduce, $row);
  	return $row;
  }
  $id = $_GET['id'];
  if (@fopen("pages/user_$id.htm", "r") == false) {
  	mysql_connect("localhost","test","test") or die("connect error");
  	mysql_select_db("testcache") or die("database error");
  	$query = mysql_query("select * from userinfo where id ='$id'");
  	if ($query) {
  		$fs = mysql_fetch_row($query);
  		$username=$fs[1];
  		$password=$fs[2];
  		$introduce=$fs[3];
  		$f_tem=fopen("template.php", "r");
  		$f_new = fopen("pages/user_$id.htm", "w");
  		while (!feof($f_tem)) {
  			$row = fgets($f_tem);
  			$row = replace($row,$username,$password,$introduce);
  			fwrite($f_new, $row);
  		}
  		fclose($f_new);
  		fclose($f_tem);
  	}
  	mysql_close();
  	echo "database result";
  }else{
  	echo "cache data";

  }
    	include("pages/user_$id.htm");

?>