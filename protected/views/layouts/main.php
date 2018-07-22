<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?= CHtml::encode($this->pageTitle)?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?= CHtml::encode(Yii::app()->name)?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu', array(
			'items' => array(
				array('label' => 'Yii', 'url' => array('post/index')),
				array('label' => 'Cake', 'url' => array('cakeposts/index')),
				array('label' => 'Cake2', 'url' => array('postcake/index')),
				array('label' => 'Symfony', 'url' => array('demopost/index')),
				array('label' => 'About', 'url' => array('site/page', 'view' => 'about')),
				array('label' => 'Contact', 'url' => array('site/contact')),
				array('label' => 'Login', 'url' => array('site/login'), 'visible' => Yii::app()->user->isGuest),
				array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('site/logout'), 'visible' => !Yii::app()->user->isGuest)
			),
		))?>
	</div><!-- mainmenu -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', ['links' => $this->breadcrumbs]) ?><!-- breadcrumbs -->

	<?= $content; ?>

	<div id="footer">
		Copyright &copy; <?= date('Y') ?> by My Company.<br />
		All Rights Reserved.<br />
		<?= Yii::powered() ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>