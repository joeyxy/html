<?php
$page_title = 'view your shopping cart';
include('./includes/header.html');

if (isset($_POST['submitted'])) {
	foreach ($_POST['qty'] as $k=> $v) {
		$pid  = (int)$k;
		$qty = (int)$v;
		echo $pid;

		if ($qty == 0) {
			unset($_SESSION['cart'][$pid]);
		}elseif ($qty > 0) {
			$_SESSION['cart'][$pid]['quantity'] = $qty;
		}
	}
}

if (!empty($_SESSION['cart'])) {
	require_once('../17mysqli_connect.php');
	$q = "SELECT print_id, CONCAT_WS(' ', first_name, middle_name, last_name) AS artist, print_name FROM artists, prints WHERE artists.artist_id = prints.artist_id AND prints.print_id IN (";
	foreach ($_SESSION['cart'] as $pid => $value) {
		echo $pid;
		$q .= $pid . ',';
	}
	$q = substr($q, 0, -1) . ') ORDER BY artists.last_name ASC';
	$r = mysqli_query ($dbc, $q) ;
	echo mysqli_error($dbc);

		echo '<form action="view_cart.php" method="post">
		<table border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
		<tr>
		<td align="left" width="30%"><b>Artist</b></td>
		<td align="left" width="30%"><b>Print Name</b></td>
		<td align="right" width="10%"><b>Price</b></td>
		<td align="center" width="10%"><b>Qty</b></td>
		<td align="right" width="10%"><b>Total Price</b></td>
		</tr>';

		$total = 0;
		while ($row = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
					// Calculate the total and sub-totals.
		$subtotal = $_SESSION['cart'][$row['print_id']]['quantity'] * $_SESSION['cart'][$row['print_id']]['price'];
		$total += $subtotal;
		
		// Print the row.
		echo "\t<tr>
		<td align=\"left\">{$row['artist']}</td>
		<td align=\"left\">{$row['print_name']}</td>
		<td align=\"right\">\${$_SESSION['cart'][$row['print_id']]['price']}</td>
		<td align=\"center\"><input type=\"text\" size=\"3\" name=\"qty[{$row['print_id']}]\" value=\"{$_SESSION['cart'][$row['print_id']]['quantity']}\" /></td>
		<td align=\"right\">$" . number_format ($subtotal, 2) . "</td>
	</tr>\n";
		}

		mysqli_close($dbc); // Close the database connection.

	// Print the footer, close the table, and the form.
	echo '<tr>
		<td colspan="4" align="right"><b>Total:</b></td>
		<td align="right">$' . number_format ($total, 2) . '</td>
	</tr>
	</table>
	<div align="center"><input type="submit" name="submit" value="Update My Cart" /></div>
	<input type="hidden" name="submitted" value="TRUE" />
	</form><p align="center">Enter a quantity of 0 to remove an item.
	<br /><br /><a href="checkout.php">Checkout</a></p>';

} else {
	echo '<p>Your cart is currently empty.</p>';
}

include ('./includes/footer.html');

?>