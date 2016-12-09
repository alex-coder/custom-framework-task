<?php


    namespace Core\View;


    class View implements IView
    {

        /** @var TemplateEngine */
        protected $engine;

        /**
         * View constructor.
         *
         * @param string $view
         * @param array  $data
         */
        public function __construct($view, array $data = [])
        {
            $template     = views_path(str_replace('.', '/', $view));
            $this->engine = new TemplateEngine($template, $data);
        }

        /**
         * Render template
         * @return string
         */
        public function render()
        {
            return $this->engine->render();
        }
    }