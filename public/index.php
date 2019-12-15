<?php

declare(strict_types=1);

use TrackMe\App;
use TrackMe\Infrastructure\Http\Request;

require __DIR__.'/../vendor/autoload.php';

$app = new App();
$response = $app->handle(Request::createFromGlobals());
echo $response;
