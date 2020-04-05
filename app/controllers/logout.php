<?php

class logout extends Controller
{
    public function index()
    {
        session_start();
        session_destroy();
        return redirect::to('home');
    }
}
