<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Kareylo">

		<title>Blog | Admin panel</title>

		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/bootstrap-theme.min.css" />
		<style>
			body {padding-top: 50px;}
			.sidebar {margin-top: 50px;}
		</style>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<?= CHtml::link('Blog', ['controller' => 'Admin'], ['class' => 'navbar-brand']) ?>
				</div>
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<li><?= CHtml::link('Cake', '/cakeposts/index') ?></li>
						<li class="active"><?= CHtml::link('Cake2', '/postcake/index') ?></li>
						<li><?= CHtml::link('Symfony', '//symfony/post/index') ?></li>
						<li><?= CHtml::link('Yii', '/post/index') ?></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><?= CHtml::link('Back to front', '/') ?></li>
						<li><?= CHtml::link('About', '/site/page?view=about') ?></li>
						<li><?= CHtml::link('Contact', '/site/contact') ?></li>
						<li><?= CHtml::link('Logout', ['controller' => 'Users', 'action' => 'logout']) ?></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="container">
			<?php
			// $this->Flash->render(); 
			?>
			<?= $content; ?>
		</div>
	</body>
</html>
