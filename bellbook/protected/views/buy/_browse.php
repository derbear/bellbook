<?php
/**
 * _browse.php - the partial browse view
 * @author: Nano8Blazex
 *
 * Takes data:
 *
 * $browseList: The list of books to show
 * $searchParams: The actual user search parameters (so they can see what they searched for)
 */
 ?>
 
<form action="<?php echo $this->createUrl("buy/browse");
    ?>" method="get" id="search-form">
	<input type="text" name="BrowseForm[searchInput]" id="search-box" value="<?php echo $searchParams->searchInput;?>"> <input type="submit" id="submit" value="Search Book Titles">
</form>
	
	
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$browseList,
	'itemView'=>'_view',
	'sortableAttributes'=>array(
		'title',
		'author_lastname',
),
	'template' => '{sorter}{pager}{items}{sorter}{pager}',
	'itemsTagName' => 'ul', // the enclosing box of the whoe thing
	'itemsCssClass' => 'search-results',
	// note pagination is set in the CActiveDataProvider
)); ?>
