<html>
<head>
  <title>Predefined variables</title>
</head>

  <body>
  <?php
  $file = $_SERVER['SCRIPT_FILENAME'];
  $user = $_SERVER['HTTP_USER_AGENT'];
  $server = $_SERVER['SERVER_SOFTWARE'];
  define('TODAY','20140608');
   echo"<p>You are running the file:<br /><b>$file</b>.</p>\n";
   echo "<p>You are vewing this page using:<br /><b>$user</b></p>\n";
   echo "<p>This server is running:<br /><b>$server</b></p>\n";
   echo '<P>Today is'.TODAY.'.<br/> This server is running version <b>'.PHP_VERSION.'</b> of PHP on the <b>'.PHP_OS.'</b>operating system.</p>';
  ?>
  </body>

</html>
