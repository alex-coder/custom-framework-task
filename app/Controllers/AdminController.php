<?php
    namespace App\Controllers;


    use App\Models\Review;
    use Core\Http\Controller;
    use Core\Http\ResponseFactory;

    class AdminController extends Controller
    {
        public function index()
        {
            if (!$this->isSessionValid()) {
                return ResponseFactory::redirect('/login');
            }

            return ResponseFactory::view('admin.index', [
                'reviews' => Review::all(),
            ]);
        }

        private function isSessionValid()
        {
            $sessionFile = session_path('admin.session');
            $token = file_get_contents($sessionFile);

            return $token === $_COOKIE['session'];
        }

        public function edit($id)
        {
            if (!$this->isSessionValid()) {
                return ResponseFactory::redirect('/login');
            }

            return ResponseFactory::view('admin.edit', [
                'review' => Review::get($id),
            ]);
        }

        public function save($id)
        {
            if (!$this->isSessionValid()) {
                return ResponseFactory::redirect('/login');
            }

            $name = $this->request->paramPost('name');
            $email = $this->request->paramPost('email');
            $text = $this->request->paramPost('text');

            $ok = Review::update($id, $name, $email, $text);
            if (!$ok) {
                return ResponseFactory::view('admin.edit', [
                    'review'  => Review::get($id),
                    'success' => false,
                ]);
            }

            return ResponseFactory::redirect('/admin');
        }

        public function approve($id)
        {
            return ResponseFactory::json([
                'success' => $this->isSessionValid() && Review::approve($id),
            ]);
        }

        public function decline($id)
        {
            return ResponseFactory::json([
                'success' => $this->isSessionValid() && Review::decline($id),
            ]);
        }
    }