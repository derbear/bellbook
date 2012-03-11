<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('sell_offer_id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->sell_offer_id), array('view', 'id'=>$data->sell_offer_id)); ?>
    <br />

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

    <?php /*
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

    */ ?>

</div>