<ul>
	<?php foreach($this->getRecentComments() as $comment): ?>
	<li><?= $comment->authorLink; ?> on
		<?php 
		if(isset($comment->post->title)) echo CHtml::link(CHtml::encode($comment->post->title), $comment->getUrl());
		else echo CHtml::link(CHtml::encode($comment->post->name), $comment->getUrl()); 
		?>
	</li>
	<?php endforeach; ?>
</ul>