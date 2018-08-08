<!-- {% extends 'admin/layout.html.twig' %} -->
<!-- {% block body_id 'admin-post-edit' %} -->

<!-- {% block main %} -->
	<h1><?= Yii::t('messages', 'title.edit_post', ['%id%' => $post->id]) ?></h1>

	<?php $this->renderPartial('//admin/blog/_form.html.twig') ?>
	<!-- , {
		form: form,
		button_label: 'action.save'|trans,
		include_back_to_home_link: true,
	}, with_context = false) }} -->
<!-- {% endblock %} -->

<!-- {% block sidebar %} -->
	<div class="section">
		<a href="<?= Yii::app()->createUrl('symfony/admin/post/show', ['id' => $post->id]) ?>" class="btn btn-lg btn-block btn-success">
			<i class="fa fa-eye" aria-hidden="true"></i> <?= Yii::t('messages', 'action.show_post') ?>
		</a>
	</div>
	<div class="section actions">
		<?php $this->renderPartial('//admin/blog/_delete_form.html.twig', ['post' => $post]) ?>, with_context = false) }}
	</div>
	<!-- {{ parent() }} -->
	<!-- {{ show_source_code(_self) }} -->
<!-- {% endblock %} -->