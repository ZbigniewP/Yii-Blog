<?php /** @var \App\View\AppView $this */ ?>
<div class="col-md-4 span-8 sidebar">
	<h4>Categories</h4>
	<div class="list-group">
<?php 
// $this->getRecentCategories()
foreach ($categories as $category) :
	echo CHtml::link("<span class=\"badge\">{$category->post_count}</span>{$category->name}",
		['controller' => 'Posts', 'action' => 'category', 'slug' => $category->slug],
		['escape' => false, 'class' => 'list-group-item']);
endforeach;
?>
	</div>

	<h4>Last posts</h4>
	<div class="list-group">
<?php

// $this->getRecentCategories()
// $this->getRecentTags()
// $this->getRecentComments()
// $this->getLastPosts()
foreach ($posts as $post) :
	echo CHtml::link($post->name,
		['controller' => 'Posts', 'action' => 'view', 'slug' => $post->slug],
		['class' => 'list-group-item']);
endforeach;
?>
	</div>
</div>