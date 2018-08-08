<!-- {% if not post.tags.empty %} -->
	<p class="post-tags">
		<?php 
// echo "<pre>";
// print_r($post);
// echo "</pre>";
// exit();
		foreach($tags as $tag  ): ?>
			<span class="label label-default">
				<i class="fa fa-tag"></i> <?= $tag->name ?>
			</span>
		<?php endforeach; ?>
	</p>
<!-- {% endif %} -->