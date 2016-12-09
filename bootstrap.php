<?php

    require_once __DIR__ . '/autoloader.php';
    require_once __DIR__ . '/helpers.php';

    $loader = new Autoloader();
    $loader->register();

    $loader->addNamespace('App\\', 'app/');
    $loader->addNamespace('Core\\', 'core/');


