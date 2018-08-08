<?php
// CHttpRequest::enableCsrfValidation=false;
// if($this->enableCsrfValidation) Yii::app()->attachEventHandler('onBeginRequest',array($this,'validateCsrfToken'));
Yii::app()->request->enableCsrfValidation = true;
if (Yii::app()->request->enableCsrfValidation) {
	// Yii::app()->request->csrfTokenName='authenticate';
	// $csrfTokenName = Yii::app()->request->csrfTokenName;
	$csrfToken = Yii::app()->request->csrfToken;
	$csrf = "\n\t\tdata:{ delete':'$csrfToken' },";
} else
	$csrf = '';
// {{ csrf_token('delete') }}
?>
<?php $this->renderPartial('//blog/_delete_post_confirmation.html.twig') ?>
<form action="<?= Yii::app()->createUrl('symfony/admin/post/delete', ['id' => $post->id]) ?>" method="post" data-confirmation="true" id="delete-form">
	<input type="hidden" name="token" value="<?= $csrf ?>" />
	<button type="submit" class="btn btn-lg btn-block btn-danger">
		<i class="fa fa-trash" aria-hidden="true"></i>
		<?= Yii::t('messages', 'action.delete_post') ?>
	</button>
</form>
