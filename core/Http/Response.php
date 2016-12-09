<?php


    namespace Core\Http;


    use Core\View\IView;
    use Core\View\Json;
    use Core\View\View;

    class Response
    {
        /** @var int */
        protected $code;

        /** @var array */
        protected $headers = [];

        /** @var IView */
        protected $view;

        /**
         * Response constructor.
         *
         * @param IView $view
         * @param int   $code
         * @param array $headers
         */
        public function __construct(IView $view, $code = 200, $headers = [])
        {
            $this->code    = (int) $code;
            $this->view    = $view;
            $this->headers = array_merge([
                'content-type' => $this->getContentType(),
            ], $headers);
        }

        /**
         * Returns HTTP code
         * @return int
         */
        public function getCode()
        {
            return $this->code;
        }

        /**
         * Returns view to render
         * @return IView
         */
        public function getView()
        {
            return $this->view;
        }

        /**
         * @return array
         */
        public function getHeaders()
        {
            return $this->headers;
        }

        /**
         * Returns content-type header based on view
         * @return string
         */
        private function getContentType()
        {
            switch (get_class($this->view)) {
                case Json::class:
                    return 'application/json';
                case View::class:
                default:
                    return 'text/html';
            }
        }
    }