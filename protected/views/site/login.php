<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = CMap::mergeArray(['Login'],$this->breadcrumbs);
?>

<h3><i class="fa fa-lock" aria-hidden="true"></i> <?= Yii::t('messages', 'title.login') ?></h3>

<p>Please fill out the following form with your login credentials:</p>

<div class="form">
<?php $form = $this->beginWidget('CActiveForm', [
	'id' => 'login-form',
	'enableAjaxValidation' => true,
]) ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?= $form->labelEx($model, 'username') ?>
		<?= $form->textField($model, 'username') ?>
		<?= $form->error($model, 'username') ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model, 'password') ?>
		<?= $form->passwordField($model, 'password') ?>
		<?= $form->error($model, 'password') ?>
		<p class="hint">
			Hint: You may login with <tt>demo/demo</tt>.
		</p>
	</div>

	<div class="row rememberMe">
		<?= $form->checkBox($model, 'rememberMe') ?>
		<?= $form->label($model, 'rememberMe') ?>
		<?= $form->error($model, 'rememberMe') ?>
	</div>

	<div class="row submit">
		<?= CHtml::submitButton(Yii::t('messages', 'action.sign_in')) ?>
	</div>

<?php $this->endWidget() ?>
</div><!-- form -->