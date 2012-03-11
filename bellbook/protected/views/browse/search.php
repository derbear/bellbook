<?php

/* REQUIRES
 * $searchResults: the results of the search to display
 * $searchInput: the search that was inputted (so user can see what they inputted
 */


$this->breadcrumbs=array(
	'Browse'=>array('/browse'),
	'Search',
);?>


<?php $listWidget = $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$searchResults,
	'itemView'=>'_booklisting',
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
	
<!--<div id="loading">
	<div id="loading-upper-border"></div>
	<div id="animation"></div>
</div>-->
