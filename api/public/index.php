<?php

require_once __DIR__.'/vendor/autoload.php';

$app = new Silex\Application();

require __DIR__ . '/config/development.php';

require __DIR__ . '/src/application.php';

$app->run();
