<?php


    namespace App\Controllers;


    use App\Models\Review;
    use Core\Database\DB;
    use Core\Http\Controller;
    use Core\Http\ResponseFactory;
    use Core\Resizer;

    class ReviewsController extends Controller
    {
        protected static $sortingFields = ['created_at', 'name', 'email'];

        protected static $emailRegex = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';

        public function index()
        {
            $sortBy = $this->request->paramGet('sort', 'created_at');
            $inverse = $this->request->paramGet('rev', 1);
            if (!in_array($sortBy, static::$sortingFields, true)) {
                $sortBy = static::$sortingFields[0];
            }

            return ResponseFactory::view('reviews.index', [
                'reviews' => Review::approved($sortBy, $inverse),
                'sort'    => $sortBy,
                'rev'     => $inverse,
                'success' => $this->request->paramGet('s'),
            ]);
        }

        public function create()
        {
            $name = $this->request->paramPost('name');
            $email = $this->request->paramPost('email');
            $text = $this->request->paramPost('text');
            $image = $this->request->paramFile('image');

            $errors = [];
            if (!$name) $errors[] = "Поле 'имя' пусто";
            if (!$email) $errors[] = "Поле 'email' пусто";
            if (!$text) $errors[] = "Поле 'текст' пусто";
            if (!preg_match(static::$emailRegex, $email)) $errors[] = 'Неправильный email';

            $fileName = null;
            if (!$errors && $image) {
                $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
                $fileName = md5(time()) . '.' . $ext;
                $newFilePath = uploads_path();

                $resizer = new Resizer($image['tmp_name']);
                $resizer->resize(320, 240);

                if (!$resizer->write($newFilePath, $fileName)) {
                    $errors[] = 'Ошибка загрузки файла';
                }
            }

            if (!Review::create($name, $email, $text, $fileName)) {
                $errors[] = 'Ошибка записи ' . DB::getConnection()->errorInfo()[2];
                if (is_file($fileName)) unlink($fileName);
            }

            if (count($errors) > 0) {
                return ResponseFactory::view('reviews.index', [
                    'reviews' => Review::approved(),
                    'errors'  => $errors,
                ]);
            }

            return ResponseFactory::redirect('/?s=1');
        }
    }