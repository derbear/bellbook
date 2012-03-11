<?php 

/**
 * New2.php - the view file for the creation of the sell offer
 * @author: Nano8Blazex
 *
 * Takes data:
 *
 * $model: the sell offer being created
 */
 
?>
 
Build Ya Sell Offer!!!

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sell-offer-new2-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'book_id'); ?>
		<?php echo $form->textField($model,'book_id'); ?>
		<?php echo $form->error($model,'book_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bargainable'); ?>
		<p class="">Do you mind others being able to haggle the price?</p>
		<?php echo $form->textField($model,'bargainable'); ?>
		<?php echo $form->error($model,'bargainable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pickup'); ?>
		<?php echo $form->textField($model,'pickup'); ?>
		<?php echo $form->error($model,'pickup'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description'); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image_url'); ?>
		<?php echo $form->textField($model,'image_url'); ?>
		<?php echo $form->error($model,'image_url'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Post your book to the greater world!'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

