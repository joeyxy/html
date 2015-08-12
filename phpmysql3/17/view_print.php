<?php
$row = FALSE;

if (isset($_GET['pid']) && is_numeric($_GET['pid'])) {
	$pid  = (int)$_GET['pid'];

	require_once('../17mysqli_connect.php');

	$q = "select CONCAT_WS(' ',first_name,middle_name,last_name) AS artist,print_name,price,description,size,image_name from artists,prints where artists.artist_id = prints.artist_id and prints.print_id = $pid";
	$r = mysqli_query($dbc,$q);

	if (mysqli_num_rows($r) == 1) {
		$row = mysqli_fetch_array($r,MYSQLI_ASSOC);

		$page_title = $row['print_name'];
		include('includes/header.html');

		echo "<div align=\"center\">
		<b>{$row['print_name']}</b> by
		{$row['artist']}<br />";

		echo (is_null($row['size'])) ? '(no size information available)' : $row['size'];

		echo "<br />\${$row['price']}
		<a href=\"add_cart.php?pid=$pid\">Add to Cart</a>
		</div><br />";

		if ($image = @getimagesize("../uploads/$pid")) {
			echo "<div align=\"center\"><img src=\"show_image.php?image=$pid&name=".urlencode($row['image_name'])."\"$image[3]
			alt=\"{$row['print_name']}\" /></div>\n";
		} else{
			echo "<div align=\"center\">No image available.</div>\n";
		}

		echo '<p align="center">'.((is_null($row['description'])) ? '(No description available)' : $row['description']).'</p>';
	}
	mysqli_close($dbc);
}

if (!$row) {
	$page_title = 'Error';
	include('includes/header.html');
	echo '<div align="center">This page has been accessed in error!</div>';
}

include('includes/footer.html');

?>