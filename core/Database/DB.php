<?php


    namespace Core\Database;


    use PDO;

    class DB
    {
        /** @var DB */
        protected static $instance;

        /** @var PDO */
        protected $connection;

        /**
         * DB constructor.
         */
        protected function __construct()
        {
            $driver   = config('database.driver', 'mysql');
            $host     = config('database.host', '');
            $user     = config('database.user', '');
            $database = config('database.database', '');
            $password = config('database.password', '');
            $charset  = config('database.charset', '');

            $uri              = "{$driver}:host={$host};dbname={$database};charset={$charset}";
            $this->connection = new PDO($uri, $user, $password);
        }

        /**
         * Getting PDO instance
         * @return DB
         */
        public static function getInstance()
        {
            if (!static::$instance) {
                static::$instance = new static();
            }

            return static::$instance;
        }
    }