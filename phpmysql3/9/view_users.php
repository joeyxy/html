<?php
 $page_title = 'View the current users';
 include('includes/header.html');
 echo '<h1>Registered Users</h1>';

 require_once('../mysqli_connect.php');

 $display = 6;

 if(isset($_GET['p']) && is_numeric($_GET['p'])){
  $pages = $_GET['p'];
 }else {
  $q = "select count(user_id) from users";
  $r = @mysqli_query($dbc,$q);
  $row = @mysqli_fetch_array($r,MYSQLI_NUM);
  $records = $row[0];
  if ($records > $display ){
   $pages = ceil($records/$display);
  }else{
  $pages = 1;
  }
 }

if(isset($_GET['s'])&& is_numeric($_GET['s'])){
 $start = $_GET['s'];
}else{
 $start = 0;
}

$q = "select last_name,first_name,DATE_FORMAT(registration_date,'%M %d,%Y') as dr,user_id from users order by registration_date asc limit $start,$display" ;
$r = @mysqli_query($dbc,$q);

echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
  <tr>
   <td align="left"><b>Edit</b></td>
   <td align="left"><b>Delete</b></td>
   <td align="left"><b>Last Name</b></td>
   <td align="left"><b>First Name</b></td>
   <td align="left"><b>Date Registered</b></td>
  </tr>
';

 $bg = '#eeeeee';

 while ($row = mysqli_fetch_array($r,MYSQLI_ASSOC)){
    $bg = ($bg == '#eeeeee'? '#ffffff':'#eeeeee');

    echo '<tr bgcolor="'.$bg.'">
    <td align="left"><a href="edit_user.php?id='.$row['user_id'].'">Edit</a> </td>
    <td align="left"><a href="delete_user.php?id='.$row['user_id'].'">Delete</a></td>
    <td align="left">'.$row['last_name'].'</td>
    <td align="left">'.$row['first_name'].'</td>
    <td align="left">'.$row['dr'].'</td>
    </tr>
    ';

 }
echo '</table>';
mysqli_free_result($r);
mysqli_close($dbc);

if ($pages > 1){
 echo '<br /><p>';
 $current_page =($start/$display) + 1;

 if ($current_page != 1){
 echo '<a href="view_users.php?s='.($start - $display).'&p=' .$pages. '">Previous</a>';
 }

 for ($i =1 ; $i <= $pages; $i++){
  if($i != $current_page){
    echo '<a href="view_users.php?s='.(($display*($i - 1))).'&p=' .$pages. '">'.' ' . $i .' '. '</a>';
  }else{
   echo $i . '';
  }
 }

 if ($current_page != $pages){
   echo '<a href="view_users.php?s='.($start+$display).'&p=' .$pages. '">Next</a>';
 }
 echo '</p>';

}
include ('includes/footer.html');
?>
