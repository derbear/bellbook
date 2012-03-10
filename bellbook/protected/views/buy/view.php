<?php
/**
 * view.php - the view page of buy books - displays book and corresponding sell offer(s)
 * @author: Nano8Blazex
 *
 * Takes data:
 *
 * Book $book: The book to display
 * CDataProvider $sellOfferList: List of sell offers to display (data provider) (can be null)
 * 		-is derivable from $book, but due to MVC separation we ask the controller to supply us this info
 * SellOffer $sellOffer: sell offer to display (can be null)
 * CDataProvider $buyOfferList: List of buy offers to display 
 *		- only shown when the corresponding sellOffer is set.
 *		- is derivable from $sellOffer, but once again, we ask the controller to do it for us
 * BuyOffer $buyOfferForm: the buyOffer associated with the form to create a buyOffer
 * Boolean $nBOSuccess: if true, display a success message because the 
 *						buyOfferForm was just successfully saved
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

<?php echo $this->renderPartial('_view', array('data'=>$book)); ?>

<p>Now we list the offers! In the right column. Pretend the book info is the left side column… just pretend. I mean it.</p>

<h1>Sell Offers</h1>
<?php 
// render these lists only if the controller tells us to by setting them
if (isset($sellOfferList)) {

	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$sellOfferList,
		'itemView'=>'_sellOfferListView',
		'sortableAttributes'=>array(
			'user_id',
			'price',
			'date',
		),
		'template' => '{sorter}{pager}{items}{sorter}{pager}',
		'itemsTagName' => 'ul', // the enclosing box of the whoe thing
		'itemsCssClass' => 'search-results',
		// note pagination is set in the CActiveDataProvider
	)); 
	
} ?>
<?php 

if (isset($sellOffer, $buyOfferForm, $buyOfferList)) { //if we're looking at an indiv selloffer
	echo $this->renderPartial('_sellOfferFullView', array('data'=>$sellOffer)); 
	// render the "buy" form
	echo $this->renderPartial('_buyOfferCreateView', array('data'=>$buyOfferForm));
	// render the other buy offers and their (collapsed) comments! ?>
	
	<h1>Buy Offers</h1>
	<p>Number of offers: <?php echo $buyOfferList->itemCount; ?></p>
<?php
	
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$buyOfferList,
		'itemView'=>'_buyOfferListView',
		'sortableAttributes'=>array(
			'user_id',
			'offered_price',
			//'date', //we forgot about date… todo
		),
		'template' => '{sorter}{pager}{items}{sorter}{pager}',
		'itemsTagName' => 'ul', // the enclosing box of the whoe thing
		'itemsCssClass' => 'buy-offers',
		// note pagination is set in the CActiveDataProvider
	));
}