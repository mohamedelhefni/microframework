<?php


class home extends Controller
{

    public function __construct()
    {
        $this->user = $this->model('User');
    }

    public function index()
    {
        if (!$this->user->isloggedIn()) {
            return redirect::to('login');
        }
        echo "hello MR " . $this->user->data()->username;
        echo " <a href='http://localhost/microframework/public/logout'> logout </a> ";
    }
}
