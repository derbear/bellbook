<?php 

/**
 * New2.php - the view file for the creation of the sell offer
 * @author: Nano8Blazex
 *
 * Takes data:
 *
 * $sellOffer: the sell offer being created
 */
 
?>
 
Build Ya Sell Offer!!!

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sell-offer-new2-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($sellOffer); ?>

	<div class="row">
		<?php echo $form->labelEx($sellOffer,'book_id'); ?>
		<?php echo $form->textField($sellOffer,'book_id'); ?>
		<?php echo $form->error($sellOffer,'book_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($sellOffer,'bargainable'); ?>
		<p class="">Do you mind others being able to haggle the price?</p>
		<?php echo $form->textField($sellOffer,'bargainable'); ?>
		<?php echo $form->error($sellOffer,'bargainable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($sellOffer,'price'); ?>
		<?php echo $form->textField($sellOffer,'price'); ?>
		<?php echo $form->error($sellOffer,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($sellOffer,'pickup'); ?>
		<?php echo $form->textField($sellOffer,'pickup'); ?>
		<?php echo $form->error($sellOffer,'pickup'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($sellOffer,'description'); ?>
		<?php echo $form->textField($sellOffer,'description'); ?>
		<?php echo $form->error($sellOffer,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($sellOffer,'image_url'); ?>
		<?php echo $form->textField($sellOffer,'image_url'); ?>
		<?php echo $form->error($sellOffer,'image_url'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Post your book to the greater world!'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

