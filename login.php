<p>Log in with your BCP account: </p>
<? require_once('util.php'); 
$params = array(
	'names' => array('username' => 'text', 'password' => 'password'),
	'target' => 'dummy.php', 
	'method' => 'post.php',
	'button' => 'Log in');
makeForm($params);
?>