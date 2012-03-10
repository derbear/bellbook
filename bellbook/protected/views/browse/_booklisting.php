<?php
/** REQUIRES
 *  $data (of model Book) to display
 *		which includes $courses (array of courses) (each course is an array with three elements: 'name' and 'url' and 'required' (BOOL))
 */
?>


<div class="book-listing">
	<div class="book-pic" style="background-image: url(<?php echo CHtml::encode($data->image_url); ?>)" alt="<?php echo CHtml::encode($data->title);?>"></div>
	<div class="book-listing-bg"></div>
	<a class="book-link" href=""></a>
	<div class="book-info">
		<div class="book-info-top"></div> <!-- UI stuff -->
		<h2><?php echo CHtml::link(CHtml::encode($data->title), array('browse/book', 'bookid'=>$data->book_id)); ?></h2> <!-- book title -->
		<p class="book-author">by <?php echo CHtml::encode($data->author_firstname) .' '. CHtml::encode($data->author_lastname); ?></p>
		<p class="book-isbn">ISBN-13: <?php echo CHtml::encode($data->ISBN); ?></p>
		<p class="book-pub">Pub: <?php echo CHtml::encode($data->publisher); ?></p>
		<div class="book-courses">
		
		<?php
			/*$i = 0;
			foreach($courses as $course) { 
				if ($i > 0) echo ", "; $i++;
			?>
				<a class="<?php if($course['required']) echo 'required';?>" href="<?php echo $course['url'];?>"><?php echo $course['name'];?></a>
			<?php }
		
		*/?>
		<a class="required" href="">ELAP</a>, <a class="required" href="">ELAP Acc</a>
		</div>
		<!--<div class="book-min-price">$13.29</div>
		<div class="book-num-offers">2</div>-->
	</div>
</div> <!-- end book-listing -->
