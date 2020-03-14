<?php

require_once 'vendor/autoload.php';
require_once 'Base/config.php';

$migration = new \Base\Migrations();
$migration->start();

\Base\Fake::fakeData();

session_start();

$route = new \Base\Routes();
try {
    $route->start();
} catch (Exception $e) {
    \Base\Error404::Error();
}