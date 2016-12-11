<?php


    namespace Core\Http;


    class Request
    {
        /** @var string */
        protected $uri;

        /** @var array */
        protected $post = [];

        /** @var array */
        protected $get = [];

        /** @var array */
        protected $files = [];

        /** @var string */
        protected $method;

        /**
         * Build request object from globals
         *
         * @return Request
         */
        public static function build()
        {
            $instance = new static();

            list($uri) = explode('?', $_SERVER['REQUEST_URI']);
            $instance->uri = $uri ?: '/';
            $instance->post = $_POST;
            $instance->get = $_GET;
            $instance->files = $_FILES;
            $instance->method = $_SERVER['REQUEST_METHOD'];

            return $instance;
        }

        /**
         * Returns uri string
         *
         * @return string
         */
        public function getUri()
        {
            return $this->uri;
        }

        /**
         * Returns POST param from request
         *
         * @param string $key
         * @param mixed $default
         *
         * @return mixed
         */
        public function paramPost($key, $default = null)
        {
            return array_key_exists($key, $this->post) ? $this->clean($this->post[ $key ]) : $default;
        }

        /**
         * Clean variable
         *
         * @param mixed $value
         *
         * @return mixed
         */
        protected function clean($value)
        {
            if (is_array($value)) {
                return array_map([$this, 'clean'], $value);
            }

            return trim($value);
        }

        /**
         * Returns GET param from request
         *
         * @param string $key
         * @param mixed $default
         *
         * @return mixed
         */
        public function paramGet($key, $default = null)
        {
            return array_key_exists($key, $this->get) ? $this->clean($this->get[ $key ]) : $default;
        }

        /**
         * Returns file param by key
         *
         * @param string $key
         * @param mixed $default
         *
         * @return mixed
         */
        public function paramFile($key, $default = null)
        {
            return array_key_exists($key, $this->files) && $this->files[ $key ]['size'] > 0 ? $this->files[ $key ] : $default;
        }

        /**
         * Returns HTTP method
         *
         * @return string
         */
        public function getMethod()
        {
            return $this->method;
        }
    }