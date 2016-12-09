<?php
    /**
     * Returns root uri
     *
     * @param string $postfix
     *
     * @return string
     */
    function root_path($postfix = '')
    {
        return __DIR__ . $postfix;
    }

    /**
     * Returns uri to public directory
     *
     * @param string $postfix
     *
     * @return string
     */
    function public_path($postfix = '')
    {
        return root_path(DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . ltrim($postfix, DIRECTORY_SEPARATOR));
    }

    /**
     * Returns uri to views directory
     *
     * @param string $postfix
     *
     * @return string
     */
    function views_path($postfix = '')
    {
        return root_path(DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . ltrim($postfix, DIRECTORY_SEPARATOR));
    }

    /**
     * Returns uri to app directory
     *
     * @param string $postfix
     *
     * @return string
     */
    function app_path($postfix = '')
    {
        return root_path(DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . ltrim($postfix, DIRECTORY_SEPARATOR));
    }