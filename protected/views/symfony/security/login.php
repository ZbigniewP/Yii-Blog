<?php
/* @var $this SecurityController */

// $this->breadcrumbs = ['Security'];

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// ${exit();}
// 'ajax'=true;
?>
<style>
.well p,.well .rememberMe {display:none;}
.hint {display:none;}
</style>
<div class="row"><div class="container">
	<div class="col-sm-5 span-9">
		<div class="well">
			<?php $this->renderPartial('/site/login', ['model' => $model]) ?>
		</div>
	</div>

	<div id="login-help" class="col-sm-7 span-14 last">
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
</div></div>