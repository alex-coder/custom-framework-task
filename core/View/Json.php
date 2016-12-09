<?php


    namespace Core\View;


    class Json implements IView
    {
        /** @var mixed */
        protected $data;

        /**
         * Json constructor.
         *
         * @param array $data
         */
        public function __construct($data)
        {
            $this->data = $data;
        }

        /**
         * @return string
         */
        public function render()
        {
            return json_encode($this->data);
        }
    }