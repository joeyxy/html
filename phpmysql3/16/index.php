<?php


require_once('includes/config.inc.php');

$page_title = 'Welcome to this Site!';

include('includes/header.html');


echo '<h1> welcome';
if (isset($_SESSION['first_name'])) {
	echo ",{$_SESSION['first_name']}";
}
echo '</h1>';

?>

<p>spam spam spam</p>

<p>spam spam spam
</p>

<?php
include('includes/footer.html');
?>