<html lang="en">


<head>

    <title>Upload an Image</title>
    <style type="text/css" title="text/css" media="all">
        .error{
        font-weight:bold;
        color:#C00
        }
    </style>
</head>
<body>
<?php
 if(isset($_POST['submitted'])){
    if(isset($_FILES['upload']))
    {
    $allowed = array('image/pjpeg','image/PNG','image/jpeg','image/JPG','image/X-PNG','image/png','image/x-png');
    if(in_array($_FILES['upload']['type'],$allowed)){
     if(move_uploaded_file($_FILES['upload']['tmp_name'],"../uploads/{$_FILES['upload']['name']}")){
     echo '<p><em>The file has been uploaded!</em></p>';
     }
    }else{
    echo '<p class="error">Please upload a JPEG or PNG image.</p>';
    }
    }
  if($_FILES['upload']['error'] > 0){
   echo '<p class="error">The file could not be uploaded.';
  }

  if(file_exists($_FILES['upload']['tmp_name'])&&is_file($_FILES['upload']['tmp_name'])){
   unlink($_FILES['upload']['tmp_name']);
  }
 }
?>

<form enctype="multipart/form-data" action="upload_image.php" method="post">
  <input type="hidden" name="MAX_FILE_SIZE" value="524288">
  <fieldset><legend>Select a JPEG or PNG image of 512KB or smaller to be uploaded:</legend>

   <p><b>Files:</b><input type="file" name="upload" /> </p>
   
  </fieldset>
  <div align="center"><input type="submit" name="submit" value="Submit" /></div>
  <input type="hidden" name="submitted" value="TRUE" />
</form>
</body>
</html>
