<?php
$this->breadcrumbs=array(
	'Books'=>array('index'),
	$model->title=>array('view','id'=>$model->book_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Book', 'url'=>array('index')),
	array('label'=>'Create Book', 'url'=>array('create')),
	array('label'=>'View Book', 'url'=>array('view', 'id'=>$model->book_id)),
	array('label'=>'Manage Book', 'url'=>array('admin')),
);
?>

<h1>Update Book <?php echo $model->book_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>