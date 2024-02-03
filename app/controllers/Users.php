<?php
  class Users extends Controller {
    private $userModel;
  
    public function __construct()
    {
      $this->userModel = $this->model('User');
    }

    
  }