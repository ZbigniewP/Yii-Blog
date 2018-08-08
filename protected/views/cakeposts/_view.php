<div class="post">
	<div class="title">
		<?= CHtml::link(CHtml::encode($data->name), $data->url)?>
	</div>
	<div class="author">
		posted by <?= $data->author->username . ' on ' . $data->created ?>
	</div>
	<div class="content">
		<?php
			$this->beginWidget('CMarkdown', ['purifyOutput'=>true]);
			echo empty($_GET['id'])?truncate($data->content, 450, '...'):$data->content;
			$this->endWidget();
		?>
	</div>
	<div class="nav">
		<b>Category:</b>
		<?= $data->categoryLink ?>
		<br />
		<?= CHtml::link('Permalink', $data->url)?> |
		<?= CHtml::link("Comments ({$data->commentCount})",$data->url.'#comments')?>
		<?php if(!empty($data->updated)):?> |
			Last updated on <?php echo date('F j, Y', $data->updated)?>
		<?php endif; ?>
	</div>
</div>
