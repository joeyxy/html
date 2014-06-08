<?php # Script 3.5 - calculator.php

$page_title = 'Widget Cost Calculator';
include ('includes/header.html');

// Check for form submission:
if (isset($_POST['submitted'])) {

	// Minimal form validation:
	if ( is_numeric($_POST['quantity']) && is_numeric($_POST['price']) && is_numeric($_POST['tax']) ) {
	
		// Calculate the results:
		$total = ($_POST['quantity'] * $_POST['price']);
		$taxrate = ($_POST['tax'] / 100); // Turn 5% into .05.
		$total += ($total * $taxrate); // Add the tax.
		
		// Print the results:
		echo '<h1>Total Cost</h1>
	<p>The total cost of purchasing ' . $_POST['quantity'] . ' widget(s) at $' . number_format ($_POST['price'], 2) . ' each, including a tax rate of ' . $_POST['tax'] . '%, is $' . number_format ($total, 2) . '.</p>';
	
	} else { // Invalid submitted values.
		echo '<h1>Error!</h1>
		<p class="error">Please enter a valid quantity, price, and tax.</p>';
	}
	
} // End of main isset() IF.

// Leave the PHP section and create the HTML form:
?>
<h1>Widget Cost Calculator</h1>
<form action="calculator.php" method="post">
	<p>Quantity: <input type="text" name="quantity" size="5" maxlength="5" /></p>
	<p>Price: <input type="text" name="price" size="5" maxlength="10" /></p>
	<p>Tax (%): <input type="text" name="tax" size="5" maxlength="5" /></p>
	<p><input type="submit" name="submit" value="Calculate!" /></p>
	<input type="hidden" name="submitted" value="1" />
</form>
<?php // Include the footer:
include ('includes/footer.html');
?>
