<?php
$this->breadcrumbs=array(
	// $model->name=>$model->url,
	'Update',
	$model->title=>$model->url,
);
?>

<h1>Update <i><?= CHtml::encode($model->title)?></i></h1>

<?= $this->renderPartial('/symfony/_form', array('model'=>$model))?>