<hr /> 
<a href='index.php?query=home&ref=<? echo $QUERY; ?>'>Home</a> | 
<a href='index.php?query=status&ref=<? echo $QUERY; ?>'>Status</a> |
<a href='index.php?query=help&ref=<? echo $QUERY; ?>'>Help</a> |
<a href='index.php?query=login&ref=<? echo $QUERY; ?>'>Login</a> |
<a href='index.php?query=logout&ref=<? echo $QUERY; ?>'>Logout</a> |
<a href='index.php?query=about&ref=<? echo $QUERY; ?>'>About</a>
<? if(isset($_GET['message'])) echo '<div> ' . $_GET['message'] . ' </div>'; ?>
<hr />
<? // loop through titles? do we need another meta-variable? ?>