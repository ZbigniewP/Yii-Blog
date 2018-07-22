<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	'enableAjaxValidation'=>true,
))?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username')?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128))?>
		<?php echo $form->error($model,'username')?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mail')?>
		<?php echo $form->textField($model,'mail',array('size'=>60,'maxlength'=>128))?>
		<?php echo $form->error($model,'mail')?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url')?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>128))?>
		<?php echo $form->error($model,'url')?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content')?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50))?>
		<?php echo $form->error($model,'content')?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save')?>
	</div>

<?php $this->endWidget()?>

</div><!-- form -->