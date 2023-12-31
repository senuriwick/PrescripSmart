<?php

class LabTechnician extends Controller{
    public function __construct(){
        // $this->dpModel = $this->model('LabTechnician');
    }

    public function index(){
        $this->view('lab_tech/patient');
    }

    public function patient(){
        $this->view('lab_tech/patient');
    }
}