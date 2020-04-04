<?php

class input
{

    /**
     * Check if exists for input request
     *
     * @param string $type
     * @return void
     */
    public function exists($type = 'post')
    {
        switch ($type) {
            case 'post':
                return (!empty($_POST) ? true : false);
                break;
            case 'get':
                return (!empty($_GET) ? true : false);
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * get request $_POST OR $_GET
     *
     * @param String $item
     * @return void
     */
    public static function get($item)
    {
        if (isset($_POST[$item])) {
            return $_POST[$item];
        } elseif (isset($_GET[$item])) {
            return $_GET[$item];
        }
        return '';
    }
}
