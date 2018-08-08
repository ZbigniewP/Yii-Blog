<!-- {% extends 'admin/layout.html.twig' %} -->
<!-- {% block body_id 'admin-post-new' %} -->

<!-- {% block main %} -->
	<h1><?= Yii::t('messages', 'title.post_new') ?></h1>
	<!-- {{ form_start(form) }} -->
	<?php $form = $this->beginWidget('CActiveForm') ?>
		<!-- {{ form_row(form.title) }} -->
		<?= $form->textField($model, 'title',['class'=>'form-control']) ?>
		<!-- {{ form_row(form.summary) }} -->
		<?= $form->textField($model, 'summary',['class'=>'form-control']) ?>
		<!-- {{ form_row(form.content) }} -->
		<?= $form->textField($model, 'content',['class'=>'form-control']) ?>
		<!-- {{ form_row(form.publishedAt) }} -->
		<?= $form->textField($model, 'publishedAt',['class'=>'form-control']) ?>
		<!-- {{ form_row(form.tags) }} -->
		<?= $form->textField($model, 'tags',['class'=>'form-control']) ?>
		<?= CHtml::htmlButton('<i class="fa fa-save" aria-hidden="true"></i> ' . Yii::t('messages', 'label.create_post'),
							['class' => 'btn btn-primary', 'type' => 'submit']) ?>
<?php 
$this->widget('zii.widgets.jui.CJuiButton', [
		'buttonType' => 'button',
		'name'=>'btnSave',
		'caption' => Yii::t('messages', 'label.save_and_create_new'),
		'htmlOptions' => ['class' => 'btn btn-primary'],
		'onclick'=>new CJavaScriptExpression('function(){alert("Save button clicked"); this.blur(); return false;}'),
	]
);
?>
		<!-- {{ form_widget(form.saveAndCreateNew, {label: 'label.save_and_create_new', attr: {class: 'btn btn-primary'}}) }} -->
		<a href="<?= Yii::app()->createUrl('symfony/admin/post/index') ?>" class="btn btn-link">
			<i class="fa fa-list-alt" aria-hidden="true"></i> <?= Yii::t('messages', 'action.back_to_list') ?>
		</a>
	<!-- {{ form_end(form) }} -->
	<?php $this->endWidget() ?>
<!-- {% endblock %} -->

<!-- {% block sidebar %} -->
	<!-- {{ parent() }} -->
	<!-- {{ show_source_code(_self) }} -->
<!-- {% endblock %} -->
