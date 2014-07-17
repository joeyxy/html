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
define ("FILEREPOSITORY","/var/www/test/beginingphpandmysql/15");

$upload = new HTTP_Upload();
$file = $upload->getFiles('classnotes');
$props = $file->getProp();
print_r($props);
if($file->isValid()){
 $file->moveTo('/data/html/beginingphpandmysql/15');
 echo "File successfully uploaded!";
}
else{
 echo $file->errorMsg();
}
?>
