<?php


    namespace Core\Http;


    use Core\View\Json;
    use Core\View\View;

    class ResponseFactory
    {
        /**
         * Make a template response
         *
         * @param string $view
         * @param array $data
         * @param int $code
         * @param array $headers
         *
         * @return Response
         */
        public static function view($view, array $data = [], $code = 200, array $headers = [])
        {
            return new Response(new View($view, $data), $code, $headers);
        }

        /**
         * Make a json response
         *
         * @param mixed $data
         * @param int $code
         * @param array $headers
         *
         * @return Response
         */
        public static function json($data, $code = 200, array $headers = [])
        {
            return new Response(new Json($data), $code, $headers);
        }

        /**
         * Create redirect response
         *
         * @param string $to
         * @param int $code
         *
         * @return Response
         */
        public static function redirect($to = '/', $code = 302)
        {
            return new Response(null, $code, ['location' => $to]);
        }

        /**
         * Returns not found response
         *
         * @param string $view
         *
         * @return Response
         */
        public static function notFound($view = '404')
        {
            return new Response(new View($view), 404);
        }
    }