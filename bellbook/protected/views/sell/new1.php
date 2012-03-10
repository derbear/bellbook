<?php

/**
 * New1.php - the view file for the selection/create book part of creating a sell offer
 * @author: Nano8Blazex
 *
 * Takes data:
 *
 * $createModel: The book that is being created
 * $selectModel: the book that is being selected, with attribute book_id
 * $selectOptions: dataProvider which contains the books to show for book choices
 */

//create the array version of our dataProvider for our radioButtonList
$aSelectOptions = array(); 	
foreach ( $selectOptions->getData() as $bookModel ) {
	$aSelectOptions["{$bookModel->book_id}"] = "<h1>{$bookModel->title}</h1>";
}

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-select-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($selectModel); ?>

	<div class="row">
		<?php echo $form->labelEx($selectModel,'book_id'); ?>
		<?php 
		echo $form->radioButtonList($selectModel,'book_id', $aSelectOptions); ?>
		<?php echo $form->error($selectModel,'book_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Select'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<h1>Create Book</h1>
Or Create A Book if One Doesn't Already Exist Already in our Database

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-new-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($createModel); ?>

	<div class="row">
		<?php echo $form->labelEx($createModel,'title'); ?>
		<?php echo $form->textField($createModel,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($createModel,'title'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($createModel,'author_firstname'); ?>
		<?php echo $form->textField($createModel,'author_firstname',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($createModel,'author_firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($createModel,'author_lastname'); ?>
		<?php echo $form->textField($createModel,'author_lastname',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($createModel,'author_lastname'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($createModel,'ISBN'); ?>
		<?php echo $form->textField($createModel,'ISBN',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($createModel,'ISBN'); ?>
	</div>

	Enter the ISBN 13 if possible - only enter the ISBN 10 if you can't find the 13.


	<div class="row">
		<?php echo $form->labelEx($createModel,'publisher'); ?>
		<?php echo $form->textField($createModel,'publisher',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($createModel,'publisher'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($createModel,'year_published'); ?>
		<?php echo $form->textField($createModel,'year_published'); ?>
		<?php echo $form->error($createModel,'year_published'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($createModel,'place_published'); ?>
		<?php echo $form->textField($createModel,'place_published',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($createModel,'place_published'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($createModel,'other_data'); ?>
		<?php echo $form->textField($createModel,'other_data',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($createModel,'other_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($createModel,'image_url'); ?>
		<?php echo $form->textArea($createModel,'image_url',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($createModel,'image_url'); ?>
	</div>
	
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($createModel->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
