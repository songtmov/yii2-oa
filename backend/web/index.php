<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

date_default_timezone_set('PRC');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/phpoffice/phpexcel/Classes/PHPExcel.php');
require(__DIR__ . '/../../mytool/vardump.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

// error_reporting(E_ERROR); ini_set('display_errors', 'yes');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);

(new yii\web\Application($config))->run();