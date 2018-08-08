<?php
Yii::app()->format->dateFormat = 'long';
Yii::app()->format->timeFormat = 'medium';
// Yii::app()->language = 'pl';
// |localizeddate('long', 'medium', null, 'UTC') }}
?>
<!-- {% extends 'admin/layout.html.twig' %} -->
<!-- {% block body_id 'admin-post-show' %} -->
<!-- {% block main %} -->
	<h1><?= $post->title ?></h1>

	<p class="post-metadata">
		<span class="metadata"><i class="fa fa-calendar"></i> <?= Yii::app()->format->datetime($post->publishedAt) ?></span>
		<span class="metadata"><i class="fa fa-user"></i> <?= $post->author->fullName ?></span>
	</p>

	<div class="well">
		<p class="m-b-0"><strong><?= Yii::t('messages', 'label.summary') ?></strong>: <?= $post->summary ?></p>
	</div>

	<?php
	// |md2html
	$this->beginWidget('CMarkdown', ['purifyOutput' => true]);
	// echo $this->Text->truncate($post->content, 450, ['ellipsis' => '...', 'exact' => false]);
	echo $post->content;
	$this->endWidget();
	?>
	<?php $this->renderPartial('//blog/_post_tags.html.twig', ['tags' => $post->symfonyDemoTags]) ?>
<!-- {% endblock %} -->

<!-- {% block sidebar %} -->
	<div class="section">
		<a href="<?= Yii::app()->createUrl('symfony/admin/post/edit',['id'=> $post->id]) ?>" class="btn btn-lg btn-block btn-success">
			<i class="fa fa-edit" aria-hidden="true"></i> <?= Yii::t('messages', 'action.edit_contents') ?>
		</a>
	</div>
	<div class="section">
		<?php $this->renderPartial('//admin/blog/_delete_form.html.twig', ['post' => $post]) ?>
		<!-- , with_context = false -->
	</div>
	<!-- {{ parent() }} -->
	<!-- {{ show_source_code(_self) }} -->
<!-- {% endblock %} -->
