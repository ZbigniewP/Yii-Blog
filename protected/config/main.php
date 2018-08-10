<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'Yii Blog Demo',

	// preloading 'log' component
	'preload' => array('log'),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
	),
	// 'modules' => array(
	// 	'gii' => array(
	// 		'class' => 'system.gii.GiiModule',
	// 		'password' => 'enter',
	// 		## If removed, Gii defaults to localhost only. Edit carefully to taste.
	// 		'ipFilters' => array('127.0.0.1', '::1'),
	// 	),
	// ),

	'defaultController'=>'post',
	// 'defaultController'=>'cakeposts',

	// application components
	'components' => array(
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
		),
		'db' => array(
			'connectionString' => 'sqlite:protected/data/blog.db',
			'connectionString' => 'sqlite:' . dirname(dirname(__FILE__)) . '/data/blog_yii.sqlite',
			'tablePrefix' => 'tbl_',
		),
		'db_symfony' => array(
			'class' => 'CDbConnection',
			'connectionString' => 'sqlite:' . dirname(dirname(__FILE__)) . '/data/blog_symfony.sqlite',
			'tablePrefix' => 'symfony_',
		),
		'db_cake' => array(
			'class' => 'CDbConnection',
			'connectionString' => 'sqlite:' . dirname(dirname(__FILE__)) . '/data/blog_cake.sqlite',
		),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=blog',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
		*/
		// 'errorHandler' => array(
		// 	// use 'site/error' action to display errors
		// 	'errorAction' => 'site/error',
		// ),
		'urlManager' => array(
			'urlFormat' => 'path',
			'rules' => array(
				'post/<id:\d+>/<title:.*?' . '>' => 'post/view',
				'posts/<tag:.*?' . '>' => 'post/index',

				// 'symfony/yiipost/<id:\d+>/<title:.*?' . '>' => 'symfony/yiipost/view',
				// 'symfony/yiipost/<tag:.*?' . '>' => 'symfony/yiipost/index',

				// 'cakeposts/<id:\d+>/<title:.*?' . '>' => 'cakeposts/view',
				// 'category/<tag:.*?' . '>' => 'cakeposts/index',

				'symfony' => 'symfony/security/index',//'symfony/blog/index',
				// 'symfony/blog/<lang:\w+>' => 'symfony/blog/index',//'symfony/blog/index',
				'symfony/admin/<action:\w+>' => 'symfony/security/<action>',
				'symfony/admin/post/<action:\w+>' => 'symfony/admin/blog/<action>',
				// 'symfony/page/{page<[1-9]\d*>}' => 'symfony/blog/index/paginated',
				// 'symfony/post/<action:\w+>' => 'symfony/blog/<action:\w+>',
				'symfony/rss.xml' => 'symfony/blog/rss',
				'symfony/blog/show/<slug:.*?' . '>' => 'symfony/blog/show',

				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				// '<controller:\w+>/<action:\w+>/<lang:\w+>' => '<controller>/<action>'
			),
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class' => 'CWebLogRoute',
					'levels' => 'error, warning',
				),
			),
		),
		'messages' => array(
			'forceTranslation' => true,
		),
		'format' => array(
			'class' => 'CLocalizedFormatter',
			// 'dateFormat' => 'long',//'full', 'long', 'medium', 'short'
			// 'timeFormat' => 'short',
		),
		// 'viewRenderer' => array(
		// 	'class' => 'CPradoViewRenderer',
		// ),
		// // composer require "twig/twig:^2.0"
		// 'viewRenderer'=>array(
		// 	'class'=>'ext.yiiext.renderers.twig.ETwigViewRenderer',
		// 	'fileExtension' => '.html',
		// 	'options' => array(
		// 		'autoescape' => true,
		// 	),
		// 	'extentions' => array(
		// 	   'My_Twig_Extension',
		// 	),
		// ),
	),
// CApplication::getLanguage
// CMissingTranslationEvent::message
	// 'sourceLanguage' => 'en',
	// 'language' => 'pl',
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);