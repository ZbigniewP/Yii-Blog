<h1>Add post</h1>
<?php
// echo "<pre>";
// print_r($posts);
// echo "</pre>";
// exit();
?>
<p><?= CHtml::link('< Back to posts', ['admincake/index']) ?></p>

<?php $form = $this->beginWidget('CActiveForm')?>
<div class="row">
	<div class="col-md-6 span-12">
		<?= $form->labelEx($posts, 'name', ['label'=>'Name :']) ?>
		<?= $form->textField($posts, 'name', ['class' => 'form-control']) ?>
	</div>
	<div class="col-md-6 span-12">
		<?= $form->labelEx($posts, 'slug', ['label'=>'Slug :']) ?>
		<?= $form->textField($posts, 'slug', ['class' => 'form-control']) ?>
	</div>
	<!-- <div class="col-md-6 span-12">
		<?= $form->labelEx($posts, 'tags', ['label'=>'Tags :']) ?>
		<?php
		//  $form->textField($posts, 'tags', ['class' => 'form-control'])
		?>
	</div> -->
</div>
<div class="row">
	<div class="col-md-6 span-12">
		<?= $form->labelEx($posts, 'category_id', ['label'=>'Category :']) ?>
		<?= $form->textField($posts, 'category_id', ['class' => 'form-control']) ?>
	</div>
	<!-- <div class="col-md-6 span-12">
		<?= $form->labelEx($posts, 'status', ['label'=>'Status :']) ?>
		<?= $form->textField($posts, 'status', ['class' => 'form-control']) ?>
	</div> -->
	<div class="col-md-6 span-12">
		<?= $form->labelEx($posts, 'user_id', ['label'=>'Author :']) ?>
		<?= $form->textField($posts, 'user_id', ['class' => 'form-control']) ?>
	</div>
	<!-- <div class="col-md-6 span-12">
		<?= $form->labelEx($posts, 'username', ['label'=>'Author :']) ?>
		<?php
		//  $form->textField($posts, 'username', ['class' => 'form-control'])
		?>
	</div> -->
</div>
<?= $form->labelEx($posts, 'content', ['label'=>'Content :']) ?>
<?= CHtml::activeTextArea($posts, 'content', ['class' => 'form-control']) ?>
<div class="submit">
	<input class="btn btn-primary" type="submit" value="Submit">
</div>
<?php $this->endWidget()?>