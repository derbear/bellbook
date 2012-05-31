<?php
include('../access/bellbook.includes.php');
sanitize();
connect();
if(isset($_GET['logout']) && $_GET['logout']) {
	session_start();
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
		$id = $_SESSION['id'];
		
		$query = "SELECT * FROM Users WHERE id=$id";
		$resource=mysql_query($query);
		if(!$resource) {
			session_destroy();
			header('Location: ../index.php?query=login&message=There was a database error; please try again');
		} else {
			$row=mysql_fetch_row($resource);
			if($row) { // user is in table already
				header('Location: ../index.php?query=status&message=Welcome, ' . $_SESSION['given']);
			} else { // attempt to put user ID into table
				$query = "INSERT INTO Users VALUES ($id)";
				if(mysql_query($query)) {
					header('Location: ../index.php?query=status&message=Welcome, ' . $_SESSION['given']);
				} else {
					session_destroy();
					header('Location: ../index.php?query=login&message=There was a database error; please try again');
				}
			}
		}
	} else {
		header('Location: ../index.php?query=login&message=The entered username or password is invalid');
	}
}
?>