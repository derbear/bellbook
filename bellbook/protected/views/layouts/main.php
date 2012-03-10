<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />


	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/spin.min.js"></script>
	<script type="text/javascript" src="js/browse.js"></script>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<!-- Navigation/Menus -->
<div id="header">
	<div id="content-area">
		<form id="search-form" action="<?php echo $this->createUrl("browse/search"); ?>" method="get">
			<input id="search-bar" type="text" value="<?php echo $this->pageTitle; ?>" name="BrowseForm[searchInput]"/>
			<input id="search-icon"  type="submit" value=""/>
		</form>
		<div id="menu-and-options">
			<div id="page-options">
				Sort by: <a class="selected" href="">relevance</a> <a href="">seller</a> <a href="">date</a>
			</div>
			<?php
			
			/*$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
				'id'=>'menu',
			));*/
			
			/*MODEL:
			
			<ul id="menu">
				<li><a href="">questions</a></li>
				<li id="profile">
					<a id="profile-link" href="">Vervious</a>
					<ul id="profile-nav">
						<li><a href="">My Profile</a></li>
						<li><a href="">Transaction Settings</a></li>
						<li><a href="">Sell A Book</a></li>
						<li><a href="">Log Out</a></li>
					</ul>
				</li>
				<li><a id="title-logo" href="">BellBook</a></li>
			</ul>*/
			
			echo $this->htmlMenu;
			
			?>
			
		</div>
	</div>
	<div id="border-bottom"></div>
</div>


<!-- general content area -->
<div id="content">
	
<?php echo $content; ?>

</div> <!-- end content -->

<div id="footer">
	Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
	All Rights Reserved.<br/>
</div><!-- footer -->


</body>
</html>