<div class="form">

<?php $form = $this->beginWidget('CActiveForm')?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= CHtml::errorSummary($model)?>

	<div class="row">
		<?php echo $form->labelEx($model, 'name')?>
		<?php echo $form->textField($model, 'name', array('size' => 80, 'maxlength' => 255))?>
		<?php echo $form->error($model, 'name')?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'slug')?>
		<?php echo $form->textField($model, 'slug', array('size' => 80, 'maxlength' => 255))?>
		<?php echo $form->error($model, 'slug')?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'content')?>
		<?= CHtml::activeTextArea($model, 'content', array('rows' => 10, 'cols' => 70))?>
		<p class="hint">You may use <a target="_blank" href="http://daringfireball.net/projects/markdown/syntax">Markdown syntax</a>.</p>
		<?php echo $form->error($model, 'content')?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'category_id')?>
		<?php $this->widget('CAutoComplete', array(
		'model' => $model,
		'attribute' => 'category_id',
		'url' => array('suggestCategory'),
		'multiple' => true,
		'htmlOptions' => array('size' => 50),
	))?>
		<p class="hint">Please separate different tags with commas.</p>
		<?php echo $form->error($model, 'category_id')?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'status')?>
		<?php echo $form->dropDownList($model, 'status', Lookup::items('PostStatus'))?>
		<?php echo $form->error($model, 'status')?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save')?>
	</div>

<?php $this->endWidget()?>

</div><!-- form -->