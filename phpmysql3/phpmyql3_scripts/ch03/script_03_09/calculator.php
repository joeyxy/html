<?php # Script 3.9 - calculator.php #4

$page_title = 'Widget Cost Calculator';
include ('includes/header.html');

/* This function calculates a total
and then prints the results. 
The $tax argument is optional (it has a default value). */
function calculate_total ($qty, $cost, $tax = 5) {

	$total = ($qty * $cost);
	$taxrate = ($tax / 100); // Turn 5% into .05.
	$total += ($total * $taxrate); // Add the tax.

	// Print the results:
	echo '<p>The total cost of purchasing ' . $qty . ' widget(s) at $' . number_format ($cost, 2) . ' each, including a tax rate of ' . $tax . '%, is $' . number_format ($total, 2) . '.</p>';

} // End of function.

// Check for form submission:
if (isset($_POST['submitted'])) {

	// Minimal form validation:
	if ( is_numeric($_POST['quantity']) && is_numeric($_POST['price']) ) {
	
		// Print the heading:
		echo '<h1>Total Cost</h1>';

		// Call the function, with or without tax:
		if (is_numeric($_POST['tax'])) {
			calculate_total ($_POST['quantity'], $_POST['price'], $_POST['tax']);
		} else {
			calculate_total ($_POST['quantity'], $_POST['price']);
		}
					
	} else { // Invalid submitted values.
		echo '<h1>Error!</h1>
		<p class="error">Please enter a valid quantity and price.</p>';
	}
	
} // End of main isset() IF.

// Leave the PHP section and create the HTML form:
?>
<h1>Widget Cost Calculator</h1>
<form action="calculator.php" method="post">
	<p>Quantity: <input type="text" name="quantity" size="5" maxlength="5" value="<?php if (isset($_POST['quantity'])) echo $_POST['quantity']; ?>" /></p>
	<p>Price: <input type="text" name="price" size="5" maxlength="10" value="<?php if (isset($_POST['price'])) echo $_POST['price']; ?>" /></p>
	<p>Tax (%): <input type="text" name="tax" size="5" maxlength="5" value="<?php if (isset($_POST['tax'])) echo $_POST['tax']; ?>" /> (optional)</p>
	<p><input type="submit" name="submit" value="Calculate!" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>
<?php // Include the footer:
include ('includes/footer.html');
?>
