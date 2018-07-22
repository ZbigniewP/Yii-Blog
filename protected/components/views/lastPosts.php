<ul class="list-group">
<?php foreach ($this->getLastPosts() as $post) : ?>
	<li class="list-group-item">
		<span style="float:right;">(<?= $post->user->username ?>)</span>
		<?= CHtml::link(CHtml::encode($post->name), ['view', 'id' => $post->id, 'slug' => $post->slug]) ?>
	</li>
<?php endforeach; ?>
</ul>