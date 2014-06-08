<?php # Script 15.5 - read.php
// This page shows the messages in a thread.
include ('includes/header.html');

// Check for a thread ID...
$tid = FALSE;
if (isset($_GET['tid']) && is_numeric($_GET['tid'])) {

	$tid = (int) $_GET['tid'];

	if ($tid > 0) { // Check against the database...
	
		// Convert the date if the user is logged in:
		if (isset($_SESSION['user_tz'])) {
			$posted = "CONVERT_TZ(p.posted_on, 'UTC', '{$_SESSION['user_tz']}')";
		} else {
			$posted = 'p.posted_on';
		}

		// Run the query:
		$q = "SELECT t.subject, p.message, username, DATE_FORMAT($posted, '%e-%b-%y %l:%i %p') AS posted FROM threads AS t LEFT JOIN posts AS p USING (thread_id) INNER JOIN users AS u ON p.user_id = u.user_id WHERE t.thread_id = $tid ORDER BY p.posted_on ASC";
		$r = mysqli_query($dbc, $q);
		if (!(mysqli_num_rows($r) > 0)) {
			$tid = FALSE; // Invalid thread ID!
		}
		
	} // End of ($tid > 0) IF.
	
} // End of isset($_GET['tid']) IF.

if ($tid) { // Get the messages in this thread...
	
	$printed = FALSE; // Flag variable.
	
	// Fetch each:
	while ($messages = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	
		// Only need to print the subject once!
		if (!$printed) {
			echo "<h2>{$messages['subject']}</h2>\n";
			$printed = TRUE;
		}
		
		// Print the message:
		echo "<p>{$messages['username']} ({$messages['posted']})<br />{$messages['message']}</p><br />\n";
	
	} // End of WHILE loop.
		
	// Show the form to post a message:
	include ('post_form.php');
	
} else { // Invalid thread ID!
	echo '<p>This page has been accessed in error.</p>';
}

include ('includes/footer.html');
?>
