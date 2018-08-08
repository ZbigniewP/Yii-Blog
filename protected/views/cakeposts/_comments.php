<?php foreach ($comments as $comment) : ?>
<div class="comment" id="c<?= $comment->id; ?>">

	<?= CHtml::link("#{$comment->id}", $comment->getUrl($post), array('class' => 'cid', 'title' => 'Permalink to this comment'))?>

	<div class="author">
		<?= $comment->authorLink; ?> says:
	</div>

	<div class="time">
		<?= $comment->created; ?>
	</div>

	<div class="content">
		<?php echo nl2br(CHtml::encode($comment->content))?>
	</div>

</div><!-- comment -->
<?php endforeach; ?>