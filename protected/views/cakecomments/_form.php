<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	'enableAjaxValidation'=>true,
))?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?= $form->labelEx($model,'username')?>
		<?= $form->textField($model,'username',array('size'=>60,'maxlength'=>128))?>
		<?= $form->error($model,'username')?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'mail')?>
		<?= $form->textField($model,'mail',array('size'=>60,'maxlength'=>128))?>
		<?= $form->error($model,'mail')?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'url')?>
		<?= $form->textField($model,'url',array('size'=>60,'maxlength'=>128))?>
		<?= $form->error($model,'url')?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'content')?>
		<?= $form->textArea($model,'content',array('rows'=>6, 'cols'=>50))?>
		<?= $form->error($model,'content')?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save')?>
	</div>

<?php $this->endWidget()?>

</div><!-- form -->