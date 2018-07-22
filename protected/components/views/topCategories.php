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
// <span style="float:right;">()</span>

?>
<ul class="list-group">
<?php foreach ($this->getTopCategories() as $category) : ?>
	<li class="list-group-item">
		<span class="badge"><?= ($category->post_count) ?></span>
		<?= CHtml::link(CHtml::encode($category->name), ['view', 'id' => $category->id, 'slug' => $category->slug]) ?>
	</li>
<?php endforeach; ?>
</ul>