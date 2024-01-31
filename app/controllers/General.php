<?php

class General extends Controller
{
    private $generalModel;
    public function __construct()
    {
        $this->generalModel = $this->model('M_General');
    }

    public function index()
    {
        // $this->view('doctor/patients');
    }
    public function home()
    {
        $this->view('general/home');
    }
}