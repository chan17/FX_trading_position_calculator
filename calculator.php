<?php
@session_start();
include("conn.php");
// var_dump($_SESSION);
if (empty($_SESSION['id'])) {
	exit();
}
$routing=$_GET['routing'];

switch ($routing) {
	case 'setUserData':
		$result = $conn->query("UPDATE `user` SET `deposit` = {$_POST['deposit']},`position` = {$_POST['position']} WHERE `id` = {$_SESSION['id']}");
		break;
	case 'cc':
		break;
	
	default:
		# code...
		break;
}

$conn->close();
header("location:index.php");
?>