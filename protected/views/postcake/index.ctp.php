<?php /** @var \App\View\AppView $this */ ?>
<div class="col-md-8 span-16">
	<div class="page-header">
		<h1>Blog</h1>
		<p class="lead">Welcome on my blog</p>
	</div>
	<?php foreach ($posts as $post): ?>
		<article>
			<h2><?= CHtml::link($post->name, ['postcake/view', 'slug' => $post->slug]) ?></h2>
			<p>
				<small>
					Category : <?= CHtml::link($post->category->name, ['postcake/category', 'slug' => $post->category->slug]) ?>,
					by <?= CHtml::link($post->user->username, ['postcake/author', 'id' => $post->user->id]) ?> 
					on <em><?= date('F jS Y, H:i', strtotime($post->created)) ?></em>
				</small>
			</p>
			<p><?php
				$this->beginWidget('CMarkdown', ['purifyOutput'=>true]);
				echo truncate($post->content, 450, '...');
				$this->endWidget();
			?></p>
			<p class="text-right" style="text-align:right;"><?= CHtml::link('Read more...', 
			['postcake/view', 'slug' => $post->slug], ['class' => 'btn btn-primary']) 
			?></p>
		</article>
		<hr />
	<?php endforeach; ?>

	<?php $this->widget('CLinkPager', ['pages' => $pages]) ?>
</div>