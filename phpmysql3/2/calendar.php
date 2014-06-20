<html lang="en">

<head>
 <title>Calendar </title>

</head>
<body>
<form action="calendar.php" method="post">
<?php

$months = array(1=>'January','February','March','April','May','June','August','September','October','December');


$days = range(1,31);
$years = range(2008,2018);

echo '<select name="month">';
foreach ($months as $key => $value){
  echo "<option value=\"$key\">$value </option>\n";
}
echo '</select>';
echo '<select name="day">';
foreach ($days as $key => $value){
  echo "<option value=\"$key\">$value </option>\n";
}
echo '</select>';
echo '<select name="year">';
foreach ($years as $key => $value){
  echo "<option value=\"$key\">$value </option>\n";
}
echo '</select>';
?>
</form>
</body>
</html>
