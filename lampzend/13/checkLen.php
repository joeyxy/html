<?php

if ((isset($_REQUEST['test'])<6)) {
	echo "charaset must large than 6";
}else{
	echo "success";
}

?>

<form method="post" action="">
    test:<input type="text" name="test" value="" />(must len than 6) <br>
    <input type="submit" name="submit" value="test">

	</form>