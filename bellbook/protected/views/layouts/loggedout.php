<?php $this->beginContent('//layouts/main'); ?>
<div id="mainmenu">
	<?php $this->widget('zii.widgets.CMenu',array(
		'items'=>array(
			array('label'=>'Bellbook', 'url'=>array('/features/')),
			array('label'=>'Register', 'url'=>array('/register/')),
			array('label'=>'Login', 'url'=>array('/login/'))
		),
	)); ?>
</div><!-- end mainmenu -->



<div class="container">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>