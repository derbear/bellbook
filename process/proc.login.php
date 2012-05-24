<?php
include('../access/bellbook.includes.php');
if(!isset($_POST['username'])) {
	header('Location: ../index.php');
	die();
}
$user = $_POST['username'];
$password = $_POST['password'];
$success = auth($user, $password);
if($success) {
	$info = userinfo($user);
	$_SESSION['id'] = getId($info);
	$_SESSION['given'] = getGiven($info);
	$_SESSION['cn'] = getCn($info);
	header('Location: ../index.php?query=status&message=Welcome, ' . $_SESSION['given']);
} else {
	header('Location: ../index.php?query=login&message=The entered username or password is invalid');
}
?>