<?php
include('../access/bellbook.includes.php');
if(isset($_GET['logout']) && $_GET['logout']) {
	session_destroy();
	header('Location: ../index.php?message=You have been logged out');
} else if(!isset($_POST['username'])) {
	header('Location: ../index.php');
} else {
	$user = $_POST['username'];
	$password = $_POST['password'];
	$success = auth($user, $password);
	if($success) {
		$info = userinfo($user);
		session_start();
		$_SESSION['id'] = getId($info);
		$_SESSION['given'] = getGiven($info);
		$_SESSION['cn'] = getCn($info);
		header('Location: ../index.php?query=status&message=Welcome, ' . $_SESSION['given']);
	} else {
		header('Location: ../index.php?query=login&message=The entered username or password is invalid');
	}
}
?>