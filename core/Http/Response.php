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
         * @param int $code
         * @param array $headers
         */
        public function __construct(IView $view = null, $code = 200, array $headers = [])
        {
            $this->code = (int)$code;
            $this->view = $view;
            $this->headers = array_merge($this->getDefaultHeaders(), $headers);
        }

        /**
         * Returns default headers
         *
         * @return array
         */
        private function getDefaultHeaders()
        {
            return [
                'content-type' => $this->getContentType(),
            ];
        }

        /**
         * Returns content-type header based on view
         *
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

        /**
         * Returns HTTP code
         *
         * @return int
         */
        public function getCode()
        {
            return $this->code;
        }

        /**
         * Returns view to render
         *
         * @return IView
         */
        public function getView()
        {
            return $this->view;
        }

        /**
         * Returns true if view present
         *
         * @return bool
         */
        public function hasView()
        {
            return (bool)$this->view;
        }

        /**
         * @return array
         */
        public function getHeaders()
        {
            return $this->headers;
        }
    }