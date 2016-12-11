<?php
    use Core\Http\Request;

    require_once __DIR__ . '/bootstrap.php';

    $router = require_once app_path('routes.php');

    $router->start(Request::build());
