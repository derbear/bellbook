<? require_once('includes.php'); ?>
<?php
// set the page title
if (isset($_GET['loc'])) {
	$loc = $_GET['loc'];
} else {
	$loc = 'home';
}

if (strcmp($loc, 'index') == 0) {
	// prevent recursion
	$loc = 'home';
}

$title = $loc;

// whether the user is using scripts
$noscript = false;
if (isset ($_GET['noscript']) && strcmp ($_GET['noscript'], 'true') == 0) {
	$noscript = true;
}
?>
<!DOCTYPE html>
<html>
<head>
<title><? echo $title; ?></title>
<script type='text/javascript'>
// dynamically display page content
function fetchContent(name) {
	if (window.XMLHttpRequest) {
		// IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else {
		// IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("pageContent").innerHTML=xmlhttp.responseText;
	}}
	xmlhttp.open("REQUEST", name, true);
	xmlhttp.send();
}
</script>
</head>
<body onload=<? echo "'fetchContent(" . '"' . $loc . '.php' . '")' . "'" ; ?>>
<!--header-->
<h1><? echo $title; ?></h1>
<? include ('header.php'); ?>
<!--//header-->
<!--page content-->
<!-- Format this better! -->
<div id='pageContent'>
<?php
if ($noscript) {
	include($loc . '.php');
} else { ?>
	<noscript>Your browser is not using JavaScript. Click <a href='index.php?noscript=true'>here</a> to use the simple version of bellbook. </noscript> <?
} ?>
</div>
<!--//page content-->
<!--footer-->
<hr />
<div> Project Bellbook (version Cascade) <br />
Derek Leung (<a href='mailto:derek.leung12@bcp.org'>contact</a>) <br />
Bellarmine College Preparatory, 2012
</div>
<!--//footer-->
</body>

<? //content($query); ?>
</html>