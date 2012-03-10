<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-index-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($model, $model->loginInfo)); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'student_id'); ?>
		<?php echo $form->textField($model,'student_id'); ?>
		<?php echo $form->error($model,'student_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name'); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name'); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'grad_yr'); ?>
		<?php echo $form->textField($model,'grad_yr'); ?>
		<?php echo $form->error($model,'grad_yr'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model->loginInfo,'password'); ?>
		<?php echo $form->passwordField($model->loginInfo,'password'); ?>
		<?php echo $form->error($model->loginInfo,'password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Register'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<p>If you feel any of these errors are erroneous, please contact us and we will fix them.</p>