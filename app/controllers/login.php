<?php

class login extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = $this->model('User');
    }

    public function index()
    {

        if ($this->user->isloggedIn()) {
            redirect::to('home');
        }
        if (input::exists()) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'username' => array('required' => true),
                'password' => array('required' => true),
            ));

            if ($validation->passed()) {
                $user = new user();
                $login = $user->login(input::get('username'), input::get('password'));
                if ($login) {
                    echo 'You logged in succ';
                    redirect::to('home');
                } else {
                    echo 'please check password or email again';
                }
            } else {
                foreach ($validation->errors() as $error) {
                    echo $error  .  "<br>";
                }
            }
        }
        $this->view('auth.login');
    }
}
