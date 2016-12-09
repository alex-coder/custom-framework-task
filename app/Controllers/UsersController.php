<?php


    namespace App\Controllers;


    use Core\Http\Controller;
    use Core\Http\Response;
    use Core\View\Json;

    class UsersController extends Controller
    {
        public function show($id)
        {
            $view = new Json(['id' => $id]);

            return new Response($view);
        }
    }