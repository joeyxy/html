<?php # Script 3.7 - dateform.php

$page_title = 'Calendar Form';
include ('includes/header.html');

// This function makes three pull-down menus
// for selecting a month, day, and year.
function make_calendar_pulldowns() {

	// Make the months array:
	$months = array (1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	
	// Make the months pull-down menu:
	echo '<select name="month">';
	foreach ($months as $key => $value) {
		echo "<option value=\"$key\">$value</option>\n";
	}
	echo '</select>';
	
	// Make the days pull-down menu:
	echo '<select name="day">';
	for ($day = 1; $day <= 31; $day++) {
		echo "<option value=\"$day\">$day</option>\n";
	}
	echo '</select>';
	
	// Make the years pull-down menu:
	echo '<select name="year">';
	for ($year = 2008; $year <= 2018; $year++) {
		echo "<option value=\"$year\">$year</option>\n";
	}
	echo '</select>';

} // End of the function definition.

// Create the form tags:
echo '<h1>Select a Date:</h1>
<form action="dateform.php" method="post">';

// Call the function.
make_calendar_pulldowns();

echo '</form>';

include ('includes/footer.html');
?>
