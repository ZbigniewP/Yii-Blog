<?php 
Yii::app()->format->dateFormat = 'medium';
Yii::app()->format->timeFormat = 'medium';
?>
<!-- {% extends 'base.html.twig' %} -->
<!-- {% block body_id 'blog-index' %} -->

<!-- {% block main %} -->
<?php if(count($posts)): ?>
<?php foreach ($posts as $post) : ?>
		<article class="post">
			<h2>
				<a href="<?= Yii::app()->createUrl('symfony/post/show', ['slug'=>$post->slug]) ?>">
					<?= $post->title ?>
				</a>
			</h2>
			<p class="post-metadata">
				<span class="metadata"><i class="fa fa-calendar"></i> <?= Yii::app()->format->datetime($post->publishedAt) ?></span>
				<span class="metadata"><i class="fa fa-user"></i> <?= $post->author->fullName ?></span>
			</p>
			<?php
			// |md2html
			$this->beginWidget('CMarkdown', ['purifyOutput' => true]);
			// echo $this->Text->truncate($post->content, 450, ['ellipsis' => '...', 'exact' => false]);
			echo $post->summary;
			$this->endWidget();
			?>
			<?php $this->renderPartial('//blog/_post_tags.html.twig', ['tags' => $post->symfonyDemoTags]) ?>
		</article>
<?php endforeach; ?>
<?php
// echo "<pre>";
// print_r($this->theme);
// echo "</pre>";
// exit();
$this->widget('CLinkPager', [
	'pages' => $pages,
	'header' => '<div class="navigation text-center list-view">',
	'footer' => '</div>',
	'htmlOptions' => ['class' => Yii::app()->theme->name == 'symfony' ? 'pagination' : 'yiiPager'],
]); 
	?>
	<!-- {% if posts.haveToPaginate %} -->
		<div class="navigation text-center">
			<!-- {{ pagerfanta(posts, 'twitter_bootstrap3_translated', {routeName: 'blog_index_paginated'}) }} -->
		</div>
	<!-- {% endif %} -->
<?php else: ?>
		<div class="well"><?= Yii::t('messages', 'post.no_posts_found') ?></div>
<?php endif; ?>
<!-- {% endblock %} -->

<!-- {% block sidebar %} -->
	<!-- {{ parent() }} -->
	<!-- {{ show_source_code(_self) }} -->
	<?= $this->renderPartial('//blog/_rss.html.twig') ?>
<!-- {% endblock %} -->