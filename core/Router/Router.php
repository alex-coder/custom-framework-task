<?php


    namespace Core\Router;


    use Core\Http\Request;
    use Core\Http\Response;
    use Core\Http\ResponseFactory;

    class Router
    {
        const METHOD_GET    = 'GET';
        const METHOD_POST   = 'POST';
        const METHOD_PUT    = 'PUT';
        const METHOD_DELETE = 'DELETE';

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
         * Bind PUT request
         *
         * @param string $path
         * @param string $actionString
         */
        public function put($path, $actionString)
        {
            $this->bind(static::METHOD_PUT, $path, $actionString);
        }

        /**
         * Bind DELETE request
         *
         * @param string $path
         * @param string $actionString
         */
        public function delete($path, $actionString)
        {
            $this->bind(static::METHOD_DELETE, $path, $actionString);
        }

        /**
         * Start router
         *
         * @param Request $request
         */
        public function start(Request $request)
        {
            $response = null;
            foreach ($this->routes as $route) {
                if ($route->getPath()->match($request)) {
                    $class  = $route->getControllerClass();
                    $action = $route->getAction();
                    $params = $route->getPath()->getRouteParams();

                    $response = call_user_func_array([new $class($request), $action], $params);

                    break;
                }
            }
            if (!$response) {
                $response = ResponseFactory::notFound();
            }

            $this->sendResponse($response);
        }

        /**
         * Send response to client
         *
         * @param Response $response
         *
         * @void
         */
        private function sendResponse(Response $response)
        {
            http_response_code($response->getCode());

            foreach ($response->getHeaders() as $key => $value) {
                header("{$key}: {$value}");
            }

            print $response->getView()->render();
        }
    }