<?php
/** REQUIRES
 *  $data (of model Book) to display
 *		which includes $courses (array of courses) (each course is an array with three elements: 'name' and 'url' and 'required' (BOOL))
 */
 
 // note that we are manually including forms.
 Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/selection.js",CClientScript::POS_HEAD);
?>

<input class="book-selection" id="BookSelectionForm_book_id_<?php echo $data->book_id; ?>" type="radio" name="BookSelectionForm[book_id]" value="<?php echo $data->book_id; ?>"/>
<label class="book-listing" for="BookSelectionForm_book_id_<?php echo $data->book_id; ?>">
	<span class="book-pic" style="background-image: url(<?php echo CHtml::encode($data->image_url); ?>)" alt="<?php echo CHtml::encode($data->title);?>"></span>
	<span class="book-listing-bg"></span>
	<span class="book-info">
		<span class="book-info-top"></span> <!-- UI stuff -->
		<span class="book-info-num-offers"><span><?php echo $data->sellOfferCount;?></span></span>
		<h2><?php echo CHtml::link(CHtml::encode($data->title), array('browse/book', 'BookSelectionForm[book_id]'=>$data->book_id)); ?></h2> <!-- book title -->
		<p class="book-author">by <?php echo CHtml::encode($data->author_firstname) .' '. CHtml::encode($data->author_lastname); ?></p>
		<p class="book-isbn">ISBN-13: <?php echo CHtml::encode($data->ISBN); ?></p>
		<p class="book-pub">Pub: <?php echo CHtml::encode($data->publisher); ?></p>
		<span class="book-courses">
		
		<?php
			/*$i = 0;
			foreach($courses as $course) { 
				if ($i > 0) echo ", "; $i++;
			?>
				<a class="<?php if($course['required']) echo 'required';?>" href="<?php echo $course['url'];?>"><?php echo $course['name'];?></a>
			<?php }
		
		*/?>
		<a class="required" href="">ELAP</a>, <a class="required" href="">ELAP Acc</a>
		</span>
		<!--<span class="book-min-price">$13.29</span>
		<span class="book-num-offers">2</span>-->
	</span>
<!-- end book-listing -->
</label>


<?php	
/*	OLD, DEPRECATED	
$aSelectOptions = array(); 	
foreach ( $selectOptions->getData() as $bookModel ) {
	$aSelectOptions["{$bookModel->book_id}"] = "<h1>{$bookModel->title}</h1>";
}

?>

<span class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-select-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<span class="row">
		<?php echo $form->labelEx($model,'book_id'); ?>
		<?php 
		echo $form->radioButtonList($model,'book_id', $aSelectOptions); ?>
		<?php echo $form->error($model,'book_id'); ?>
	</span>

	<span class="row buttons">
		<?php echo CHtml::submitButton('Select'); ?>
	</span>

<?php $this->endWidget(); ?>

</span><!-- form -->
*/?>
