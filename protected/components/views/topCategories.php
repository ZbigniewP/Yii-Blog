<?php
// $this->getRecentCategories()
// $this->getRecentTags()
// $this->getRecentComments()
// $this->getLastPosts()
// foreach ($categorys as $category) :
// 	echo CHtml::link(CHtml::encode($category->name),
// 		['controller' => 'Posts', 'action' => 'view', 'slug' => $category->slug],
// 		['class' => 'list-group-item']);
// endforeach;
?>
<ul class="list-group">
<?php foreach ($this->getTopCategories() as $category) : ?>
	<li class="list-group-item">
		<span class="badge" style="float:right;"><?= ($category->post_count) ?></span>
		<?= CHtml::link(CHtml::encode($category->name), ['category', 'slug' => $category->slug, 'id' => $category->id]) ?>
	</li>
<?php endforeach; ?>
</ul>