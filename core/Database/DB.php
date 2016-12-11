<?php


    namespace Core\Database;


    use Core\Config;
    use PDO;

    class DB
    {
        /** @var PDO */
        protected static $connection;

        /**
         * Get array from db
         *
         * @param string $sql
         * @param string $fetchClass
         * @param array $params
         *
         * @return array
         */
        public static function fetchArray($sql, $fetchClass, array $params = [])
        {
            $statement = static::getConnection()->prepare($sql);
            $statement->execute($params);

            if (!$statement) {
                return [];
            }

            return $statement->fetchAll(PDO::FETCH_CLASS, $fetchClass);
        }

        /**
         * Getting PDO instance
         *
         * @return PDO
         */
        public static function getConnection()
        {
            if (!static::$connection) {
                static::$connection = static::createConnection();
            }

            return static::$connection;
        }

        /**
         * DB constructor.
         */
        protected static function createConnection()
        {
            $driver = Config::get('database.driver', 'mysql');
            $host = Config::get('database.host', '');
            $user = Config::get('database.user', '');
            $database = Config::get('database.database', '');
            $password = Config::get('database.password', '');
            $charset = Config::get('database.charset', '');

            $uri = "{$driver}:host={$host};dbname={$database};charset={$charset}";

            return new PDO($uri, $user, $password);
        }

        /**
         * Returns one record from database
         *
         * @param string $sql
         * @param string $fetchClass
         * @param array $params
         *
         * @return mixed
         */
        public static function fetchOne($sql, $fetchClass, array $params = [])
        {
            $statement = static::getConnection()->prepare($sql);
            $statement->execute($params);

            if (!$statement) {
                return null;
            }

            $statement->setFetchMode(PDO::FETCH_CLASS, $fetchClass);

            return $statement->fetch();
        }

        /**
         * Insert new record
         *
         * @param string $sql
         * @param array $params
         *
         * @return bool
         */
        public static function insert($sql, array $params = [])
        {
            $statement = static::getConnection()->prepare($sql);

            return $statement->execute($params);
        }

        /**
         * Updating record
         *
         * @param string $sql
         * @param array $params
         *
         * @return bool
         */
        public static function update($sql, array $params)
        {
            $statement = static::getConnection()->prepare($sql);

            return $statement->execute($params);
        }
    }