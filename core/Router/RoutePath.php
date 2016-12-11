<?php


    namespace Core\Router;


    use Core\Http\Request;

    class RoutePath
    {
        /** @var string */
        private $method;

        /** @var string */
        private $regexp;

        /** @var array */
        private $params = [];

        /**
         * RoutePath constructor.
         *
         * @param string $method
         * @param string $uri
         */
        public function __construct($method, $uri)
        {
            $this->method = $method;
            $this->parseUri($uri);
        }

        /**
         * Parse uri to url params
         *
         * @param string $uri
         *
         * @void
         */
        private function parseUri($uri)
        {
            $regexp = $uri;
            if (preg_match_all('/\{([^\}]*)\}/', $uri, $matches)) {
                $regexp = str_replace($matches[0], '([^/]+)', $uri);
            }
            $this->regexp = "@^{$regexp}$@";
        }

        /**
         * @param Request $request
         *
         * @return boolean
         */
        public function match(Request $request)
        {
            $method = $request->getMethod();
            $uri    = $request->getUri();

            if ($this->method !== $method || !preg_match_all($this->regexp, $uri, $matches)) {
                return false;
            }

            $this->params = array_map(function ($m) { return $m[0]; }, array_slice($matches, 1));

            return true;
        }

        /**
         * Returns url params
         * @return array
         */
        public function getRouteParams()
        {
            return $this->params;
        }
    }