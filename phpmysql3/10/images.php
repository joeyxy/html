<html lang="en" >
    
    <head>
     <title>Images</title>
     <script language="JavaScript">
        function create_window(image,width,height){
        width = width + 10;
        height = height + 10;

        if(window.popup && !window.popup.closed){
            window.popup.resizeTo(width,height);
        }

        var specs = "location = no,scrollbars=no,menubars=no,toolbars=no,resizeable=yes,left=0,top=0,width="+width+",height="+height;

        var url = "show_image.php?image=" + image;
        popup = window.open(url,"ImageWindow",specs);
        popup.focus();

        }
     </script>
    </head>

    <body>
    <p>Click on a image to view it in a separate window.</p>
    <table align="center" cellspacing="5" cellpadding="5" border="1">
        <tr>
            <td align="center"><b>Image Name</b></td>
            <td align="center"><b>Image Size</b></td>
        </tr>

<?php
  $dir = '../uploads';
  $files = scandir($dir);

  foreach($files as $image){
   echo "$image";
   if(substr($images,0,1) != '.'){
    $image_size = getimagesize("$dir/$image");

    $file_size = round((filesize("$dir/$image"))/1024)."kb";

    $image = urlencode($image);

    echo "\t<tr>\t\t<td><a href=\"javascript:create_window('$image',$image_size[0]),$image_size[1])\">$image</a></td>\t\t<td>$file_size</td> \t</tr>\n";
   }
}


?>
    </table>
    </body>
</html>
