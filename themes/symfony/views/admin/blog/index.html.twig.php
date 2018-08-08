<?php
Yii::app()->format->dateFormat = 'medium';
Yii::app()->format->timeFormat = 'short';
// Yii::app()->language = 'pl';
// |localizeddate('medium', 'short', null, 'UTC') }}
?>
<!-- {% extends 'admin/layout.html.twig' %} -->
<!-- {% block body_id 'admin_post_index' %} -->

<!-- {% block main %} -->
	<h1><?= Yii::t('messages', 'title.post_list') ?></h1>
	<table class="table table-striped table-middle-aligned">
		<thead>
			<tr>
				<th scope="col"><?= Yii::t('messages', 'label.title') ?></th>
				<th scope="col"><i class="fa fa-calendar" aria-hidden="true"></i> <?= Yii::t('messages', 'label.published_at') ?></th>
				<th scope="col" class="text-center"><i class="fa fa-cogs" aria-hidden="true"></i> <?= Yii::t('messages', 'label.actions') ?></th>
			</tr>
		</thead>
		<tbody>
		<?php if (count($posts)) : ?>
		<?php foreach ($posts as $post) : ?>
			<tr>
				<td><?= $post->title ?></td>
				<!-- {# it's not mandatory to set the timezone in localizeddate(). This is done to
				   avoid errors when the 'intl' PHP extension is not available and the application
				   is forced to use the limited "intl polyfill", which only supports UTC and GMT #} -->
				<td><?= Yii::app()->format->datetime($post->publishedAt) ?></td>
				<td class="text-right" style="text-align:right">
					<div class="item-actions">
					<?php if (Yii::app()->theme->name == 'symfony') : ?>
						<a href="<?= Yii::app()->createUrl('symfony/admin/post/show', ['id' => $post->id]) ?>" class="btn btn-sm btn-default">
							<i class="fa fa-eye" aria-hidden="true"></i> <?= Yii::t('messages', 'action.show') ?>
						</a>
						<a href="<?= Yii::app()->createUrl('symfony/admin/post/edit', ['id' => $post->id]) ?>" class="btn btn-sm btn-primary">
							<i class="fa fa-edit" aria-hidden="true"></i> <?= Yii::t('messages', 'action.edit') ?>
						</a>
					<?php else : ?>
						<a class="view" title="<?= Yii::t('messages', 'action.show') ?>" href="<?= Yii::app()->createUrl('symfony/admin/post/show', ['id' => $post->id]) ?>"><img src="/assets/ea43bbac/gridview/view.png" alt="View"></a> 
						<a class="update" title="<?= Yii::t('messages', 'action.edit') ?>" href="<?= Yii::app()->createUrl('symfony/admin/post/edit', ['id' => $post->id]) ?>"><img src="/assets/ea43bbac/gridview/update.png" alt="Update"></a> 
						<a class="delete" title="<?= Yii::t('messages', 'action.delete_post') ?>" href="<?= Yii::app()->createUrl('symfony/admin/post/delete', ['id' => $post->id]) ?>"><img src="/assets/ea43bbac/gridview/delete.png" alt="Delete"></a>
					<?php endif ?>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
		<?php else : ?>
			<tr>
				<td colspan="4" align="center"><?= Yii::t('messages', 'post.no_posts_found') ?></td>
			</tr>
		<?php endif ?>
		</tbody>
	</table>
	<?php 
$this->widget('CLinkPager', [
	'pages' => $pages,
	'header' => '<div class="navigation text-center list-view">',
	'footer' => '</div>',
	'htmlOptions' => ['class' => Yii::app()->theme->name == 'symfony' ? 'pagination' : 'yiiPager'],
	// 'selectedPageCssClass' => ['active selected'],
]);
?>
<!-- {% endblock %} -->

<!-- {% block sidebar %} -->
	<div class="section actions">
		<a href="<?= Yii::app()->createUrl('symfony/admin/post/new') ?>" class="btn btn-lg btn-block btn-success">
			<i class="fa fa-plus" aria-hidden="true"></i> <?= Yii::t('messages', 'action.create_post') ?>
		</a>
	</div>
	<!-- {{ parent() }} -->
	<!-- {{ show_source_code(_self) }} -->
<!-- {% endblock %} -->
