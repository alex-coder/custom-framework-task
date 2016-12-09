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
        $root    = __DIR__;
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
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    function config($key, $default)
    {
        $config = require_once app_path('config.php');
        $keys   = explode('.', $key);

        $last = $config;
        foreach ($keys as $k) {
            if (array_key_exists($k, $last)) {
                $last = $last[ $k ];
            } else {
                return $default;
            }
        }

        return $last;
    }