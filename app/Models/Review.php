<?php
    namespace App\Models;


    use Core\Database\DB;

    class Review
    {
        const STATUS_CREATED = 0;
        const STATUS_APPROVED = 1;
        const STATUS_DECLINED = 2;
        /** @var int */
        public $id;
        /** @var string */
        public $name;
        /** @var string */
        public $email;
        /** @var string */
        public $created_at;
        /** @var int */
        public $is_changed;
        /** @var int */
        public $status;
        /** @var string */
        public $text;
        /** @var string */
        public $image;

        /**
         * Returns only approved array
         *
         * @param string $sortOrder
         * @param bool $inverse
         *
         * @return Review[]
         */
        public static function approved($sortOrder = 'created_at', $inverse = true)
        {
            $direction = $inverse ? 'DESC' : 'ASC';
            $sql = "SELECT * FROM reviews WHERE status = ? ORDER BY {$sortOrder} {$direction}";

            return DB::fetchArray($sql, static::class, [
                static::STATUS_APPROVED,
            ]);
        }

        /**
         * @return Review[]
         */
        public static function all()
        {
            return DB::fetchArray('SELECT * FROM reviews', static::class);
        }

        /**
         * Insert new review
         *
         * @param string $name
         * @param string $email
         * @param string $text
         * @param string $imageName
         *
         * @return bool
         */
        public static function create($name, $email, $text, $imageName = null)
        {
            $sql = 'INSERT INTO reviews SET name = ?, email = ?, text = ?';

            $params = [$name, $email, $text];
            if ($imageName) {
                $sql .= ', image = ?';
                $params[] = $imageName;
            }

            debug('Create review: ' . $sql . ' ' . json_encode($params));

            return DB::insert($sql, $params);
        }

        /**
         * Update review
         *
         * @param int $id
         * @param string $name
         * @param string $email
         * @param string $text
         *
         * @return bool
         */
        public static function update($id, $name, $email, $text)
        {
            return DB::update('UPDATE reviews SET name = ?, email = ?, is_changed = 1, text = ? WHERE id = ?', [
                $name,
                $email,
                $text,
                $id,
            ]);
        }

        /**
         * Approve review
         *
         * @param int $id
         *
         * @return bool
         */
        public static function approve($id)
        {
            return DB::update('UPDATE reviews SET status = ? WHERE id = ?', [
                static::STATUS_APPROVED,
                $id,
            ]);
        }

        /**
         * Decline review
         *
         * @param int $id
         *
         * @return bool
         */
        public static function decline($id)
        {
            return DB::update('UPDATE reviews SET status = ? WHERE id = ?', [
                static::STATUS_DECLINED,
                $id,
            ]);
        }

        /**
         * Returns review by id
         *
         * @param int $id
         *
         * @return Review
         */
        public static function get($id)
        {
            return DB::fetchOne('SELECT * FROM reviews WHERE id = ? LIMIT 1', static::class, [$id]);
        }

        /**
         * Return true if image exist for review
         *
         * @return bool
         */
        public function hasImage()
        {
            return (bool)$this->image;
        }
    }