<html lang="en">
<head>

<title> Multidimensional Arrays </title>
</head>
<body>
<p>Some North American states.Provinces,and territories:</p>
<?php

$mexico = array(
 'yu' => 'yucatan',
 'bc' => 'Baja California',
 'oa' => 'Oaxaca'
);

$us = array(
 'md' => 'Maryland',
 'il' => 'Illinois',
 'pa' => 'Pennsylvania'
);

$n_america = array(
  'Mexico' => $mexico,
  'United States' => $us,
);

asort($n_america);
foreach ($n_america as $country => $list){
  echo "<h2>$country</h2><ul>";
  krsort($list);
  foreach($list as $k => $v){
      echo "<li>$k - $v</li>\n";
  }

  echo '</ul>';
}

?>
</body>

</html>
