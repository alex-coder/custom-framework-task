<?php


    namespace Core\Router;


    use Core\Http\Request;

    class Router
    {
        const METHOD_GET  = 'GET';
        const METHOD_POST = 'POST';
        /** @var Route[] */
        private $routes = [];

        /**
         * Bind new request
         *
         * @param string $method
         * @param string $path
         * @param string $actionString
         */
        public function bind($method, $path, $actionString)
        {
            $this->routes[] = new Route($method, $path, $actionString);
        }

        /**
         * Bind GET request
         *
         * @param string $path
         * @param string $actionString
         */
        public function get($path, $actionString)
        {
            $this->bind(static::METHOD_GET, $path, $actionString);
        }

        /**
         * Bind POST request
         *
         * @param string $path
         * @param string $actionString
         */
        public function post($path, $actionString)
        {
            $this->bind(static::METHOD_POST, $path, $actionString);
        }

        /**
         * Start router
         *
         * @param Request $request
         */
        public function start(Request $request)
        {
            foreach ($this->routes as $route) {
                if ($route->getPath()->match($request)) {
                    $class  = $route->getControllerClass();
                    $action = $route->getAction();

                    $controller = new $class($request);
                    $result     = call_user_func_array([$controller, $action], []);
                    var_export($result);

                    return;
                }
            }

            echo "404";
        }
    }