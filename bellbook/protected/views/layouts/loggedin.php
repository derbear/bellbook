<?php $this->beginContent('//layouts/main'); ?>
<div id="mainmenu">
	<?php $this->widget('zii.widgets.CMenu',array(
		'items'=>array(
			array('label'=>'Bellbook', 'url'=>array('/welcome/')),
			array('label'=>'Profile ('.Yii::app()->user->name.')', 'url'=>array('/profile/')),
			array('label'=>'Buy', 'url'=>array('/buy/')),
			array('label'=>'Sell', 'url'=>array('/sell/')),
		),
	)); ?>
</div><!-- end mainmenu -->


<div class="container">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>