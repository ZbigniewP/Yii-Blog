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
		<?php 
		$this->widget('zii.widgets.CMenu', ['items' => [
				['label' => 'Yii', 'url' => ['post/index']],
				['label' => 'Cake', 'url' => ['cakeposts/index']],
				['label' => 'Cake2', 'url' => ['postcake/index']],

				['label' => 'Symfony', 'url' => ['//symfony']],
// array('label'=>'Products', 'url'=>array('product/index'), 
// 'items'=>array(
// array('label'=>'New Arrivals', 'url'=>array('product/new', 'tag'=>'new')),
// array('label'=>'Most Popular', 'url'=>array('product/index', 'tag'=>'popular')),
// )),
				['label' => 'About', 'url' => ['site/page', 'view' => 'about']],
				['label' => 'Contact', 'url' => ['site/contact']],

				['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::app()->user->isGuest],
				['label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => ['site/logout'], 'visible' => !Yii::app()->user->isGuest],

				['label' => Yii::t('messages', 'action.sign_in'), 'url' => ['symfony/admin/login'], 'visible' => Yii::app()->user->isGuest],
				['label' => Yii::t('messages', 'menu.logout').' (' . Yii::app()->user->name . ')', 'url' => ['symfony/admin/logout'], 'visible' => !Yii::app()->user->isGuest],
		]]);
		?>
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