<?php

class login extends Controller
{
    protected $user;

    public function index()
    {
        echo input::get('name');
        $this->view('login.index');
    }
}
