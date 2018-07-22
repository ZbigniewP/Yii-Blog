<?php $this->breadcrumbs = array('Update', $model->name => $model->url) ?>

<h1>Update <i><?= CHtml::encode($model->name) ?></i></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)) ?>