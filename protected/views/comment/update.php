<?php $this->breadcrumbs = array('Comments' => array('index'), 'Update Comment #' . $model->id)?>

<h1>Update Comment #<?= $model->id; ?></h1>

<?= $this->renderPartial('_form', array('model' => $model))?>