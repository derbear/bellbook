<hr /> 
<a href='index.php?query=home'>Home</a> | 
<a href='index.php?query=status'>Status</a> |
<a href='index.php?query=help'>Help</a> |
<a href='index.php?query=login'>Login</a> |
<a href='index.php?query=about'>About</a>
<? if(isset($_GET['message'])) echo '<div> ' . $_GET['message'] . ' </div>'; ?>
<hr />
<? // loop through titles? do we need another meta-variable? ?>