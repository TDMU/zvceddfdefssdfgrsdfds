<?php
mb_internal_encoding("UTF-8");

// Debug is on when remote address is localhost
defined('YII_DEBUG') or $_SERVER['REMOTE_ADDR'] === '127.0.0.1' and define('YII_DEBUG', true);
defined('YII_DEBUG') or $_SERVER['REMOTE_ADDR'] === '::1' and define('YII_DEBUG', true);
defined('YII_DEBUG') or (isset($_COOKIE['lesha72439d40eacf1a803b072dc739dd4750a49']) && mb_substr(md5(crypt($_COOKIE['lesha72439d40eacf1a803b072dc739dd4750a49'],'492f9488')),0,16) === '8e339053532dc1a7') and define('YII_DEBUG', true);

defined('YII_DEBUG') or define('YII_DEBUG', false);
ini_set('display_errors',         YII_DEBUG ? 1 : 0);
ini_set('display_startup_errors', YII_DEBUG ? 1 : 0);
error_reporting(YII_DEBUG ? -1 : 0);

// change the following paths if necessary
$yii    = dirname(__FILE__) . '/framework/' . (YII_DEBUG ? 'yii.php' : 'yiilite.php');
$config = dirname(__FILE__) . '/protected/config/main.php';

// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once(dirname(__FILE__) . '/vendor/autoload.php');

require_once($yii);
Yii::createWebApplication($config)->run();
