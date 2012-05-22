<? require_once('includes.php'); ?>
<?php
// set the page title
if (isset($_GET['loc'])) {
	$loc = $_GET['loc'];
} else {
	$loc = 'home';
}
if (strcmp($loc, 'index') == 0) {
	// prevent hax
	$loc = 'home';
}
$title = $loc;

// get page message
if (isset($_GET['msg'])) {
	$MSG = $_GET['msg'];
} else {
	$MSG = 0;
}

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
	} else if (xmlhttp.status==404) {
		fetchContent('home.php?msg=Page not found');
		return;
	}}
	xmlhttp.open("REQUEST", name, true);
	xmlhttp.send();
}

//TODO cause this to post data
function postContent(name, params) {
	if (window.XMLHttpRequest) {
		// IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else {
		// IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("REQUEST", name, true);

	// Send headers
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.setRequestHeader("Connection", "close");
	
	xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("pageContent").innerHTML=xmlhttp.responseText;
	} else if (xmlhttp.status==404) {
		fetchContent('home.php?msg=Page not found');
		return;
	}}
	xmlhttp.send(params);
}

// change header and content
function setContent(name, title) {
	document.title = title;
	document.getElementById("headerTitle").innerHTML=title;
//	document.getElementById("message").innerHTML="<? if ($MSG != 0) { echo $MSG; } ?>";
	fetchContent(name);
}
</script>
</head>
<body onload='fetchContent("<? echo $loc ?>.php")'>
<!--header-->
<h1 id='headerTitle'><? echo $title; ?></h1>
<? include ('header.php'); ?>
<hr />
<!--//header-->
<!--page content-->
<div id='pageContent'>
<?php
if ($noscript) {
	include($loc . '.php');
} else { ?>
	<noscript> Your browser is not using JavaScript. 
	Click <a href='index.php?noscript=true'>here</a> to use the simple version of bellbook. </noscript> 
<? } ?>
</div>
<!--//page content-->
<!--footer-->
<hr />
<div> 
	Project Bellbook (version Cascade) <br />
	Derek Leung (<a href='mailto:derek.leung12@bcp.org'>contact</a>) <br />
	Bellarmine College Preparatory, 2012
</div>
<!--//footer-->
</body>
</html>