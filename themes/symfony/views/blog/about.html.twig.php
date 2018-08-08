<?php 
$body_id = strtolower(str_replace('/', '-', trim(ltrim(ltrim($this->id, 'symfony'), 'admin'), '/')) . '-' . $this->action->id);
if ($this->id == 'symfony/blog' || $this->id == 'symfony/post' || $body_id == 'security-login'): ?>
<div class="section about">
	<div class="well well-lg">
		<p>
			<?= Yii::t('messages', 'help.app_description')?>
		</p>
		<p>
			<?= Yii::t('messages', 'help.more_information')?>
		</p>
	</div>
</div>
<?php endif; ?>

<?php
	if ($this->id == 'cakeposts' || $this->id == 'postcake') :
		$this->widget('TopCategories', [
			'maxCategories' => 10,
			'title' => '<h4>Categories</h4>',
			'htmlOptions' => ['class' => 'col-md-4 sidebar'],//['class'=>'portlet']
			'decorationCssClass' => 'list-group',//'portlet-decoration',
			'titleCssClass' => 'list-group-item-heading',//'portlet-title',
			'contentCssClass' => 'list-group-item-text',//'portlet-content',
		]);
		$this->widget('TopPosts', [
			'maxPosts' => 5,
			'title' => '<h4>Last posts</h4>',
			'htmlOptions' => ['class' => 'col-md-4 sidebar', 'style' => 'margin-top: 0;'],
			'decorationCssClass' => 'list-group',
			'titleCssClass' => 'list-group-item-heading',
			'contentCssClass' => 'list-group-item-text',
		]);
	else :
		if($this->id != 'symfony/security'):
			$this->widget('TagCloud', ['maxTags' => Yii::app()->params['tagCloudCount']]);
			$this->widget('RecentComments', ['maxComments' => Yii::app()->params['recentCommentCount']]);
		endif;
	endif;
?>
<!-- <?= strftime('%c %Z') ?>
<?= date('d-M-Y H:i:s T') ?>
<?= gmdate('d-M-Y H:i:s T') ?>
<?= gmdate('c') ?>
<?= CTimestamp::formatDate('d-M-Y H:i:s T') ?> -->
<?php
Yii::app()->format->dateFormat = 'long';
Yii::app()->format->timeFormat = 'full';
?>
<!-- {# it's not mandatory to set the timezone in localizeddate(). This is done to
   avoid errors when the 'intl' PHP extension is not available and the application
   is forced to use the limited "intl polyfill", which only supports UTC and GMT #} -->
<!-- Fragment rendered on <?= Yii::app()->format->datetime(time()) ?> -->
