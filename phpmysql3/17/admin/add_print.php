<html xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
  <title>Add a print</title>
</head>
<body>
<?php
require_once('../../17mysqli_connect.php');

if (isset($_POST['submitted'])) {
	$errors = array();

	if (!empty($_POST['print_name'])) {
		$pn= trim($_POST['print_name']);
	}else{
		$errors[] = 'Please enter the print\'s name!';
	}

	if (is_uploaded_file($_FILES['image']['tmp_name'])) {
		$temp = '../../uploads/'.md5($_FILES['image']['name']);

		if (move_uploaded_file($_FILES['image']['tmp_name'], $temp)) {
			echo '<p>The file has been upload.</p>';
			$i = $_FILES['image']['name'];
		}else{
			$errors[] = 'The file could not be moved.';
			$temp = $_FILES['image']['tmp_name'];
		}

	}else{
		$errors[] = 'no file was uploaded';
		$temp = NULL;
	}

	$s = (!empty($_POST['size'])) ? trim($_POST['size']) : NULL;

	if (is_numeric($_POST['price'])) {
		$p = (float)$_POST['price'];
	}else{
		$errors[] = 'Please enter the print\'s price!';
	}

	$d = (!empty($_POST['description'])) ? trim($_POST['description']) : NULL;

	if (isset($_POST['artist']) && ($_POST['artist'] == 'new')) {
		$fn = (!empty($_POST['first_name'])) ? trim($_POST['first_name']) : NULL;
		$mn = (!empty($_POST['middle_name'])) ? trim($_POST['middle_name']):NULL;

		if (!empty($_POST['last_name'])) {
			$ln = trim($_POST['last_name']);

			$q = 'insert into artists(first_name,middle_name,last_name) values (?,?,?)';
			$stmt = mysqli_prepare($dbc,$q);
			mysqli_stmt_bind_param($stmt,'sss',$fn,$mn,$ln);
			mysqli_stmt_execute($stmt);

			if (mysqli_stmt_affected_rows($stmt) ==1 ) {
				echo '<p>The artist has been added.</p>';
				$a = mysqli_stmt_insert_id($stmt);
			}else{
				$errors[] = "the new artist could not be added to the databases!";
			}

			mysqli_stmt_close($stmt);
		}else{
			$errors[] = 'Please enter the artist\'s name!';
		}
	} elseif (isset($_POST['artist'])&&($_POST['artist'] == 'existing') && ($_POST['existing'] > 0)) {
		$a = (int)$_POST['existing'];
	}else{
		$errors[] = 'please enter or select the print\'s artist!';
	}

	if (empty($errors)) {
		$q = 'insert into prints (artist_id,print_name,price,size,description,image_name) values (?,?,?,?,?,?)';
		$stmt = mysqli_prepare($dbc,$q);
		mysqli_stmt_bind_param($stmt,'isdsss',$a,$pn,$p,$s,$d,$i);
		mysqli_stmt_execute($stmt);

		if (mysqli_stmt_affected_rows($stmt) == 1) {
			echo '<p>The print has been added.</p>';

			$id = mysqli_stmt_insert_id($stmt);
			rename($temp,"../../uploads/$id");

			$_POST = array();
		} else {
			echo '<p style="font-weight:bold;color:#C00>"Your submission could not be processed due to a system error.</p>';
		}
		mysqli_stmt_close($stmt);
	}

	if (isset($temp)&& file_exists($temp)&& is_file($temp)) {
		unlink($temp);
	}
}

if (!empty($errors)&& is_array($errors)) {
	echo '<h1>Error!</h1>
	<p style="font-weight:bold;color:#C00">The following errors occurred:<br />';
	foreach ($errors as $msg) {
		echo "- $msg<br />\n" ;
	}
	echo 'please reselect the print image and try again.</p>';
}
?>

<h1>Add a print</h1>
<form enctype="multipart/form-data" action="add_print.php" method="post">
	<input type="hidden" name="MAX_FILE_SIZE" value="524288" />
	<fieldset>
     <legend>Fill out the form to add a print to the catalog:</legend>
     <p><b>Print name:</b><input type="text" name="print_name" size="30" maxlength="60" value="<?php if (isset($_POST['print_name'])) 
     echo htmlspecialchars($_POST['print_name']); ?>" /></p>

     <p><b>Image:</b><input type="file" name="image" /></p>
     <div><b>Artist:</b>
     	<p><input type="radio" name="artist" value="existing" <?php if(isset($_POST['artist']) && ($_POST['artist'] == 'existing'))
     	echo 'checked="checked"';?> />Existing => <select name="existing"><option>Select one</option>
        <?php
        $q = "select artist_id,CONCAT_WS(' ',first_name,middle_name,last_name) from artists order by last_name,first_name asc";
        $r = mysqli_query($dbc,$q);
        if (mysqli_num_rows($r) > 0) {
        	while ($row = mysqli_fetch_array($r,MYSQLI_NUM)) {
        		echo "<option value=\"$row[0]\"";
        		if (isset($_POST['existing']) && ($_POST['existing'] == $row[0])) echo 'selcted="selected"';
        		echo ">$row[1]</option>\n";
        	}
        }else{
        	echo '<option>Please add a new artist.</option>';
        }
        mysqli_close($dbc);
        ?>
     </select></p>

     <p><input type="radio" name="artist" value="new" <?php if(isset($_POST['artist']) &&($_POST['artist'] == 'new')) 
     echo ' checked="checked"' ; ?> />New =>First Name:<input type="text" name="first_name" size="10" maxlength="20" value=
     "<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; ?>" />
      Middle Name:<input type="text" name="middle_name" size="10" maxlenght="20" value="<?php if(isset($_POST['middle_name']))
      echo $_POST['middle_name']; ?>" />
      Last Name:<input type="text" name="last_name" size="10" maxlength="40" value="<?php if(isset($_POST['last_name'])) echo 
      $_POST['last_name']; ?>" />
 </p>
</div>

<p><b>Price:</b><input type="text" name="price" size="10" maxlength="10" value="<?php if 
(isset($_POST['price'])) echo $_POST['price'];?>"/> <small>Do not include the dollar sign or commas.</small></p>
<p><b>Size:</b><input type="text" name="size" size="30" maxlength="60" value="<?php 
   if(isset($_POST['size'])) echo htmlspecialchars($_POST['size']); ?>" />(optional)</p>

<p><b>Description:</b><textarea name="description" cols="40" rows="5"><?php if(isset($_POST['description'])) echo $_POST['description'];?>
</textarea>(optional)</p>
	</fieldset>
	<div align="center"><input type="submit" name="submit" value="Submit" /></div>
	<input type="hidden" name="submitted" value="TRUE" />


</form>

</body>
</html>
