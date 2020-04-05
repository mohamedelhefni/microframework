<?php

session_start();

$GLOBALS['config'] = array(
    'mysql'     => array(
        'host'  => 'localhost',
        'user'  => 'root',
        'pass'  => '',
        'db'    => 'lr'
    ),
    'remember'  => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session'   => array(
        'session_name'  => 'user',
        'token_name' => 'token'
    ),
    'development' => 'true'
);


function autoload($class)
{
    require "core/$class.php";
}

spl_autoload_register('autoload');


if (Config::get('development')) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
