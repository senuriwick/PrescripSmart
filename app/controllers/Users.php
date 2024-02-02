<?php
  class Users extends Controller {
    private $userModel;
  
    public function __construct()
    {
      $this->userModel = $this->model('User');
    }

    // public function index()
    // {
    //   $this->view('users/register_select');
    // }

    public function register_select()
    {
      $this->view('users/register_select');
    }

    public function register_phone()
    {
      $this->view('users/register_phone');
    }
//
    public function register_email()
    {
     
      $this->view('users/register_email');
      

      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        // Process form
  
        // Sanitize POST data
        //Then run the form
         //define('FILTER_SANITIZE_STRING', 513);

        // Now, instead of using the constant, you can use the integer value directly
                    $_POST = filter_input_array(INPUT_POST, 513);
        // Init data
        $data = [
          'first_name' => trim($_POST['first_name']),
          'last_name' => trim($_POST['last_name']),
          'email_address' => trim($_POST['email_address']),
          'password' => trim($_POST['password']),
          'firstname_err' => '',
          'lastname_err' => '',
          'email_err' => '',
          'password_err' => ''
        ];

        // Validate Email
        if(empty($data['email_address']))
        {
          $data['email_err'] = 'Please enter email address';
        }
         else 
        {
          // Check email
          if($this->userModel->findUserByEmail($data['email_address']))
          {
        
            $data['email_err'] = 'Email is already taken';
          }
        }

        // Validate First Name
        if(empty($data['first_name']))
        {
          $data['firstname_err'] = 'Please enter first name';
        }

        if(empty($data['last_name']))
        {
          $data['lastname_err'] = 'Please enter last name';
        }

        // Validate Email address
        if(empty($data['email_address']))
        {
          $data['email_err'] = 'Please enter valid email address';

        } 

        elseif(strlen($data['password']) < 6)
      {
          $data['password_err'] = 'Password must be at least 6 characters';
      }

        // Validate Confirm Password
        // if(empty($data['confirm_password']))
        // {
        //   $data['confirm_password_err'] = 'Please confirm password';
        // } else 
        // {
        //   if($data['password'] != $data['confirm_password'])
        //   {
        //     $data['confirm_password_err'] = 'Passwords do not match';
        //   }
        // }

        // Make sure errors are empty
        if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['email_err']) && empty($data['password_err']))
        {
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->register($data))
          {
            // flash('register_success', 'You are registered and can log in');
            redirect('pages/index');
          }
           else 
          {
            die('Something went wrong');
          }

        } 
        else
        {
          // Load view with errors
          $this->view('users/register_email', $data);
        }

      }
      else 
      {
        // Init data
        $data =[
          'first_name' => '',
          'last_name' => '',
          'email_address' => '',
          'password' => '',
          'firstname_err' => '',
          'lastname_err' => '',
          'emailaddress_err' => '',
          'password_err' => ''
        ];

        // Load view
        $this->view('users/register_email', $data);
      }
    }

    public function login()
      {
       //$this->view('users/login');
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
            $this->createUserSession($loggedInUser);
            $this->view('pages/searchDoctor');
            
          } 
          else 
          {
            $this->view('users/login', $data);
          }
        } 
        else
        {
          
          // Load view with errors
          $this->view('users/login', $data);
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
        $this->view('users/login', $data);
        
      }
    }

    public function createUserSession($user)
    {
      $_SESSION['email_address'] = $user->email_address;
      $_SESSION['first_name'] = $user->first_name;
      redirect('pages/searchDoctor');
    }

    public function logout()
    {
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      session_destroy();
      redirect('users/login');
    }
  }