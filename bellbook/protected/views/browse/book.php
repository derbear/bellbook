<?php

/*
 * the UI of a book page
 * 
 * requires:
 * $model (BookSelectionForm) the book we are viewing
 *
 */
 
 ?>
 
We found your book!

<?php 
	$this->renderPartial("_booklisting", array('data'=>$model));
	?>

<div style="clear:both"></div>

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