<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'course_id'); ?>
		<?php echo $form->textField($model,'course_id'); ?>
		<?php echo $form->error($model,'course_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ISBN'); ?>
		<?php echo $form->textField($model,'ISBN',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'ISBN'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author_firstname'); ?>
		<?php echo $form->textField($model,'author_firstname',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'author_firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author_lastname'); ?>
		<?php echo $form->textField($model,'author_lastname',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'author_lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'publisher'); ?>
		<?php echo $form->textField($model,'publisher',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'publisher'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'year_published'); ?>
		<?php echo $form->textField($model,'year_published'); ?>
		<?php echo $form->error($model,'year_published'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'place_published'); ?>
		<?php echo $form->textField($model,'place_published',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'place_published'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other_data'); ?>
		<?php echo $form->textField($model,'other_data',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'other_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image_url'); ?>
		<?php echo $form->textArea($model,'image_url',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'image_url'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->