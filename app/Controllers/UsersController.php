<?php


    namespace App\Controllers;


    use Core\Http\Controller;

    class UsersController extends Controller
    {
        public function index()
        {
            return func_get_args();
        }
    }