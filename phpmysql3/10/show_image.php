<?php

$name = FALSE;

if(isset($_GET['image'])){
  $image = "../uploads/{$_GET['image']}";

   if(file_exists($image)&&(is_file($image))){
   $ext = strtolower(substr($_GET['image'],-4));
   
   if(($ext == '.jpg') OR ($ext == 'jpeg') OR ($ext == '.png')){
     $name = $_GET['image'];
}
  }
}

   if(!$name){
   $image = 'images/unavailale.png';
   $name = 'unavailable.png';

 }

  $info = getimagesize($image);
  $fs = filesize($image);

  header("Content-Type:{$info['mime']}\n");
  header("Content-Disposition:inline;filename=\"$name\"\n");
  header("Content-Length:$fs\n");


  readfile($image);



?>


