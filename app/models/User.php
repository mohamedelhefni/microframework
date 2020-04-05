<?php


class User
{
    private $_db,
        $_data,
        $_sessionName,
        $_isloggedIn;


    /**
     * Connect With Data base and handle session
     *
     * @param [type] $user
     */
    public function __construct($user = null)
    {
        $this->_db = DB::getInstance();
        $this->_sessionName = config::get('session/session_name');
        if (!$user) {
            if (session::exists($this->_sessionName)) {
                $user = session::get($this->_sessionName);
                if ($this->find($user)) {
                    $this->_isloggedIn = true;
                } else {
                    // output process
                }
            } else {
                $this->find($user);
            }
        }
    }


    /**
     * Find if user exists or not 
     *
     * @param [type] $user
     * @return void
     */
    public function find($user = null)
    {
        if ($user) {
            $field =  'username';
            $data = $this->_db->get('users', array($field, '=', $user));

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }

            return false;
        }
    }

    /**
     * Create Row in DB for user 
     *
     * @param array $fields
     * @return void
     */
    public function create($fields = array())
    {
        if (!$this->_db->insert('users', $fields)) {
            throw new Exception('There was a problem creating an new account');
        }
    }

    /**
     * Update user in DB
     *
     * @param array $fields
     * @param int $id
     * @return void
     */
    public function update($fields = array(), $id = null)
    {
        if (!$id && $this->isloggedIn()) {
            $id = $this->data()->id;
        }

        if (!$this->_db->update('users', $id, $fields)) {
            throw new Exception('There Was Error While Updateing Profile');
        }
    }

    /**
     * make login for user
     *
     * @param String $username
     * @param String $password
     * @return Boolean
     */
    public function login($username = null, $password = null)
    {
        $user = $this->find($username);
        if ($user) {
            if (password_verify($password, $this->data()->password)) { // remember to change user_pass to passwrod later :D
                session::put($this->_sessionName, $this->data()->username);
                return true;
            }
        }
        return false;
    }

    /**
     * Return User DAta
     *
     * @return Object
     */
    public function data()
    {
        return $this->_data;
    }
    /**
     * check if user is logged in or not
     *
     * @return Bool
     */
    public function isloggedIn()
    {
        return $this->_isloggedIn;
    }
}
