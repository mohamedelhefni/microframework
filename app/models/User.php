<?php


class User
{

    public function getUsers()
    {
        return DB::getInstance()->paginate('users', 2);
    }
    // private $_db,
    //     $_data,
    //     $_sessionName,
    //     $_isloggedIn;

    // public function __construct($user = null)
    // {
    //     $this->_db = DB::getInstance();
    //     $this->_sessionName = config::get('session/session_name');
    //     if (!$user) {
    //         if (session::exists($this->_sessionName)) {
    //             $user = session::get($this->_sessionName);
    //             if ($this->find($user)) {
    //                 $this->_isloggedIn = true;
    //             } else {
    //                 // output process
    //             }
    //         } else {
    //             $this->find($user);
    //         }
    //     }
    // }

    // public function find($user = null)
    // {
    //     if ($user) {
    //         $field = (is_numeric($user)) ? 'id' : 'username';
    //         $data = $this->_db->get('users', array($field, '=', $user));

    //         if ($data->count()) {
    //             $this->_data = $data->first();
    //             return true;
    //         }

    //         return false;
    //     }
    // }
}
