<?php

/**
 * New1.php - the view file for the selection/create book part of creating a sell offer
 * @author: Nano8Blazex
 *
 * Takes data:
 *
 * $newBookModel: The book that is maybe being created (Book)
 * $model: the book that is being selected (BookSelectionForm)
 */


//TODO: Integrate with Browse
//create the array version of our dataProvider for our radioButtonList
$selectOptions = new CActiveDataProvider( 'Book' , array (
	'pagination' => array( 'pageSize' => 20, ),
	'criteria' => array( 
		//'condition' => 'status=1', // where clause in sql statement
		'order' => 'title DESC',
	),
));

?>

<h1>Step 1: Choose A Book To Sell</h1>
<div class="form" id="book-selection">
<div id="book-selection-list">

<?php
/* BEGIN THE CHOOSE BOOK SECTION */ 

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-select-form',
	'enableAjaxValidation'=>false,
)); 

$listWidget = $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$selectOptions,
	'itemView'=>'_selectoptionlisting',
	'sortableAttributes'=>array(
		'title',
		'author_lastname',
		'sellOfferCount',
),
	'template' => <<<VEV
	
	{pager}
	{items}
	<div style="clear:both"></div> 
	
VEV
,
	'itemsTagName' => 'div', // the enclosing box of the whoe thing
	'itemsCssClass' => 'search-results',
	'id' => 'search-results',
	'sorterCssClass' => 'page-options',
	// note pagination is set in the CActiveDataProvider
)); 

/* now grab the sorter to display in the menu bar for use in main.php */
ob_start();
$listWidget->renderSorter();
$this->htmlOptions = ob_get_contents();
ob_end_clean();



?>
</div><!-- end selection list -->

<div id="book-selection-info">
	<!-- selected book -->
	<?php $this->renderPartial('_selectedlisting', array($data=>null)); //updated by selection.js?>
	<!-- create book -->
	<?php $this->renderPartial('_createbook', array($data=>null)); //s?>
</div>

<span class="row buttons">
	<?php echo CHtml::submitButton('NExt Step'); ?>
</span>
<?php $this->endWidget(); ?>

</div><!-- end form -->

<h1>Create Book</h1>
Or Create A Book if One Doesn't Already Exist Already in our Database

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-new-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($newBookModel); ?>

	<div class="row">
		<?php echo $form->labelEx($newBookModel,'title'); ?>
		<?php echo $form->textField($newBookModel,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($newBookModel,'title'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($newBookModel,'author_firstname'); ?>
		<?php echo $form->textField($newBookModel,'author_firstname',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($newBookModel,'author_firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($newBookModel,'author_lastname'); ?>
		<?php echo $form->textField($newBookModel,'author_lastname',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($newBookModel,'author_lastname'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($newBookModel,'ISBN'); ?>
		<?php echo $form->textField($newBookModel,'ISBN',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($newBookModel,'ISBN'); ?>
	</div>

	Enter the ISBN 13 if possible - only enter the ISBN 10 if you can't find the 13.


	<div class="row">
		<?php echo $form->labelEx($newBookModel,'publisher'); ?>
		<?php echo $form->textField($newBookModel,'publisher',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($newBookModel,'publisher'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($newBookModel,'year_published'); ?>
		<?php echo $form->textField($newBookModel,'year_published'); ?>
		<?php echo $form->error($newBookModel,'year_published'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($newBookModel,'place_published'); ?>
		<?php echo $form->textField($newBookModel,'place_published',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($newBookModel,'place_published'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($newBookModel,'other_data'); ?>
		<?php echo $form->textField($newBookModel,'other_data',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($newBookModel,'other_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($newBookModel,'image_url'); ?>
		<?php echo $form->textArea($newBookModel,'image_url',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($newBookModel,'image_url'); ?>
	</div>
	
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($newBookModel->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
