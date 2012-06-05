<hr /> 
<a href='index.php?query=home&amp;ref=<? echo $QUERY; ?>'>Home</a> | 
<a href='index.php?query=books&amp;ref=<? echo $QUERY; ?>'>Browse</a> |
<a href='index.php?query=status&amp;ref=<? echo $QUERY; ?>'>Status</a> |
<a href='index.php?query=add&amp;ref=<? echo $QUERY; ?>'>Bid/Offer</a> |
<a href='index.php?query=help&amp;ref=<? echo $QUERY; ?>'>Help</a> |
<a href='index.php?query=login&amp;ref=<? echo $QUERY; ?>'>Login</a> |
<a href='index.php?query=logout&amp;ref=<? echo $QUERY; ?>'>Logout</a> |
<a href='index.php?query=about&amp;ref=<? echo $QUERY; ?>'>About</a>
<? if(isset($_GET['message'])) echo '<div> ' . $_GET['message'] . ' </div>'; ?>
<hr />
<? // loop through titles? do we need another meta-variable? ?>