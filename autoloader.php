<?php

    class Autoloader
    {
        /** @var array */
        private $prefixes = [];

        /**
         * Register autoload
         * @void
         */
        public function register()
        {
            spl_autoload_register([$this, 'load']);
        }

        /**
         * Adding a new namespace prefix
         *
         * @param string $prefix
         * @param string $baseDir
         *
         * @void
         */
        public function addNamespace($prefix, $baseDir)
        {
            $prefix  = trim($prefix, '\\');
            $baseDir = trim($baseDir, DIRECTORY_SEPARATOR);

            $this->prefixes[ $prefix ] = $baseDir;
        }

        /**
         * Loading file by class
         *
         * @param string $className
         *
         * @void
         */
        public function load($className)
        {
            $parts = explode('\\', $className);

            if (array_key_exists($parts[0], $this->prefixes)) {
                $parts[0] = $this->prefixes[ $parts[0] ];
            }

            $file = __DIR__ . '/' . implode(DIRECTORY_SEPARATOR, $parts) . '.php';
            $this->requireFile($file);
        }

        /**
         * Require file by uri
         *
         * @param string $file
         *
         * @void
         * @throws ErrorException
         */
        private function requireFile($file)
        {
            if (is_readable($file)) {
                require_once $file;
            } else {
                throw new ErrorException("File {$file} is not readable");
            }
        }
    }