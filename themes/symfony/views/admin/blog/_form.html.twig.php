<?php
// Yii::app()->format->dateFormat = 'long';
// Yii::app()->format->timeFormat = 'medium';
// Yii::app()->language = 'pl';
?>
<!-- {#
	By default, forms enable client-side validation. This means that you can't
	test the server-side validation errors from the browser. To temporarily
	disable this validation, add the 'novalidate' attribute:
	{{ form_start(form, {attr: {novalidate: 'novalidate'}}) }}
#} -->

<!-- {% if show_confirmation|default(false) %}
	{% set attr = {'data-confirmation': 'true'} %} -->
	<?php $this->renderPartial('//blog/_delete_post_confirmation.html.twig') ?>
<!-- {% endif %} -->

<!-- {{ form_start(form, {attr: attr|default({})}) }} -->
<?php $form = $this->beginWidget('CActiveForm') ?>
	<button type="submit" class="{{ button_css|default("btn btn-primary") }}">
		<i class="fa fa-save" aria-hidden="true"></i> <?= Yii::t('messages', 'label.create_post') ?>
	</button>
	<!-- {% if include_back_to_home_link|default(false) %} -->
		<a href="<?= Yii::app()->createUrl('symfony/admin/post/index') ?>" class="btn btn-link">
			<i class="fa fa-list-alt" aria-hidden="true"></i> <?= Yii::t('messages', 'action.back_to_list') ?>
		</a>
	<!-- {% endif %} -->
<?php $this->endWidget() ?>