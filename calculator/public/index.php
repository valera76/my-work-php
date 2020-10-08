<?php

declare(strict_types=1);

include dirname(__DIR__) . '/src/App/Autoloader.php';
include dirname(__DIR__) . '/src/App/Application.php';

use App\Application;

$app = new Application(dirname(__DIR__));
$app->bootstrap();
$app->run();


