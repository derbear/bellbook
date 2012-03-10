<?php
/**
 * index.php - sell home page
 * @author: Nano8Blazex
 *
 * Takes data:
 *
 * $mySellOffers: User's sell offers
 */
 ?>
 
 <?php
$this->breadcrumbs=array(
	'Sell',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<?php echo CHtml::link('sell new book', array('sell/new'));  ?>
<p>
	here, we will list the current books you are selling with little notification bubbles that show the amount of interest/comments/buy offers on your sell offers!
</p>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$mySellOffers,
	'itemView'=>'_sellOfferView',
)); ?>
