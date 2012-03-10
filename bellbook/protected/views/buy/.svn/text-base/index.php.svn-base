<?php
/**
 * index.php - the home page of buy books
 * @author: Nano8Blazex
 *
 * Takes data:
 *
 * CDataProvider $myBuyOffers: The list of the user's buy offers
 * CDataProvider $searchResultList: The list of books to show in browse section
 * BookForm $searchParams: The actual user search parameters (so they can see what they searched for)
 */
 ?>

<?php
$this->breadcrumbs=array(
	'Buy',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
<p>so this is basically like a summary page, combining browse and myoffers actions</p>
<p>at top we list the user's current buy offers ongoing transactions)</p>
<h1>Ongoing Transactions</h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$myBuyOffers,
	'itemView'=>'_buyOfferListView',
	'sortableAttributes'=>array(
		'user_id',
		'num_notifications',
		'accepted',
),
	'template' => '{sorter}{pager}{items}{sorter}{pager}',
	'itemsTagName' => 'ul', // the enclosing box of the whoe thing
	'itemsCssClass' => 'my-buy-offers',
	// note pagination is set in the CActiveDataProvider
)); ?>

<h1>Browse</h1>
<p>at mid we list the browsing - with teh search bar title :) it would look like "Suggestions 0-" and clicking/searching would direct to the browse action - each book has the number of selloffers at top as a notification</p>
<p>so this is basically like a summary page</p>

<?php echo $this->renderPartial('_browse', array('browseList'=>$searchResultList, 'searchParams'=>$searchParams,)); ?>