<?php foreach ($comments as $comment) : ?>
<div class="comment" id="c<?= $comment->id ?>">

	<?= CHtml::link("#{$comment->id}", $comment->getUrl($post), ['class' => 'cid', 'title' => 'Permalink to this comment']) ?>

	<div class="author">
		<?= $comment->authorLink ?> says:
	</div>

	<div class="time">
		<?= $comment->publishedAt ?>
	</div>

	<div class="content">
		<?= nl2br(CHtml::encode($comment->content)) ?>
	</div>

</div><!-- comment -->
<?php endforeach; ?>