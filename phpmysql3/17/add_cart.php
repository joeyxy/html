<?php

$page_title = 'Add to Cart';
include('includes/header.html');

if (isset($_GET['pid']) && is_numeric($_GET['pid'])) {
	$pid = (int)$_GET['pid'];

	if (isset($_SESSION['cart'][$pid])) {
		$_SESSION['cart'][$pid]['quantity']++;

		echo '<p>Another copy of the print has been added to your shopping cart.</p>';
	}else{
		require_once('../17mysqli_connect.php');
		$q = "select price from prints where prints.print_id = $pid";
		$r = mysqli_query($dbc,$q);

		if (mysqli_num_rows($r)==1) {
			list($price) = mysqli_fetch_array($r,MYSQLI_NUM);

			$_SESSION['cart'][$pid] = array('quantity' => 1,'price' => $price);

			echo '<p>The print has been added to your shopping cart.</p>';
		}else{
			echo '<div align="center">This page has been accessed in error!</div>';
		}

		mysqli_close($dbc);
	}
}else{
	echo '<div align="center">This page has been accessed in error!</div>';
}

include('includes/footer.html');

?>