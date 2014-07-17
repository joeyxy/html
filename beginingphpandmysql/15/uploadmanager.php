<html lang="en">
<head>
 <title>file upload test</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
 <input  type="file" name="classnotes" value="" /><br />
 <input type="submit" name="submit" value="submit notes">

</form>
</body>
</html>

<?php
 require('HTTP/Upload.php');
define ("FILEREPOSITORY","/data/html/beginingphpandmysql/15");
#define ("FILEREPOSITORY","/var/www/test/beginingphpandmysql/15");

if(is_uploaded_file($_FILES['classnotes']['tmp_name'])){
 if($_FILES['classnotes']['type'] != "text/plain"){
  echo "class notes must be uploaded in txt format.";
 }
 else{
 $name=$_POST['name'];
 $result = move_uploaded_file($_FILE['classnotes']['tmp_name'],FILEREPOSITORY.$_FILES['classnotes']['name']);
 if ($result == 1) echo "file successfully uploaded.";
 else{ 
  echo "the error msg:".$_FILES['classnotes']['error'];
   echo "there was a problem uploading the file.";
}
}
}else
{
echo "not upload file!";
}

?>
