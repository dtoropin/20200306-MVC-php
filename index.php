<?php

require_once 'vendor/autoload.php';
require_once 'Base/config.php';

require_once 'database/migrations.php';

session_start();

$route = new \Base\Routes();
try {
    $route->start();
} catch (Exception $e) {
    \Base\Error404::Error();
}