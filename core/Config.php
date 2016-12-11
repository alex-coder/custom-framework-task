<?php
    namespace Core;


    class Config
    {
        /** @var array */
        protected static $data;

        /**
         * Returns config value or default value
         *
         * @param string $key
         * @param mixed $default
         *
         * @return mixed
         */
        public static function get($key, $default = null)
        {
            $keys = explode('.', $key);

            $last = static::getFileData();
            foreach ($keys as $k) {
                if (array_key_exists($k, $last)) {
                    $last = $last[ $k ];
                } else {
                    return $default;
                }
            }

            return $last;
        }

        /**
         * Returns array config from file
         *
         * @return array
         */
        protected static function getFileData()
        {
            if (!static::$data) {
                static::$data = require app_path('config.php');
            }

            return static::$data;
        }
    }