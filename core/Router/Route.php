<?php


    namespace Core\Router;


    class Route
    {
        /** @var string */
        private $controller;

        /** @var string */
        private $action;

        /** @var string */
        private $path;

        /**
         * Route constructor.
         *
         * @param string $method
         * @param string $path
         * @param string $actionString
         */
        public function __construct($method, $path, $actionString)
        {
            list($controller, $action) = explode('#', $actionString);
            $this->controller = $controller;
            $this->action     = $action;
            $this->path       = new RoutePath($method, $path);
        }

        /**
         * Returns controller class name
         * @return string
         */
        public function getControllerClass()
        {
            $name = ucfirst($this->controller);

            return "App\\Controllers\\{$name}Controller";
        }

        /**
         * Returns controller's action name
         * @return string
         */
        public function getAction()
        {
            return $this->action;
        }

        /**
         * Returns path object
         * @return RoutePath
         */
        public function getPath()
        {
            return $this->path;
        }
    }