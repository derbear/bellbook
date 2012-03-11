<?php

/* 
 *
 * Ben Chan
 * REQUIRES
 * model (LoginForm)
 */


?>

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
		<?php echo $form->labelEx($model->loginInfo,'password'); ?>
		<?php echo $form->passwordField($model->loginInfo,'password'); ?>
		<?php echo $form->error($model->loginInfo,'password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<p class="todo">ultimately we would want this in the sidebar</p>
<p class="note">redirects to welcome page!</p>