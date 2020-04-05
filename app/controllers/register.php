<?php

class register extends Controller
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
            $validation = $validate->check($_POST, [
                'username' => [
                    'required' => true,
                    'min' => 2,
                    'max' => 20,
                ],
                'email' => [
                    'required' => true,
                    'unique' => 'users',
                    'email' => true
                ],
                'password'      => array(
                    'required'  => true,
                    'min'   => 6,
                ),
                'password_again'      => array(
                    'required'  => true,
                    'min'   => 6,
                    'matches' => 'password'

                ),
            ]);

            if ($validation->passed()) {
                try {
                    $this->user->create([
                        'username' => input::get('username'),
                        'email' => input::get('email'),
                        'password' => password_hash(input::get('password'), PASSWORD_DEFAULT)
                    ]);
                    redirect::to('home');
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                foreach ($validation->errors() as $error) {
                    echo $error . '<br>';
                }
            }
        }

        $this->view('auth.register');
    }
}
