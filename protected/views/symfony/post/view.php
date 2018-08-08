<?php
$this->breadcrumbs = [$model->title];
$this->pageTitle = $model->title;
?>

<?php $this->renderPartial('/symfony/post/_view', ['data' => $model]) ?>

<div id="comments">
	<?php if ($model->commentCount >= 1) : ?>
		<h3>
			<?= $model->commentCount > 1 ? $model->commentCount . ' comments' : 'One comment'; ?>
		</h3>
		<?php $this->renderPartial('/symfony/post/_comments', ['post' => $model, 'comments' => $model->comments]) ?>
	<?php endif; ?>

	<h3>Leave a Comment</h3>
	<?php if (Yii::app()->user->hasFlash('commentSubmitted')) : ?>
		<div class="flash-success">
			<?= Yii::app()->user->getFlash('commentSubmitted') ?>
		</div>
	<?php else : ?>
		<?php  $this->renderPartial('//symfony/comment/_form', ['model' => $comment]) ?>
	<?php endif; ?>

</div><!-- comments -->