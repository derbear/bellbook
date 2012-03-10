<?php
/** REQUIRES
 *  $imageUrl (string of direct url to image)
 *	$title 
 * 	$author
 *	$isbn13
 *	$publisher (information including publisher and date)
 *	$courses (array of courses) (each course is an array with three elements: 'name' and 'url' and 'required' (BOOL))
 */
?>


<div class="book-listing">
	<div class="book-pic" style="background-image: url(<?php echo $imageUrl; ?>)" alt="Image: Shakespeare's Hamlet (Cliffs Complete)"></div>
	<div class="book-listing-bg"></div>
	<a class="book-link" href=""></a>
	<div class="book-info">
		<div class="book-info-top"></div> <!-- UI stuff -->
		<h2><a href=""><?php echo $title; ?></a></h2> <!-- book title -->
		<p class="book-author">by <?php echo $author; ?></p>
		<p class="book-isbn">ISBN-13: <?php echo $isbn13; ?></p>
		<p class="book-pub">Pub: <?php echo $publisher; ?></p>
		<div class="book-courses">
		
		<?php
			$i = 0;
			foreach($courses as $course) { 
				if ($i > 0) echo ", "; $i++;
			?>
				<a class="<?php if($course['required']) echo 'required';?>" href="<?php echo $course['url'];?>"><?php echo $course['name'];?></a>
			<?php }
		
		?>
		<a class="required" href="">ELAP</a>, <a class="required" href="">ELAP Acc</a>
		</div>
		<!--<div class="book-min-price">$13.29</div>
		<div class="book-num-offers">2</div>-->
	</div>
</div> <!-- end book-listing -->
