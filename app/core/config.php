<?php

class Config
{
    /**
     * function to make it easy to get path of $GLOBALS Var 
     *  
     * @param String $path
     * @return String
     */
    public static function get($path = null)
    {
        if ($path) {
            $config = $GLOBALS['config'];
            $paths = explode('/', $path);
            foreach ($paths as $bit) {
                $config = isset($config[$bit]) ?  $config[$bit] : '';
            }
            return $config;
        }
        return false;
    }
}
