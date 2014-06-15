<html lang="en">
<head>
 <title>Form Feedback</title>
 <style type="text/css" title="text/css" media="all">
    .error{
        font-weight:bold;
        color:#C00
        }
 </style>
</head>
<body>
 <?php

 if (isset($_REQUEST['gender'])){
  $gender=$_REQUEST["gender"];
 }else{
  $gender=NULL;
 }
 $name=$_REQUEST['name'];
 $email=$_REQUEST['email'];
 $comments=$_REQUEST['comments'];

 echo "<p>Thank you,<b>$name</b>,for the following comments:<br />
 <b>$comments</b></p>
  <p>we will reply to you at <i>$email</i>.</p>\n";
 if($gender == 'M'){
  echo '<p><b>Good day,Sir!</b></p>';
 }elseif($gender == 'F'){
  echo '<p><b>Good day,Madam!</b></p>';
 }else{
  echo '<p><b>You forgot to enter your gender!</b></p>';
 }

?>
</body>

</html>
