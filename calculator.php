<?php
@session_start();
include("conn.php");
// var_dump($_SESSION);
if (empty($_SESSION['id'])) {
	exit();
}
$currentUID=$_SESSION['id'];

$routing=$_GET['routing'];

switch ($routing) {
	case 'setUserData':
		$result = $conn->query("UPDATE `user` SET `deposit` = {$_POST['deposit']},`position` = {$_POST['position']} WHERE `id` = {$currentUID}");
		header("location:index.php");
		break;
	case 'adddata':
		include('result.php');

		break;
	default:
		# code...
		break;
}


?>