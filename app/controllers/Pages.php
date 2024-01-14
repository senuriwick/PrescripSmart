<?php

//require '../app/libraries/Controller.php';

class Pages extends Controller
{
    public function __construct()
    {
        echo"what the fuck";
       
    }

    public function index()
    {
        $this->view('index');

    }
    public function about()
    {

    }
    
}