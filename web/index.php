<?php


require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../enviroment/env.php';
require __DIR__ . '/Yii.php';
require __DIR__ . '/../config/bootstrap.php';
$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
