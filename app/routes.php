<?php

    use Core\Router\Router;

    $router = new Router();

    /**
     * Create new routes here.
     * Action string is in format: `<controller base name>#<method name>
     * Uri string may have params:
     *      `/user/{id}/info`
     *      `/user/{name}`
     * Params will be passed to the method in same order
     */
    $router->get('/user/{id}', 'users#show');

    return $router;

