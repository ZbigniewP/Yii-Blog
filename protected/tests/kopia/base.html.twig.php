<?php
// {#
//    This is the base template used as the application layout which contains the
//    common elements and decorates all the other templates.
//    See https://symfony.com/doc/current/book/templating.html#template-inheritance-and-layouts
// #}
function locales()
{
	return [];
}
//'full', 'long', 'medium', 'short'
// Yii::app()->format->dateFormat = 'full';
// Yii::app()->format->timeFormat = 'full';
// Yii::app()->language = 'pl';
$body_id = strtolower(str_replace('/','-',trim($this->id,'symfony/')).'-'.$this->action->id).PHP_EOL;
?>
<!DOCTYPE html>
<html lang="<?=Yii::app()->getLanguage();?>">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<title>Symfony Demo application</title>
		<link rel="alternate" type="application/rss+xml" title="<?= Yii::t('messages', 'rss.title') ?>" href="<?= Yii::app()->createUrl('symfony/post/rss') ?>">
		<!-- {% block stylesheets %} -->
			<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/build/css/app.css" />
		<!-- {% endblock %} -->

		<link rel="icon" type="image/x-icon" href="<?= Yii::app()->request->baseUrl; ?>/build/favicon.ico" />
	</head>

	<body id="<?= $body_id ?>">
		<!-- {% block header %} -->
		<header>
			<div class="navbar navbar-default navbar-static-top" role="navigation">
				<div class="container">
					<div class="navbar-header col-md-3 col-lg-2">
						<?= CHtml::link('<i class="fa fa-home" aria-hidden="true"></i> '.Yii::t('zii', 'Home'), '//symfony', ['class' => 'navbar-brand', 'title'=>'Symfony Demo']) ?>
						<button type="button" class="navbar-toggle"
								data-toggle="collapse"
								data-target=".navbar-collapse">
							<span class="sr-only"><?= Yii::t('messages', 'menu.toggle_nav')?></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
<li><?= CHtml::link('Cake', '/cakeposts/index') ?></li>
<li><?= CHtml::link('Cake2', '/postcake/index') ?></li>
<li class="active"><?= CHtml::link('Symfony', '/symfony') ?></li>
<li><?= CHtml::link('Yii', '/post/index') ?></li>
</ul><ul class="nav navbar-nav navbar-right">
						<?php if (Yii::app()->user->isGuest): ?>
								<li>
									<a href="<?= Yii::app()->createUrl('symfony/admin/post/index') ?>">
										<i class="fa fa-lock" aria-hidden="true"></i> <?= Yii::t('messages', 'menu.admin')?></a>
								</li>
						<?php else: ?>
							<li>
								<a href="<?= Yii::app()->createUrl('symfony/admin/logout') ?>">
									<i class="fa fa-sign-out" aria-hidden="true"></i> <?= Yii::t('messages', 'menu.logout') ?></a>
							</li>
						<?php endif; ?>
							<li>
								<a href="<?= Yii::app()->createUrl('symfony/post/search') ?>"> <i class="fa fa-search"></i> <?= Yii::t('messages', 'menu.search')?></a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" id="locales">
									<i class="fa fa-globe" aria-hidden="true"></i>
									<span class="caret"></span>
									<span class="sr-only"><?= Yii::t('messages', 'menu.choose_language')?></span>
								</a>
								<ul class="dropdown-menu locales" role="menu" aria-labelledby="locales">
								<?php foreach(locales() as $locale ): ?>
									<li <?php if (Yii::app()->getLanguage() == $locale->code): ?>aria-checked="true" class="active"<?php else: ?>aria-checked="false"<?php endif ?> role="menuitem">
										<a href="<?= Yii::app()->createUrl('blog.index') ?>
										{{ path(app.request.get('_route', 'blog.index'), app.request.get('_route_params', [])|merge({_locale: locale.code})) }}">
										{{ $locale->name|capitalize }}</a></li>
								<?php endforeach; ?>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</header>
		<!-- {% endblock %} -->

		<div class="container body-container">
			<!-- {% block body %} -->
				<div class="row">
					<div id="main" class="col-sm-9">
						<?= $this->id . '/' . $this->action->id; ?>
						<?php
						// $this->renderPartial('//default/_flash_messages.html.twig') 
						?>
						{{ include('default/_flash_messages.html.twig
						<!-- {% block main %}{% endblock %} -->
						<?= $content; ?>
					</div>

					<div id="sidebar" class="col-sm-3">
					<?= $this->renderPartial('//blog/about.html.twig')?>
					<!-- {% block sidebar %} -->
						{{ render_esi(controller('FrameworkBundle:Template:template', {
							'template': 'blog/about.html.twig',
							'sharedAge': 600,
							'_locale': <?= Yii::app()->getLanguage() ?>app.request.locale
						})) }}
					<!-- {% endblock %} -->
<!-- <?= Yii::t('zii','Home')?><br />
<?= CHtml::link('<i class="fa fa-home" aria-hidden="true"></i> '. Yii::t('messages', 'menu.homepage'), Yii::app()->homeUrl); ?><br />
<?= strftime('%#c', time()) ?><br />
<?= strftime('%#x', time()) ?><br />
<?= strftime('%c', time()) ?><br />
<?= strftime('%x %X', time()) ?><br />
<?= Yii::app()->format->datetime(time()) ?><br />
<?= Yii::app()->getLanguage()?><br />
<?= Yii::app()->homeUrl ?><br />
<?= Yii::t('messages', 'menu.search',['pl'],'pl','pl')?><br /> -->

					</div>
				</div>
			<!-- {% endblock %} -->
		</div>

		<!-- {% block footer %} -->
		<footer>
			<div class="container">
				<div class="row">
					<div id="footer-copyright" class="col-md-6">
						<p>&copy; <?= date('Y') ?> - The Symfony Project</p>
						<p><?= Yii::t('messages', 'mit_license') ?></p>
					</div>
					<div id="footer-resources" class="col-md-6">
						<p>
							<a href="https://twitter.com/symfony" title="Symfony Twitter">
								<i class="fa fa-twitter" aria-hidden="true"></i>
							</a>
							<a href="https://www.facebook.com/SensioLabs" title="SensioLabs Facebook">
								<i class="fa fa-facebook" aria-hidden="true"></i>
							</a>
							<a href="https://symfony.com/blog/" title="Symfony Blog">
								<i class="fa fa-rss" aria-hidden="true"></i>
							</a>
						</p>
					</div>
				</div>
			</div>
		</footer>
		<!-- {% endblock %} -->

		<!-- {% block javascripts %} -->
		<script src="/build/manifest.js"></script>
		<script src="/build/js/common.js"></script>
		<script src="/build/js/app.js"></script>
		<!-- {% endblock %} -->
<?php
Yii::app()->format->dateFormat = 'long';
Yii::app()->format->timeFormat = 'full';
?>
		<!-- {# it's not mandatory to set the timezone in localizeddate(). This is done to
		   avoid errors when the 'intl' PHP extension is not available and the application
		   is forced to use the limited "intl polyfill", which only supports UTC and GMT #} -->
		<!-- Page rendered on <?= Yii::app()->format->datetime(time()) ?> -->
	</body>
</html>
