<div class="post">
	<div class="title">
		<?php echo CHtml::link(CHtml::encode($data->name), $data->url)?>
	</div>
	<div class="author">
		posted by <?php echo $data->author->username . ' on ' . $data->created ?>
	</div>
	<div class="content">
		<?php
			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			echo $data->content;
			$this->endWidget();
		?>
	</div>
	<div class="nav">
		<b>Category:</b>
		<?php echo $data->categoryLink ?>
		<br />
		<?php echo CHtml::link('Permalink', $data->url)?> |
		<?php echo CHtml::link("Comments ({$data->commentCount})",$data->url.'#comments')?>
		<?php if(!empty($data->updated)):?> |
			Last updated on <?php echo date('F j, Y', $data->updated)?>
		<?php endif; ?>
	</div>
</div>
