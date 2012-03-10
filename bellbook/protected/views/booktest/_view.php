<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('book_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->book_id), array('view', 'id'=>$data->book_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_id')); ?>:</b>
	<?php echo CHtml::encode($data->course_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ISBN')); ?>:</b>
	<?php echo CHtml::encode($data->ISBN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author_firstname')); ?>:</b>
	<?php echo CHtml::encode($data->author_firstname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author_lastname')); ?>:</b>
	<?php echo CHtml::encode($data->author_lastname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publisher')); ?>:</b>
	<?php echo CHtml::encode($data->publisher); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('year_published')); ?>:</b>
	<?php echo CHtml::encode($data->year_published); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('place_published')); ?>:</b>
	<?php echo CHtml::encode($data->place_published); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_data')); ?>:</b>
	<?php echo CHtml::encode($data->other_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image_url')); ?>:</b>
	<?php echo CHtml::encode($data->image_url); ?>
	<br />

	*/ ?>

</div>