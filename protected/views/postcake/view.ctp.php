<?php /** @var \App\View\AppView $this */ ?>
<div class="col-md-8 span-16">
	<div class="page-header">
		<h1><?= $post->name; ?></h1>
		<p>
			<small>
				Category : <?= CHtml::link($post->category->name, ['/postcake/category', 'slug' => $post->category->slug]) ?>,
				by <?= CHtml::link($post->user->username, ['/postcake/author', 'id' => $post->user->id]) ?> 
				on <em><?= date('F jS Y, H:i', strtotime($post->created)) ?></em>
			</small>
		</p>
	</div>

	<article>
		<?php
			$this->beginWidget('CMarkdown', ['purifyOutput'=>true]);
			echo $post->content;
			$this->endWidget();
		?>
	</article>

	<hr />

	<section class="comments">

		<h3>Comment this post</h3>

		<?php $form = $this->beginWidget('CActiveForm')?>
		<div class="row">
			<div class="col-md-6 span-12">
				<?= $form->textField($comment, 'mail', ['class' => 'form-control', 'placeholder' => 'Your email', 'label' => false]) ?>
			</div>
			<div class="col-md-6 span-12">
				<div class="form-group">
					<?= $form->textField($comment, 'username', ['class' => 'form-control', 'placeholder' => 'Your username', 'label' => false]) ?>
				</div>
			</div>
			<?= $form->hiddenField($comment, 'post_id', ['value' => $post->id]) ?>
		</div>
		
		<div class="form-group">
			<?= CHtml::activeTextArea($comment, 'content', ['class' => 'form-control', 'placeholder' => 'Your comment', 'label' => false]) ?>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
		<?php $this->endWidget()?>

		<?php if ($post->comments): ?>
			<h3><?= count($post->comments) ?> Commentaires</h3>
			<?php foreach ($post->comments as $comment): ?>
				<div class="row">
					<div class="col-md-2 span-4">
						<img src="http://lorempicsum.com/futurama/100/100/<?= mt_rand(1, 9) ?>" width="100%">
					</div>
					<div class="col-md-10 span-20">
						<p><strong><?= $comment->username ?></strong> <?php
						//$comment->created->timeAgoInWords() 
						?></p>
						<p><?php
						$this->beginWidget('CMarkdown', ['purifyOutput'=>true]);
						echo $comment->content;
						$this->endWidget();
						?></p>
					</div>
				</div>
				<hr />
			<?php endforeach; ?>
		<?php endif; ?>
	</section>
</div>