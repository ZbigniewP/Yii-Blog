<?php
// use Cake\Cache\Cache;
// use Cake\Core\Configure;
// use Cake\Core\Plugin;
// use Cake\Datasource\ConnectionManager;
// use Cake\Error\Debugger;
// use Cake\Network\Exception\NotFoundException;

// $this->layout = false;

// if (!Configure::read('debug')) :
// 	throw new NotFoundException(
// 		'Please replace src/Template/Pages/home.ctp with your own version or re-enable debug mode.'
// 	);
// endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
// $cs->registerMetaTag($cakeDescription, 'description', null, ['lang' => 'en']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?= CHtml::encode($this->pageTitle)?> | MyDomain.com</title>

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
				<?= CHtml::link('Blog', 'index', ['class' => 'navbar-brand']) ?>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li><?= CHtml::link('Cake', '/cakeposts/index') ?></li>
					<li class="active"><?= CHtml::link('Cake2', '/postcake/index') ?></li>
					<li><?= CHtml::link('Symfony', '/symfony') ?></li>
					<li><?= CHtml::link('Yii', '/post/index') ?></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><?= CHtml::link('About', '/site/page?view=about') ?></li>
					<li><?= CHtml::link('Contact', '/site/contact') ?></li>
				<?php if (!Yii::app()->user->isGuest): 
					// $this->request->session()->read('Auth.User')
					?>
					<li><?= CHtml::link('Admin Yii', '/post/admin') ?></li>
					<li><?= CHtml::link('Admin Cake', '/postcake/admin') ?></li>
				<?php else: ?>
					<li><?= CHtml::link('Login', '/admincake/index') ?></li>
				<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<?php
			// $this->Flash->render() 
			?>
			<?= $content; ?>
<?php 
// if ($this->request->params['action'] !== 'login'):
// if (Yii::app()->user->isGuest):
	// echo $this->cell('Sidebar');
	if ($this->id == 'cakeposts' || $this->id == 'postcake') :
		$this->widget('TopCategories', [
			'maxCategories' => 10,
			'title' => '<h4>Categories</h4>',
			'htmlOptions' => ['class' => 'col-md-4 sidebar'],//['class'=>'portlet']
			'decorationCssClass' => 'list-group',//'portlet-decoration',
			'titleCssClass' => 'list-group-item-heading',//'portlet-title',
			'contentCssClass' => 'list-group-item-text',//'portlet-content',
		]);
		$this->widget('TopPosts', [
			'maxPosts' => 5,
			'title' => '<h4>Last posts</h4>',
			'htmlOptions' => ['class' => 'col-md-4 sidebar', 'style' => 'margin-top: 0;'],
			'decorationCssClass' => 'list-group',
			'titleCssClass' => 'list-group-item-heading',
			'contentCssClass' => 'list-group-item-text',
		]);
	else :
		$this->widget('TagCloud', ['maxTags' => Yii::app()->params['tagCloudCount']]);
		$this->widget('RecentComments', ['maxComments' => Yii::app()->params['recentCommentCount']]);
	endif;
// endif;

// echo "<pre>";
// print_r([
// // CTheme::getViewFile('default.ctp'),
// // CApplication::findLocalizedFile('default.ctp'),
// get_class($this) => $this->getViewPath(), 
// 	// ->getLayoutFile($this,'default.ctp'),
// 	'app' => [
// 		Yii::app()->getTheme(),
// 		Yii::app()->getViewPath(),
// 		Yii::app()->getLayoutPath(),
// 		// Yii::app(),
// 		Yii::app()->request,
// 		Yii::app()->user,
// 	]

// ]);
// echo "</pre>";
// exit();//layouts/

// <div class="col-md-4 span-8 sidebar"><pre>, 'home'
// print_r([$this->request->params['controller']]);
// </pre></div>
// renderHead(&$output)
// renderBodyBegin(&$output)
// renderBodyEnd(&$output)
?>
		</div>
	</div>
	<?= 
	//$this->Html->script(['bootstrap']); 
	CHtml::scriptFile('/js/bootstrap.min.js'); 
	?>
</body>
</html>
