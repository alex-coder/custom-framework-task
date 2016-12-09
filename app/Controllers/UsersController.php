<?php


    namespace App\Controllers;


    use Core\Http\Controller;
    use Core\Http\ResponseFactory;

    class UsersController extends Controller
    {
        public function show($id)
        {
            return ResponseFactory::notFound();
        }
    }