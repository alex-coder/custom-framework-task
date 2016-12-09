<?php
    use Core\Http\Request;

    require_once dirname(__DIR__) . '/bootstrap.php';

    $router = require_once app_path('routes.php');

    $router->start(Request::build());
