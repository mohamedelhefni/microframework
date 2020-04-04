<?php

class session
{
    /**
     * function to put value to session
     *
     * @param [type] $name
     * @param [type] $value
     * @return void
     */
    public static function put($name, $value)
    {
        return $_SESSION[$name] = $value;
    }
    /**
     * function to get value of session
     *
     * @param [type] $name
     * @return void
     */
    public static function get($name)
    {
        return $_SESSION[$name];
    }
    /**
     * function to check if session exists
     *
     * @param [type] $name
     * @return void
     */
    public static function exists($name)
    {
        return isset($_SESSION[$name]) ? true : false;
    }

    /**
     * Destory sessin
     *
     * @param String $name
     * @return void
     */
    public static function delete($name)
    {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }
}
