<?php

require __DIR__ . '/protected/vendor/autoload.php';

// Change the following paths if necessary
$yii = dirname(__FILE__) . '/protected/yii/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

// Remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);

// Specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
Yii::createWebApplication($config)->run();
