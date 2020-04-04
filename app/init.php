<?php

session_start();

$GLOBALS['config'] = array(
    'mysql'     => array(
        'host'  => 'localhost',
        'user'  => 'root',
        'pass'  => '',
        'db'    => 'mychat'
    ),
    'remember'  => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session'   => array(
        'session_name'  => 'user',
        'token_name' => 'token'
    )
);


function autoload($class)
{
    require "core/$class.php";
}

spl_autoload_register('autoload');
