<?php
$deleteJS = <<<DEL
$('.container').on('click','.time a.delete',function() {
	var th=$(this),
		container=th.closest('div.comment'),
		id=container.attr('id').slice(1);
	if(confirm('Are you sure you want to delete comment #'+id+'?')) {
		$.ajax({
			url:th.attr('href'),
			type:'POST'
		}).done(function(){container.slideUp()});
	}
	return false;
});
DEL;
Yii::app()->getClientScript()->registerScript('delete', $deleteJS);
?>
<div class="comment" id="c<?= $data->id; ?>">

	<?= CHtml::link("#{$data->id}", $data->url, array('class' => 'cid', 'title' => 'Permalink to this comment'))?>

	<div class="author">
		<?= $data->authorLink; ?> says on
		<?= CHtml::link(CHtml::encode($data->post->title), $data->post->url)?>
	</div>

	<div class="time">
		<?php if ($data->status <= DemoComment::STATUS_PENDING) : ?>
			<span class="pending">Pending approval</span> |
			<?= CHtml::linkButton('Approve', array('submit' => array('approve', 'id' => $data->id)))?> |
		<?php endif; ?>
		<?= CHtml::link('Update', array('update', 'id' => $data->id))?> |
		<?= CHtml::link('Delete', array('delete', 'id' => $data->id), array('class' => 'delete'))?> |
		<?= $data->publishedAt ?>
	</div>

	<div class="content">
		<?php echo nl2br(CHtml::encode($data->content))?>
	</div>

</div><!-- comment -->