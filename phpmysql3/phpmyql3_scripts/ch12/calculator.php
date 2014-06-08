<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>Widget Cost Calculator</title>
</head>
<body>
<?php # Script 12.2 - calculator.php

// Check if the form has been submitted.:
if (isset($_POST['submitted'])) {

	// Cast all the variables to a specific type:
	$quantity = (int) $_POST['quantity'];
	$price = (float) $_POST['price'];
	$tax = (float) $_POST['tax'];

	// All variables should be positive!
	if ( ($quantity > 0) && ($price > 0) && ($tax > 0) ) {
	
		// Calculate the total:
		$total = ($quantity * $price) * (($tax/100) + 1);
		
		// Print the result:
		echo '<p>The total cost of purchasing ' . $quantity . ' widget(s) at $' . number_format ($price, 2) . ' each, plus tax, is $' . number_format ($total, 2) . '.</p>';
				
	} else { // Invalid submitted values.
		echo '<p style="font-weight: bold; color: #C00">Please enter a valid quantity, price, and tax rate.</p>';
	}
	
} // End of main isset() IF.

// Leave the PHP section and create the HTML form.
?>
<h2>Widget Cost Calculator</h2>
<form action="calculator.php" method="post">
	<p>Quantity: <input type="text" name="quantity" size="5" maxlength="10" value="<?php if (isset($quantity)) echo $quantity; ?>" /></p>
	<p>Price: <input type="text" name="price" size="5" maxlength="10" value="<?php if (isset($price)) echo $price; ?>" /></p>
	<p>Tax (%): <input type="text" name="tax" size="5" maxlength="10" value="<?php if (isset($tax)) echo $tax; ?>" /></p>
	<p><input type="submit" name="submit" value="Calculate!" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>
</body>
</html>
