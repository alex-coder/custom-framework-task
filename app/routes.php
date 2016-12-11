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

    $router->get('/', 'reviews#index');
    $router->post('/', 'reviews#create');

    $router->get('/admin', 'admin#index');
    $router->get('/admin/approve/{id}', 'admin#approve');
    $router->get('/admin/decline/{id}', 'admin#decline');
    $router->get('/admin/{id}', 'admin#edit');
    $router->post('/admin/{id}', 'admin#save');

    $router->get('/login', 'login#index');
    $router->post('/login', 'login#login');

    return $router;

