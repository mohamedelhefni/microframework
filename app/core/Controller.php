<?php


class Controller
{
    public function model($model)
    {
        if (file_exists("../app/models/$model.php")) {
            require_once "../app/models/$model.php";
            return new $model;
        }
    }
    public function view($view, $data = [])
    {
        $view = str_replace('.', '/', $view);
        if (file_exists("../app/views/$view.php")) {
            include "../app/views/$view.php";
        }
    }
}
