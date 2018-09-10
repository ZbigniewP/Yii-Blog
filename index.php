<?php
## change the following paths if necessary
$yii = 'C:/FrameWorks/YII/yii-1.1.20/yiisoft/yii/framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

## remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);

require_once($yii);
Yii::createWebApplication($config)->run();
