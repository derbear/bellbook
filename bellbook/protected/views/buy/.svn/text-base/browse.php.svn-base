<?php
/**
 * browse.php - the home page of buy books
 * @author: Nano8Blazex
 *
 * Takes data:
 *
 * CDataProvider $searchResultList: The list of books to show in browse section
 * BrowseForm $searchParams: The actual user search parameters (so they can see what they searched for)
 */
 ?>
 
 <?php
$this->breadcrumbs=array(
	'Buy'=>array('/buy'),
	'Browse',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>

<?php echo $this->renderPartial('_browse', array('browseList'=>$searchResultList, 'searchParams'=>$searchParams,)); ?>