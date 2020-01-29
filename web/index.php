<?php

require __DIR__ . '/../.config.php';

/* 
    prod: production environment. The constant YII_ENV_PROD will evaluate as true. This is the default value of YII_ENV if you do not define it.
    dev: development environment. The constant YII_ENV_DEV will evaluate as true.
    test: testing environment. The constant YII_ENV_TEST will evaluate as true.
*/
defined('YII_DEBUG') or define('YII_DEBUG', \cf\config::YII_DEBUG);
defined('YII_ENV') or define('YII_ENV', \cf\config::YII_ENV);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
