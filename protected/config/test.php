<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			'db'=>array(
				// 'connectionString'=>'sqlite:'.dirname(dirname(__FILE__)).'/data/blog-test.db',
				'connectionString' => 'sqlite:'.dirname(dirname(__FILE__)).'/data/blog_test_yii.sdb3',
				'tablePrefix' => 'tbl_',
			),
			'db_symfony'=>array('class' => 'CDbConnection',
				'connectionString' => 'sqlite:'.dirname(dirname(__FILE__)).'/data/blog_test_symfony.sdb3',
				'tablePrefix' => 'symfony_',
			),
			// uncomment the following to use a MySQL database
			/*
			'db'=>array(
				'connectionString' => 'mysql:host=localhost;dbname=blog-test',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8',
			),
			*/
		),
	)
);
