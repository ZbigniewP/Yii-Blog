<?php $this->beginContent('/layouts/main')?>
<div class="container">
	<div class="span-18">
		<div id="content">
			<?= $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-6 last">
		<div id="sidebar">
<?php 
if (!Yii::app()->user->isGuest) $this->widget('UserMenu');
if ($this->id == 'symfony/yiipost'
	|| $this->id == 'symfony/blog'
	|| $this->id == 'symfony/security') {
	$this->renderPartial('/layouts/symfonySidebar');
}

if ($this->id == 'cakeposts' || $this->id == 'postcake') {
	$this->widget('TopCategories', ['maxCategories' => 10, 'title' => 'Categories']);
	$this->widget('TopPosts', ['maxPosts' => 5, 'title' => 'Last posts']);
}
if ($this->id == 'post' || $this->id == 'symfony/yiipost') {
	$this->widget('TagCloud', ['maxTags' => Yii::app()->params['tagCloudCount']]);
	$this->widget('RecentComments', ['maxComments' => Yii::app()->params['recentCommentCount']]);
}
?>
		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent()?>