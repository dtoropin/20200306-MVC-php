<?php

require_once 'vendor/autoload.php';
require_once 'Base/config.php';

\Base\Fake::fakeData();

session_start();

$route = new \Base\Routes();
$route->start();