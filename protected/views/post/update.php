<?php $this->breadcrumbs = array('Update', $model->title => $model->url) ?>

<h1>Update <i><?= CHtml::encode($model->title) ?></i></h1>

<?= $this->renderPartial('_form', array('model' => $model)) ?>