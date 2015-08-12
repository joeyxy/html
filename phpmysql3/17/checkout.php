<?php
$page_title = 'Order confirmation';
include 'includes/header.html';

$customer = 1;
$total = 178;

require_once '../17mysqli_connect.php';

mysqli_autocommit($dbc, FALSE);

$q = "insert into orders (customer_id,total) values ($customer,$total)";
$r = mysqli_query($dbc, $q);

if (mysqli_affected_rows($dbc) ==1) {
	$oid = mysqli_insert_id($dbc);
	
	$q = "insert into order_contents(order_id,print_id,quantity,price) values (?,?,?,?)";
	$stmt = mysqli_prepare($dbc, $q);
	mysqli_stmt_bind_param($stmt,'iiid', $oid,$pid,$qty,$price);
	
	$affected = 0;
	foreach ($_SESSION['cart'] as $pid => $item){
		$qty = $item['quantity'];
		$price = $item['price'];
		mysqli_stmt_execute($stmt);
		$affected += mysqli_stmt_affected_rows($stmt);
	}
	//echo mysqli_errno($dbc);
	
	mysqli_stmt_close($stmt);
	
	if ($affected == count($_SESSION['cart'])) {
		mysqli_commit($dbc);
		
		echo '<p>Thank you for your order.You will be notified when the items ship.</p>';
	}else {
		
		mysqli_rollback($dbc);
		echo '<p>Your order could not be processed due to a system error.You will be contacted in order to have the problem fixed.</p>';
	}
}else {
	mysqli_rollback($dbc);
	echo '<p>Your order could not be processed due to a system error.</p>';
}

mysqli_close($dbc);

include './includes/footer.html';
?>