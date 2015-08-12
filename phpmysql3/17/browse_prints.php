<?php
	
	$page_title="Browse the Prints";
	include('includes/header.html');

	require_once('../17mysqli_connect.php');

	$q = "select artists.artist_id,CONCAT_WS(' ',first_name,middle_name,last_name) as artist,print_name,price,description,print_id from 
	artists,prints where artists.artist_id = prints.artist_id order by artists.last_name ASC,print_name ASC";

	if (isset($_GET['aid']) && is_numeric($_GET['aid'])) {
		$aid = (int)$_GET['aid'];
		if ($aid > 0) {
			$q = "select artists.artist_id,CONCAT_WS(' ',first_name,middle_name,middle_name,last_name) as artist,print_name,price,description
			,print_id from artists,prints where artists.artist_id = prints.artist_id and prints.artist_id = $aid order by prints.print_name";

		}
	}

echo '<table border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
	<tr>
	<td align="left" width="20%"><b>Artist</b></td>
	<td align="left" width="20%"><b>Print name</b></td>
	<td align="left" width="40%"><b>Description</b></td>
	<td align="right" width="20%"><b>Price</b></td>
	</tr>
';

$r  = mysqli_query($dbc,$q);
while ($row = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
	echo "\t<tr>
	<td align=\"left\"><a href=\"browse_prints.php?aid={$row['artist_id']}\">{$row['artist']}</a></td>
	<td align=\"left\"><a href=\"view_print.php?pid={$row['print_id']}\">{$row['print_name']}</a></td>
	<td align=\"left\">{$row['description']}</td>
	<td align=\"right\">{$row['price']}</td>
	</tr>\n
	";
}

echo '</table>';
mysqli_close($dbc);
include('includes/footer.html');
?>