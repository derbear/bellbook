<?php

/*
 * the UI of a book page in depth
 * 
 * requires:
 * $model (BookSelectionForm) the book we are viewing
 *
 */
 
 ?>
 
<div id="book">
<?php 
	$this->renderPartial("_bookbiglisting", array('data'=>$model));
	?>

<div style="clear:both"></div>
</div>


<div id="sell-offers">
	<div id="border-left"></div>

<?php

	$sellOffersDataProvider = new CArrayDataProvider($model->sellOffers, array(
	    'pagination'=>array(
	        'pageSize'=>30,
	    ),
	    'id'=>'sell_offer_id',
	    'keyField'=>false,
	));
	
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$sellOffersDataProvider,
		'itemView'=>'_sellofferlisting',
		'emptyText'=>'No Offers Yet! Want to add one?',
	)); 
?>
</div>
<div style="clear:both"></div>