<?php

include '../init.php';

class DB
{
    private static $_instance = null;
    private $_pdo,
        $_query,
        $_error = false,
        $_results,
        $_count = 0;
    /**
     * connect to DB
     */
    private function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host=' . config::get('mysql/host') . ';dbname=' . config::get('mysql/db') . ';', config::get('mysql/user'), config::get('mysql/pass'));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    /**
     * function that build a query with params using PDO 
     *
     * @param String $sql
     * @param array $params
     * @return void
     */
    public function query($sql, $params = array())
    {
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
        }
        if ($this->_query->execute()) {
            $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
            $this->_count = $this->_query->rowCount();
        } else {
            $this->_error = true;
        }
        return $this;
    }
    /**
     * action to make it easy to handle query 
     *
     * @param String $action
     * @param String $table
     * @param array $where
     * @return void
     */
    private  function action($action, $table, $where = array())
    {
        if (count($where) == 3) {
            $operators = ['=', '>', '<', '>=', '<=', '!='];
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} where {$field} {$operator} ?";
                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }
        return false;
    }

    /**
     * get result from table
     *
     * @param String $table
     * @param Array $where
     * @return void
     */
    public function get($table, $where)
    {
        return $this->action('SELECT *', $table, $where);
    }
    /**
     * delete row from table
     *
     * @param String $table
     * @param Array $where
     * @return void
     */
    public function delete($table, $where)
    {
        return $this->action('DELETE ', $table, $where);
    }

    /**
     * insert function to insert rows in DB
     *
     * @param String $table
     * @param array $fields
     * @return bool
     */
    public function insert($table, $fields = array())
    {
        if (count($fields)) {
            $keys = array_keys($fields); // get table columns
            $values = '';
            $x = 1;
            foreach ($fields as $field) {
                $values .= '?';
                if ($x < count($fields)) {
                    $values .= ',';
                }
                $x++;
            }
            $sql = "INSERT INTO {$table} (" . implode(',', $keys) . ")  VALUES ({$values}) ";
            if (!$this->query($sql, $fields)->error()) {
                return true;
            }
        }

        return false;
    }


    /**
     * update record in db
     *
     * @param String $table
     * @param INT $id
     * @param arr $fields
     * @return bool
     */
    public function update($table, $id, $fields)
    {
        if (count($fields)) {
            $set = '';
            $x = 1;
            foreach ($fields as $name => $value) {
                $set .= "$name = ?";
                if ($x < count($fields)) {
                    $set .= ',';
                }
                $x++;
            }
            $sql = "UPDATE {$table} SET $set WHERE user_id = {$id}"; // change it later to id :D
            if (!$this->query($sql, $fields)->error()) {
                return true;
            }
        }

        return false;
    }

    /**
     * function to get results 
     *
     * @return Object
     */
    public function result()
    {
        return $this->_results;
    }

    /**
     * function to return count of results
     *
     * @return INT
     */
    public function count()
    {
        return $this->_count;
    }

    public function first()
    {
        return $this->_results[0];
    }

    public function error()
    {
        return $this->_error;
    }
}
