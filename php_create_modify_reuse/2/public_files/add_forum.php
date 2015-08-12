<?php

include '../lib/common.php';
include '../lib/db.php';
include '../lib/functions.php';
include '../lib/User.php';

include '401.php';

$user = User::getById($_SESSION['userid']);
if (~$user->permission & User::CREATE_FORUM)
{
	die('<p>Sorry,you do not have sufficient privileges to create new forums.</p>');
}

$forum_name = (isset($_POST['forum_name']))?trim($_POST['forum_name']): '';
$forum_desc = (isset($_POST['forum_desc']))?trim($_POST['forum_desc']): '';

if (isset($_POST['submitted'])) {
	# code...
}

?>