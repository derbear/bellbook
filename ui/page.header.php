<? $info = pageinfo($QUERY); ?>
<head> 
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
	<title> <? echo $info['name']; ?> </title>
</head>
<body>
<!--header-->
<h1> <? echo $info['title']; ?> </h1> <br />
<? if(isLoggedIn()) echo '<div> You are logged in as <b>' . $_SESSION['cn'] . '</b></div>'; ?>
<? include('page.navbar.php'); ?>
Quick search is here:
<? include('page.qsearch.php'); ?>
<br /> Header end <hr />
<!--//header-->
<!--page content-->
