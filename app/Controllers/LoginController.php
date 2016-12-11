<?php
    namespace App\Controllers;


    use Core\Config;
    use Core\Http\Controller;
    use Core\Http\ResponseFactory;

    class LoginController extends Controller
    {
        public function index()
        {
            return ResponseFactory::view('login.index');
        }

        public function login()
        {
            $login = $this->request->paramPost('login');
            $password = $this->request->paramPost('password');

            $rightLogin = Config::get('admin.login');
            $rightPassword = Config::get('admin.password');

            if ($login !== $rightLogin || $password !== $rightPassword) {
                return ResponseFactory::view('login.index', ['success' => false]);
            }

            $token = md5($login . $password);
            $sessionFile = session_path('admin.session');
            file_put_contents($sessionFile, $token);

            setcookie('session', $token, null, '/');

            return ResponseFactory::redirect('/admin');
        }
    }