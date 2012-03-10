
<div class="view">
	<?php echo CHtml::link(CHtml::encode("HEY VISIT THIS SELL OFFER"), array('buy/browse', 'bookid'=>$data->book_id, 'sellid'=>$data->sell_offer_id)); ?>

    <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
    <?php echo CHtml::encode($data->user_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('book_id')); ?>:</b>
    <?php echo CHtml::encode($data->book_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
    <?php echo CHtml::encode($data->description); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('bargainable')); ?>:</b>
    <?php echo CHtml::encode($data->bargainable); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('open')); ?>:</b>
    <?php echo CHtml::encode($data->open); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
    <?php echo CHtml::encode($data->price); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
    <?php echo CHtml::encode($data->date); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('pickup')); ?>:</b>
    <?php echo CHtml::encode($data->pickup); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('confirmed')); ?>:</b>
    <?php echo CHtml::encode($data->confirmed); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('num_notifications')); ?>:</b>
    <?php echo CHtml::encode($data->num_notifications); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('image_url')); ?>:</b>
    <?php echo CHtml::encode($data->image_url); ?>
    <br />
    
    <b><?php echo CHtml::encode("Number of Buy Offers"); ?>:</b>
    <?php echo CHtml::encode(count($data->buyOffers)); ?>
    <br />



</div>