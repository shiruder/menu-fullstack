<?php

require_once __DIR__ .'/vendor/autoload.php';

$app = require __DIR__ .'/src/application.php';

require __DIR__ . '/config/config.php';

$app->run();
