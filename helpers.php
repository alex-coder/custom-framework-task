<?php
    /**
     * Returns root path
     *
     * @param string $postfix
     *
     * @return string
     */
    function root_path($postfix = '')
    {
        $root = __DIR__;
        $postfix = trim($postfix, '/');
        if (!empty($postfix)) {
            $root .= DIRECTORY_SEPARATOR . $postfix;
        }

        return $root;
    }

    /**
     * Returns path to public directory
     *
     * @param string $postfix
     *
     * @return string
     */
    function public_path($postfix = '')
    {
        return root_path('public' . DIRECTORY_SEPARATOR . trim($postfix, DIRECTORY_SEPARATOR));
    }

    /**
     * Returns path to views directory
     *
     * @param string $postfix
     *
     * @return string
     */
    function views_path($postfix = '')
    {
        return root_path('views' . DIRECTORY_SEPARATOR . trim($postfix, DIRECTORY_SEPARATOR));
    }

    /**
     * Returns path to app directory
     *
     * @param string $postfix
     *
     * @return string
     */
    function app_path($postfix = '')
    {
        return root_path('app' . DIRECTORY_SEPARATOR . trim($postfix, DIRECTORY_SEPARATOR));
    }

    /**
     * Returns path to uploads directory
     *
     * @param string $postfix
     *
     * @return string
     */
    function uploads_path($postfix = '')
    {
        return public_path('uploads') . DIRECTORY_SEPARATOR . trim($postfix, DIRECTORY_SEPARATOR);
    }

    /**
     * Returns uploads uri path
     *
     * @param string $postfix
     *
     * @return string
     */
    function uploads_uri($postfix = '')
    {
        return '/public/uploads/' . ltrim($postfix, '/');
    }

    /**
     * Returns path to log dir
     *
     * @param string $postfix
     *
     * @return string
     */
    function logs_path($postfix = '')
    {
        return root_path('log' . DIRECTORY_SEPARATOR . trim($postfix, DIRECTORY_SEPARATOR));
    }

    /**
     * Log debug to file
     *
     * @param string $message
     *
     * @return int
     */
    function debug($message)
    {
        $file = logs_path('runtime.log');
        $message = date('d-m-Y H:i:s') . ' ' . $message . PHP_EOL;

        return file_put_contents($file, $message, FILE_APPEND) > 0;
    }

    /**
     * Returns sessions path
     *
     * @param string $postfix
     *
     * @return string
     */
    function session_path($postfix = '')
    {
        return root_path('sessions' . DIRECTORY_SEPARATOR . trim($postfix, DIRECTORY_SEPARATOR));
    }