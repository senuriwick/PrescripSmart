<?php
//This loads models and views

class Controller
{
    public function model($model)
    {
        //require the model file
        require_once '../app/models/' .$model. '.php';

        //instantiate a model object
        return new $model;
    }

    public function view($view, $data = [])//data array is optional
    {
        //first check for the view file
        if(file_exists('../app/views/' .$view. '.php '))
        {
            require_once '../app/views/' .$view. '.php';

        }
        else
        {
            die('View does not exist');

        }
    }
}