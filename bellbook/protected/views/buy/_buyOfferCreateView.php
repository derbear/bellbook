<h1>OFFER TO BUY!</h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'buy-offer-hi-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($data); ?>

    <div class="row">
        <?php echo $form->labelEx($data,'user_id'); ?>
        <?php echo $form->textField($data,'user_id'); ?>
        <?php echo $form->error($data,'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($data,'accepted'); ?>
        <?php echo $form->textField($data,'accepted'); ?>
        <?php echo $form->error($data,'accepted'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($data,'sell_offer_id'); ?>
        <?php echo $form->textField($data,'sell_offer_id'); ?>
        <?php echo $form->error($data,'sell_offer_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($data,'num_notifications'); ?>
        <?php echo $form->textField($data,'num_notifications'); ?>
        <?php echo $form->error($data,'num_notifications'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($data,'offered_price'); ?>
        <?php echo $form->textField($data,'offered_price'); ?>
        <?php echo $form->error($data,'offered_price'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($data,'notes'); ?>
        <?php echo $form->textField($data,'notes'); ?>
        <?php echo $form->error($data,'notes'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit Buy Offer!'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->