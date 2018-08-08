<!-- {% extends 'base.html.twig' %} -->
<!-- {% block body_id 'login' %} -->

<!-- {% block javascripts %} -->
	<!-- {{ parent() }} -->
	<script src="/build/js/login.js"></script>
<!-- {% endblock %} -->

<!-- {% block main %} -->
	<!-- {% if error %} -->
		<div class="alert alert-danger">
			{{ error.messageKey|trans(error.messageData, 'security') }}
		</div>
	<!-- {% endif %} -->
	<div class="row">
		<div class="col-sm-5">
			<div class="well">
				<?php 
				$form = $this->beginWidget('CActiveForm', [
					'id' => 'login-form',
					'enableAjaxValidation' => true,
					// 'error' => ['header' => '<div class="alert alert-danger">', 'footer' => '</div>'],
				]);
				// $form->errorSummaryHeader => '<div class="alert alert-danger">';
				// $form->errorSummaryFFooter => '</div>';
				// echo $form->errorSummary($model);
				?>
					<fieldset>
						<legend><i class="fa fa-lock" aria-hidden="true"></i> <?= Yii::t('messages', 'title.login') ?></legend>
						<div class="form-group">
							<?= $form->labelEx($model, 'username') ?>
							<?= $form->textField($model, 'username',['class'=>'form-control']) ?>
						</div>
						<div class="form-group">
							<?= $form->labelEx($model, 'password') ?>
							<?= $form->textField($model, 'password',['class'=>'form-control']) ?>
						</div>
						<?= CHtml::htmlButton('<i class="fa fa-sign-in" aria-hidden="true"></i> ' . Yii::t('messages', 'action.sign_in'),
							['class' => 'btn btn-primary', 'type' => 'submit']) ?>
					</fieldset>
				<?php $this->endWidget() ?><!-- </form> -->
			</div>
		</div>
		<div id="login-help" class="col-sm-7">
			<h3>
				<i class="fa fa-long-arrow-left" aria-hidden="true"></i>
				<?= Yii::t('messages', 'help.login_users') ?>
			</h3>
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th scope="col"><?= Yii::t('messages', 'label.username') ?></th>
						<th scope="col"><?= Yii::t('messages', 'label.password') ?></th>
						<th scope="col"><?= Yii::t('messages', 'label.role') ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>john_user</td>
						<td>kitten</td>
						<td><code>ROLE_USER</code> (<?= Yii::t('messages', 'help.role_user') ?>)</td>
					</tr>
					<tr>
						<td>jane_admin</td>
						<td>kitten</td>
						<td><code>ROLE_ADMIN</code> (<?= Yii::t('messages', 'help.role_admin') ?>)</td>
					</tr>
				</tbody>
			</table>
			<div id="login-users-help" class="panel panel-default">
				<div class="panel-body">
					<p>
						<span class="label label-success"><?= Yii::t('messages', 'note') ?></span>
						<?= Yii::t('messages', 'help.reload_fixtures') ?><br/>
						<code class="console">$ php bin/console doctrine:fixtures:load</code>
					</p>
					<p>
						<span class="label label-success"><?= Yii::t('messages', 'tip') ?></span>
						<?= Yii::t('messages', 'help.add_user') ?><br/>
						<code class="console">$ php bin/console app:add-user</code>
					</p>
				</div>
			</div>
		</div>
	</div>
<!-- {% endblock %} -->

<!-- {% block sidebar %} -->
	<!-- {{ parent() }} -->
	<!-- {{ show_source_code(_self) }} -->
<!-- {% endblock %} -->
