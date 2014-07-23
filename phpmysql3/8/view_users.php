<?php
 $page_title ='view the current users';

 include('includes/header.html');

 echo '<h1>Registered Users</h1>' ;

 require_once('../mysqli_connect.php');

 $q = "select concat(last_name,',',first_name) AS name,DATE_FORMAT(registration_date,'%M %d,%Y') AS dr from users order by registration_date ASC" ;
 $r =@mysqli_query($dbc,$q);
  if ($r){
   $num = mysqli_num_rows($r);
   if($num > 0) echo "<p>There are currently $num registered users.</p>\n";
   echo '<table align="center" cellpadding="3" width="75%"> <tr><td align="left"><b>Name</b></td><td align="left"><b>Date Registered</b></td></tr>';

   while($row = mysqli_fetch_array($r,MYSQLI_ASSOC)){
    echo '<tr><td align="left">'.$row['name'].'</td><td align="left">'.$row['dr'].'</td></tr>';

   }
   echo '</table>';

   mysqli_free_result($r);

  }else{

   echo '<p class="error">The current users could not be retrieved.we apologize for any inconvenience.</p>';

   echo '<p>'.mysqli_error($dbc).'<br /><br />Query: '.$q.'</p>';

  }

  mysqli_close($dbc);
  include('includes/footer.html');

?>
