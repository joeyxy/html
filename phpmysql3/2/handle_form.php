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

if (!empty($_REQUEST['name'])){
 $name = $_REQUEST['name'];
}else{
$name = NULL;
echo ' <p class="error"> You forgot to enter your name!</p>';

}

 if (isset($_REQUEST['gender'])){
  $gender=$_REQUEST["gender"];
 }else{
  $gender=NULL;
 }
 $name=$_REQUEST['name'];
 $email=$_REQUEST['email'];
 $comments=$_REQUEST['comments'];

 if($gender == 'M'){
  echo '<p><b>Good day,Sir!</b></p>';
 }elseif($gender == 'F'){
  echo '<p><b>Good day,Madam!</b></p>';
 }else{
  echo '<p><b>You forgot to enter your gender!</b></p>';
 }
if ($name&&$email&&gender && $comments){
echo "<p>Thank you,<b>$name</b>,for the following comments:<br />
<b>$comments</b></p>
 <p>we will reply to you at <i>$email</i>.</p>\n";
}else{
 echo '<p class="error">Please go back and fill out the<a href="form.html"> form </a>again</p>';
}
?>
</body>

</html>
