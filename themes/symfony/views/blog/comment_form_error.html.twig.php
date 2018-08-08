<!-- {% extends 'base.html.twig' %} -->
<!-- {% block body_id 'comment_form_error' %} -->

<!-- {% block main %} -->
	<h1 class="text-danger"><?= Yii::t('messages', 'title.comment_error') ?></h1>

	<div class="well">
		<?= $this->renderPartial('//blog/_comment_form.html.twig')?>
	</div>
<!-- {% endblock %} -->
