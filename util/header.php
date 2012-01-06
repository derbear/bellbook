<? require_once("connect.php");
connect(false);
sanitize() ?>
<?
$pagetitle = ''; //temporary solution, all involved code is next to title attributes in the five main pages

function print_header($custom_msg=null) { global $pagetitle;?>
	

<!--login info, header, top bar-->
<!-- jquery -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="includes/extras.js"></script>
<div id="my-info">
	<div id="logo-container"><p><a href="index.php">bellbook</a></p></div>
	<form action='search.php' method='get' name='Search' id='search'>
		<input type='text' name="query" id='search-box'> <input type='submit' id='submit' value='Search Books' >
	</form>
	<ul id="login-info">
	<?php
        if(isset($_SESSION['id'])) {
			echo '<li class="first">You are logged in as <b>' . $_SESSION['firstname'] . ' '
            . $_SESSION['lastname'] . '</b></li>';
    ?>
			<li><a href="myAccount.php">My account</a></li>
	        <li><a href="myBooks.php">My books</a></li>
	        <li><a href="trackedBooks.php">Tracked books</a></li>
	        <li class="last"><a href="util/logout.php">Log out</a><br /></li>
	<?php
		} else {
	?>		<li class="first">You are not logged in</li>
			<li><a href="login.php">Log in</a></li> 
			<li class="last"><a href="register.php"> Get an account</a></li>
	<?php	
		}
	?>
	</ul>
	<div class="clear"></div> 
</div>
<!--//login info-->



<!--header, beginning of content-->
<div id="content">
	<!--<div id="title"> <h1> bellbook </h1> </div>-->
	<div id="content-container"> <!-- content container -->
	<div id="navigation-container">
	<ul id="navigation">
		<li <?php if($pagetitle==='bellbook') echo 'id="selected"'?>class="top"><a href='index.php'>bellbook</a></li>
		<li <?php if($pagetitle==='About bellbook') echo 'id="selected"'?>><a href='about.php'>About bellbook</a></li>
		<li <?php if($pagetitle==='Browse books') echo 'id="selected"'?>><a href='browse.php'>Browse books</a></li>
		<li <?php if($pagetitle==='Book offers') echo 'id="selected"'?>><a href='offers.php'>Browse offers</a></li>
		<li <?php if($pagetitle==='Browse courses') echo 'id="selected"'?>><a href='courses.php'>Browse courses</a></li>
	 	<? if (isset($_SESSION['id'])) { ?>
	 		<li <?php if($pagetitle==='Sell a book') echo 'id="selected"'?>><a href='sellBook.php'>Sell a book</a></li>
	 	<? } ?>	
		<li <?php if($pagetitle==='bellbook Help') echo 'id="selected"'?>class="bottom"><a href='help.php'>Help</a></li>
	</ul>
	</div>
	
	<!--begin page content-->
	<div id="real-content">

<? if (isset($_GET['message'])) {
    $msg=filter_var($_GET['message'], FILTER_SANITIZE_STRING);
    echo '<div class="msg">' . $msg . '</div>';
    // in the next file, please close <real-content>, <content-container> and <content> respectively
}
?>
<!--//header-->
<!--page content-->
<? } 