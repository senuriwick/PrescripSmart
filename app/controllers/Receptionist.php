<?php
  class Receptionist extends Controller 
  {
    public $userModel;
    public function __construct()
    {
      // if(!isLoggedIn())
      // {
      //   redirect('receptionist/login');
      // }
      $this->userModel = $this->model('M_receptionist');

    }

    public function index()
    {
     
      $this->view('receptionist/searchApp');
    }

    public function login()
   {
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
         // Process form
         // Sanitize POST data
         //Then run the form
         //define('FILTER_SANITIZE_STRING', 513);

         // Now, instead of using the constant, you can use the integer value directly
         $_POST = filter_input_array(INPUT_POST, 513);
        
        // Init data
        $data =[
          'email_address' => trim($_POST['email_address']),
          'password' => trim($_POST['password']),
          'emailaddress_err' => '',
          'password_err' => '',      
        ];

        // Validate Email
        if(empty($data['email_address']))
        {
          $data['emailaddress_err'] = 'Please enter email address';
        }

        // Validate Password
        if(empty($data['password']))
        {
          $data['password_err'] = 'Please enter password';
        }

        // Check for user/email
        if($this->userModel->findUserByEmail($data['email_address']))
        {
          // User found
        } 
        else 
        {
          // User not found
          $data['emailaddress_err'] = 'No user found';
        }

        // Make sure errors are empty
        if(empty($data['emailaddress_err']) && empty($data['password_err']))
        {
          // Validated
          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['email_address'], $data['password']);

          if($loggedInUser)
          {
            // Create Session
            $this->createusersession($loggedInUser);
            $this->view('admin/searchDoctor');
            
          } 
          else 
          {
            $this->view('admin/login', $data);
          }
        } 
        else
        {
          
          // Load view with errors
          $this->view('admin/login', $data);
        }


      } 
      else 
    {
        // Init data
        $data =[    
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => '',        
        ];

        // Load view
        $this->view('admin/login', $data);
        
      }
    }
  }