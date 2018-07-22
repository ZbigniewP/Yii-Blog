<div class="post">
	<div class="title">
		<?= CHtml::link(CHtml::encode($data->title), $data->url)?>
	</div>
	<div class="author">
		posted by <?php echo $data->author->username . ' on ' . $data->publishedAt ?>
	</div>
	<div class="content">
		<?php
		$this->beginWidget('CMarkdown', array('purifyOutput' => true));
		echo isset($_GET['title']) ? $data->content : (isset($data->summary) ? $data->summary : $data->content);
		$this->endWidget();
		?>
	</div>
	<div class="nav">
		<b>Tags:</b>
		<?php echo implode(', ', $data->tagLinks)?>
		<br />
		<?= CHtml::link('Permalink', $data->url)?> |
		<?= CHtml::link("Comments ({$data->commentCount})", $data->url . '#comments')?>
		<?php if(!empty($data->updatedAt)):?> |
			Last updated on <?php echo date('F j, Y', $data->updatedAt)?>
		<?php endif; ?>
	</div>
</div>