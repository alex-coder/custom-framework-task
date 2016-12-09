<?php


    namespace Core\View;


    class TemplateEngine
    {
        /** @var string */
        private static $extention = 'html.php';

        /** @var array */
        private $data = [];

        /** @var string */
        private $file;

        /**
         * Sample TemplateEngine
         *
         * @param string $file
         * @param array  $data
         */
        public function __construct($file, array $data = [])
        {
            $this->data = $data;
            $this->file = $file . '.' . static::$extention;
        }

        /**
         * Returns a variable
         *
         * @param string $key
         *
         * @return mixed
         */
        public function __get($key)
        {
            return array_key_exists($key, $this->data) ? $this->data[ $key ] : null;
        }

        /**
         * Render the given template
         * @return string
         */
        public function render()
        {
            ob_start();

            require_once $this->file;

            $rendered = ob_get_contents();
            ob_clean();

            return $rendered;
        }
    }