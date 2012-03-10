<?php
/**
 * index.php - the home page of profile
 * @author: Nano8Blazex
 *
 * Takes data:
 *
 * User $model: user to render profile view for
 */
 ?>
 
 <?php
$this->breadcrumbs=array(
	'Profile',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>

<a href="profile/logout">Logout!</a>

<div class="view">

    <b><?php echo CHtml::encode($model->getAttributeLabel('user_id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($model->user_id), array('view', 'id'=>$model->user_id)); ?>
    <br />

    <b><?php echo CHtml::encode($model->getAttributeLabel('first_name')); ?>:</b>
    <?php echo CHtml::encode($model->first_name); ?>
    <br />

    <b><?php echo CHtml::encode($model->getAttributeLabel('last_name')); ?>:</b>
    <?php echo CHtml::encode($model->last_name); ?>
    <br />

    <b><?php echo CHtml::encode($model->getAttributeLabel('email')); ?>:</b>
    <?php echo CHtml::encode($model->email); ?>
    <br />

    <b><?php echo CHtml::encode($model->getAttributeLabel('grad_yr')); ?>:</b>
    <?php echo CHtml::encode($model->grad_yr); ?>
    <br />

    <b><?php echo CHtml::encode($model->getAttributeLabel('trustworthiness_rating')); ?>:</b>
    <?php echo CHtml::encode($model->trustworthiness_rating); ?>
    <br />

    <b><?php echo CHtml::encode($model->getAttributeLabel('last_online')); ?>:</b>
    <?php echo CHtml::encode($model->last_online); ?>
    <br />

    <?php /*
    <b><?php echo CHtml::encode($model->getAttributeLabel('student_id')); ?>:</b>
    <?php echo CHtml::encode($model->student_id); ?>
    <br />

    <b><?php echo CHtml::encode($model->getAttributeLabel('image_url')); ?>:</b>
    <?php echo CHtml::encode($model->image_url); ?>
    <br />

    */ ?>

</div>
