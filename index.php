<?php

define('EXECUTION_ALLOWED', true);

require __DIR__.'/vendor/autoload.php';

use Bramus\Router\Router;

$router = new Router();

$router->get('/', function () {
    respond_with_template('home', ['name' => 'VPZ']);
});

$router->post('migrate', function () {
    $migrated = migrate_database();

    respond_with_json(['migrations' => $migrated]);
});

$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');

    $arr['status'] = 404;
    $arr['status_text'] = 'no matching route found';

    respond_with_json($arr);
});

$router->run();
