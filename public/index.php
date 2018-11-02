<?php

use TrackMe\Component\Http\Request;

require __DIR__.'/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__.'/..');
$dotenv->load();

$app = new \TrackMe\App();
$response = $app->handle(Request::createFromGlobals());
echo $response;
