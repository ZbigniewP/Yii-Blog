<h1>Manage posts</h1>

<p><?= CHtml::link('Add a new post', ['admincake/add'], ['class' => 'btn btn-primary']) ?></p>
<table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th width="50%">Name</th>
			<th>Category</th>
			<th>Publication date</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($posts as $post): ?>
<?php
// echo "<pre>";
// print_r($post);
// echo "</pre>";
// exit();
?>
			<tr>
				<td><?= $post->id ?></td>
				<td><?= isset($post->title)?$post->title:$post->name ?></td>
				<td nowrap><?= isset($post->symfonyDemoTags)?$post->symfonyDemoTags:$post->category->name ?></td>
				<td align="right" nowrap><?= Yii::app()->format->datetime(isset($post->update_time)?$post->update_time:$post->created ) ?></td>
				<td align="right" nowrap width="180px"><span class="btn-group">
<?php
echo  
CHtml::link(
	'<span class="glyphicon glyphicon-eye-close"></span>',
	['controller' => 'Posts', 'action' => 'view', 'slug' => $post->slug],
	['title' => 'View', 'class' => 'btn btn-default', 'escapeTitle' => false]
),
CHtml::link(
	'<span class="glyphicon glyphicon-edit"></span>',
	['admincake/edit', 'id' => $post->id],
	['title' => 'Edit', 'class' => 'btn btn-primary', 'escapeTitle' => false]
),
// $this->Form->postLink(
// 	__('<span class="glyphicon glyphicon-trash"></span>'),
// 	['admincake/delete', $post->id],
// 	['title' => 'Delete', 'class' => 'btn btn-danger', 'escapeTitle' => false, 'confirm' => __('Are you sure  ?')]
// ).
PHP_EOL;
?>
					</span>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

  <?php
  $this->widget('CLinkPager', ['pages' => $pages]) ?>
