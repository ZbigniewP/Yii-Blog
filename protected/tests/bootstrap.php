<?php

// change the following paths if necessary
$yiit='C:/FrameWorks/YII/yii-1.1.20/yiisoft/yii/framework/yiit.php';
$config=dirname(dirname(__FILE__)).'/config/test.php';

require_once($yiit);
require_once(dirname(__FILE__).'/WebTestCase.php');

Yii::createWebApplication($config);
