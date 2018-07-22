<div class="post">
	<div class="title">
		<?= CHtml::link(CHtml::encode($data->title), $data->url)?>
	</div>
	<div class="author">
		posted by <?php echo $data->author->username . ' on ' . (isset($data->publishedAt) ? $data->publishedAt : date('F j, Y', $data->create_time))?>
	</div>
	<div class="content">
		<?php
		// print_r($_GET['title']);
	$this->beginWidget('CMarkdown', array('purifyOutput' => true));
	// echo $this->Text->truncate($post->content, 450, ['ellipsis' => '...', 'exact' => false]);
	echo isset($_GET['title']) ? $data->content : (isset($data->summary) ? $data->summary : $data->content);
	$this->endWidget();
	?>
	</div>
	<div class="nav">
		<b>Tags:</b>
		<?php echo implode(', ', $data->tagLinks) ?>
		<br />
		<?= CHtml::link('Permalink', $data->url) ?> |
		<?= CHtml::link("Comments ({$data->commentCount})", $data->url . '#comments') ?> |
		Last updated on <?php echo date('F j, Y', $data->update_time) ?>
	</div>
</div>