<html lang="en">
<head>
 <title>Display errors</title>
 
</head>

<body>
 <h2>Testing Display errors</h2>

<?php

ini_set('display_errors',0);

foreach($var as $v){}
$result = 1/0;

?>

</body>

</html>
