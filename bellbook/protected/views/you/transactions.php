<?php
/**
 * transactions.php - sell home page
 * @author: Nano8Blazex
 *
 * Takes data:
 *
 * $mySellOffers (CActiveDataProvider) User's sell offers
 */
 ?>
 
<p>
	here, we will list the current books you are selling with little notification bubbles that show the amount of interest/comments/buy offers on your sell offers! and buy offers and stuff like that L:Kj;lkaj;skfj;alksdfj;alskdfj;aklsdfj;slkdfj;askdjf;asjdf;laksjdf;lkasj;lfkaj;lskjd
</p>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$mySellOffers,
	'itemView'=>'_sellOfferView',
)); ?>
