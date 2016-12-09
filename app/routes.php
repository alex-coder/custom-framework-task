<?php

    use Core\Router\Router;

    $router = new Router();

    /**
     * Create new routes here.
     * Action string is in format: `<controller base name>#<method name>
     * Uri string may have params:
     *      `/user/{id}/info`
     *      `/user/{name}`
     */
    $router->get('/welcome', 'application#index');
    $router->get('/user/{id}/{name}', 'application#index');

    return $router;

