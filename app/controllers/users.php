<?php

class users extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = $this->model('User');
    }

    public function index($name = '')
    {
        echo "<PRE>";
        print_r($this->user->getUsers());
        echo "</PRE>";
    }
}
