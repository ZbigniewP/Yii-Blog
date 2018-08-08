<?php
/* @var $this SecurityController */
?>

<div class="page-header">
	<h1><?= Yii::t('messages', 'title.homepage') ?></h1>
</div>

<div class="row"><div class="container">
	<div class="col-sm-6 span-12">
		<div class="jumbotron">
			<p>
				<?= Yii::t('messages', 'help.browse_app') ?>
			</p>
			<p>
				<a class="btn btn-primary btn-lg" href="/symfony/blog">
					<i class="fa fa-users" aria-hidden="true"></i> <?= Yii::t('messages', 'action.browse_app') ?> Symfony
				</a>
			</p>
			<p>
				<a class="btn btn-primary btn-lg" href="/symfony/yiipost">
					<i class="fa fa-users" aria-hidden="true"></i> <?= Yii::t('messages', 'action.browse_app') ?> Yii
				</a>
			</p>
		</div>
	</div>

	<div class="col-sm-6 span-12 last">
		<div class="jumbotron">
			<p>
				<?= Yii::t('messages', 'help.browse_admin') ?>
			</p>
			<p>
				<a class="btn btn-primary btn-lg" href="/symfony/admin/login">
					<i class="fa fa-lock" aria-hidden="true"></i> <?= Yii::t('messages', 'action.browse_admin') ?> Symfony
				</a>
			</p>
			<p>
				<a class="btn btn-primary btn-lg" href="/symfony/post/admin">
					<i class="fa fa-lock" aria-hidden="true"></i> <?= Yii::t('messages', 'action.browse_admin') ?> Yii
				</a>
			</p>
		</div>
	</div>
</div></div>