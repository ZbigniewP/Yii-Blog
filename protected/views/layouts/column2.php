<?php $this->beginContent('/layouts/main')?>
<div class="container">
	<div class="span-18">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-6 last">
		<div id="sidebar">
<?php 
if (!Yii::app()->user->isGuest) $this->widget('UserMenu');

if ($this->id == 'cakeposts' || $this->id == 'postcake') {
	$this->widget('TopCategories', array('maxCategories' => 10, 'title' => 'Categories'));
	$this->widget('TopPosts', array('maxPosts' => 5, 'title' => 'Last posts'));
} else {
	$this->widget('TagCloud', array('maxTags' => Yii::app()->params['tagCloudCount']));
	$this->widget('RecentComments', array('maxComments' => Yii::app()->params['recentCommentCount']));
}
?>
		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent()?>