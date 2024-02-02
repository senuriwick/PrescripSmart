<?php
  class Pages extends Controller {
    public function __construct()
    {
     
    }
    
    public function index(){
     
      $this->view('pages/index');
    }

    public function about()
    {
      $this->view('pages/about');
    }
    public function searchDoctor()
    {
      $this->view('pages/searchDoctor');
    }

    public function searchHealthsup()
    {
      $this->view('pages/searchHealthsup');
    }
    public function searchLabtech()
    {
      $this->view('pages/searchLabtech');
    }
    public function searchNurse()
    {
      $this->view('pages/searchNurse');
    }
    public function searchPatient()
    {
      $this->view('pages/searchPatient');
    }
    public function searchPharmacist()
    {
      $this->view('pages/searchPharmacist');
    }
    public function searchReceptionist()
    {
      $this->view('pages/searchReceptionist');
    }
    public function regDoctor()
    {
      $this->view('pages/regDoctor');
    }

    
  }