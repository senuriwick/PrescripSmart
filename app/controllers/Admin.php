<?php
  class Admin extends Controller 
  {
    public $userModel;
    public function __construct()
    {
      // if(!isLoggedIn())
      // {
      //   redirect('admin/login');
      // }
      $this->userModel = $this->model('M_admin');

    }

    public function index()
    {
     
      $this->view('admin/index');
    }

    public function register_select()
    {
      $this->view('admin/register_select');
    }

    public function register_phone()
    {
      $this->view('admin/register_phone');
    }

    public function register_email()
    {
      
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        // Process form
  
        // Sanitize POST data
        //Then run the form
         //define('FILTER_SANITIZE_STRING', 513);

        // Now, instead of using the constant, you can use the integer value directly
                    $_POST = filter_input_array(INPUT_POST, 513);
        // Init data
        $data = 
        [
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
            redirect('admin/index');
          }
           else 
          {
            die('Something went wrong');
          }

        } 
        else
        {
          // Load view with errors
          $this->view('admin/register_email', $data);
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
        $this->view('admin/register_email', $data);
      }
    }

    public function login()
      {
      
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
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
            
          } 
          else 
          {
            $this->view('admin/login',$data);
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

    public function createusersession($user)
    {
      $_SESSION['email_address'] = $user->email_address;
      $_SESSION['first_name'] = $user->first_name;
      $_SESSION['last_name'] = $user->last_name;

      redirect('/admin/searchDoctor');
    }

    public function logout()
    {
      unset($_SESSION['email_address']);
      unset($_SESSION['first_name']);
      session_destroy();
      redirect('admin/login');
    }
    public function searchPatient($page = 1)
    {
      $perPage = 4;
      $total_records = $this->userModel->getPatients();
      $totalPages = ceil($total_records/$perPage);

      //Validating the current page
      if($page <1)
      {
        $page = 1;
      }
      elseif($page > $totalPages)
      {
        $page = $totalPages;
      }

      
      $patients = $this->userModel->getPatient_set($page, $perPage);
      $data = [
        'patients'=> $patients,
        'currentPage' => $page,
        'totalPages' => $totalPages
      ];

      $this->view('admin/searchPatient', $data);
    }

    public function searchDoctor($page = 1)
    {
      $perPage = 2;
      $total_records = $this->userModel->getDoctors();
      $totalPages = ceil($total_records/$perPage);

      //Validating the current page
      if($page <1)
      {
        $page = 1;
      }
      elseif($page > $totalPages)
      {
        $page = $totalPages;
      }

      $doctors = $this->userModel->getDoctor_set($page, $perPage);
      $alldoctors = $this->userModel->getalldoctors();
      if($doctors)
      {
        $data = [
          'doctors'=> $doctors,
          'currentPage' => $page,
          'totalPages' => $totalPages,
          'doctorlist' => $alldoctors
           
        ];

      }
      
      $this->view('admin/searchDoctor', $data);
    }

    public function searchHealthsup($page = 1)
    {

      $perPage = 4;
      $total_records = $this->userModel->getHealthsups();
      $totalPages = ceil($total_records/$perPage);

      //Validating the current page
      if($page <1)
      {
        $page = 1;
      }
      elseif($page > $totalPages)
      {
        $page = $totalPages;
      }

      $healthsups = $this->userModel->getHealthsup_set($page, $perPage);
      $data = [
        'healthsups'=> $healthsups,
        'currentPage' => $page,
        'totalPages' => $totalPages
      ];
      $this->view('admin/searchHealthsup', $data);
    }

    public function searchLabtech($page = 1)
    {
      $perPage = 4;
      $total_records = $this->userModel->getLabtechs();
      $totalPages = ceil($total_records/$perPage);

      //Validating the current page
      if($page <1)
      {
        $page = 1;
      }
      elseif($page > $totalPages)
      {
        $page = $totalPages;
      }
      $labtechs = $this->userModel->getLabtech_set($page, $perPage);
      $data = [
        'labtechs'=> $labtechs,
        'currentPage' => $page,
        'totalPages' => $totalPages
      ];


      $this->view('admin/searchLabtech', $data);
    }

    public function searchNurse($page = 1)
    {
      $perPage = 4;
      $total_records = $this->userModel->getNurses();
      $totalPages = ceil($total_records/$perPage);

      //Validating the current page
      if($page <1)
      {
        $page = 1;
      }
      elseif($page > $totalPages)
      {
        $page = $totalPages;
      }
      $nurses = $this->userModel->getNurse_set($page, $perPage);
      $data = [
        'nurses'=> $nurses,
        'currentPage' => $page,
        'totalPages' => $totalPages
      ];


      $this->view('admin/searchNurse', $data);
    }


    public function searchPharmacist($page = 1)
    {
      $perPage = 4;
      $total_records = $this->userModel->getPharmacists();
      $totalPages = ceil($total_records/$perPage);

      //Validating the current page
      if($page <1)
      {
        $page = 1;
      }
      elseif($page > $totalPages)
      {
        $page = $totalPages;
      }
      $pharmacists = $this->userModel->getPharmacist_set($page, $perPage);
      $data = [
        'pharmacists'=> $pharmacists,
        'currentPage' => $page,
        'totalPages' => $totalPages
      ];


      $this->view('admin/searchPharmacist', $data);
    }

    public function searchReceptionist($page = 1)
    {
      $perPage = 4;
      $total_records = $this->userModel->getReceptionists();
      $totalPages = ceil($total_records/$perPage);

      //Validating the current page
      if($page <1)
      {
        $page = 1;
      }
      elseif($page > $totalPages)
      {
        $page = $totalPages;
      }
      $receptionists = $this->userModel->getReceptionist_set($page, $perPage);
      if($receptionists)
      {
        $data = [
          'receptionists'=> $receptionists,
          'currentPage' => $page,
          'totalPages' => $totalPages
        ];
      }
      
      $this->view('admin/searchReceptionist', $data);
    }

    public function viewRegdoctor()
    {
      $this->view('admin/regDoctor');
    }

    public function viewReghealthsup()
    {
      $this->view('admin/regHealthsup');
    }

    public function viewReglabtech()
    {
      $this->view('admin/regLabtech');
    }

    public function viewRegnurse()
    {
      $this->view('admin/regNurse');
    }

    public function viewRegpatient()
    {
      $this->view('admin/regPatient');
    }

    public function viewRegpharmacist()
    {
      $this->view('admin/regPharmacist');
    }

    public function viewRegreceptionist()
    {
      $this->view('admin/regReceptionist');
    }


    public function regDoctor()
    {
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
          'email' => trim($_POST['email']),
          'phone_number' => trim($_POST['phone_number']),
          'password' => trim($_POST['password']),
          'firstname_err' => '',
          'lastname_err' => '',
          'email_err' => '',
          'phonenum_err' => '',
          'password_err' => '',
          'user_reg'=> 0 
        ];



        // Validate Email
        if(empty($data['email']))
        {
          $data['email_err'] = 'Please enter email address';
        }
         else 
        {
          // Check email
          if($this->userModel->findUserByEmail($data['email']))
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
        if(empty($data['email']))
        {
          $data['email_err'] = 'Please enter valid email address';

        }
        
        if(empty($data['phone_number']))
        {
          $data['phonenum_err'] = 'Please enter valid email address';

        }

        else if(strlen($data['password']) < 6)
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
        if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['phonenum_err']) && empty($data['email_err']) && empty($data['password_err']))
        {
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->regDoctor($data))
          {
            // flash('register_success', 'You are registered and can log in');
            $data['user_reg'] = 1;
            redirect('/admin/searchDoctor');
           
          }
           else 
          {
            die('Something went wrong');           
          }

        } 
        else
        {
          // Load view with errors
          //$this->view('admin/register_email', $data);
          echo"this 13";
        }

      }
      else //if request method is not post
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
       $this->view('admin/register_email', $data);
       
      }
      


    }

    public function regHealthsup()
    {
      $this->view('admin/regHealthSup');


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
          'email' => trim($_POST['email']),
          'phone_number' => trim($_POST['phone_number']),
          'password' => trim($_POST['password']),
          'firstname_err' => '',
          'lastname_err' => '',
          'email_err' => '',
          'phonenum_err' => '',
          'password_err' => ''
        ];

        // Validate Email
        if(empty($data['email']))
        {
          $data['email_err'] = 'Please enter email address';
        }
         else 
        {
          // Check email
          if($this->userModel->findUserByEmail($data['email']))
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
        if(empty($data['email']))
        {
          $data['email_err'] = 'Please enter valid email address';

        }
        
        if(empty($data['phone_number']))
        {
          $data['phonenum_err'] = 'Please enter valid email address';

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
        if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['phonenum_err']) && empty($data['email_err']) && empty($data['password_err']))
        {
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->regHealthsup($data))
          {
            // flash('register_success', 'You are registered and can log in');
            redirect('/admin/searchHealthsup');
          }
           else 
          {
            die('Something went wrong');
          }

        } 
        else
        {
          // Load view with errors
          $this->view('admin/register_email', $data);
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
        $this->view('admin/register_email', $data);
      }
      


    }

    public function regLabtech()
    {
      $this->view('admin/regLabtech');


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
          'email' => trim($_POST['email']),
          'phone_number' => trim($_POST['phone_number']),
          'password' => trim($_POST['password']),
          'firstname_err' => '',
          'lastname_err' => '',
          'email_err' => '',
          'phonenum_err' => '',
          'password_err' => ''
        ];

        // Validate Email
        if(empty($data['email']))
        {
          $data['email_err'] = 'Please enter email address';
        }
         else 
        {
          // Check email
          if($this->userModel->findUserByEmail($data['email']))
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
        if(empty($data['email']))
        {
          $data['email_err'] = 'Please enter valid email address';

        }
        
        if(empty($data['phone_number']))
        {
          $data['phonenum_err'] = 'Please enter valid email address';

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
        if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['phonenum_err']) && empty($data['email_err']) && empty($data['password_err']))
        {
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->regLabtech($data))
          {
            // flash('register_success', 'You are registered and can log in');
            redirect('/admin/searchLabtech');
          }
           else 
          {
            die('Something went wrong');
          }

        } 
        else
        {
          // Load view with errors
          $this->view('admin/register_email', $data);
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
        $this->view('admin/register_email', $data);
      }
      


    }

    public function regNurse()
    {
      
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
          'email' => trim($_POST['email']),
          'phone_number' => trim($_POST['phone_number']),
          'password' => trim($_POST['password']),
          'firstname_err' => '',
          'lastname_err' => '',
          'email_err' => '',
          'phonenum_err' => '',
          'password_err' => ''
        ];

        // Validate Email
        if(empty($data['email']))
        {
          $data['email_err'] = 'Please enter email address';
        }
         else 
        {
          // Check email
          if($this->userModel->findUserByEmail($data['email']))
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
        if(empty($data['email']))
        {
          $data['email_err'] = 'Please enter valid email address';

        }
        
        if(empty($data['phone_number']))
        {
          $data['phonenum_err'] = 'Please enter valid email address';

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
        if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['phonenum_err']) && empty($data['email_err']) && empty($data['password_err']))
        {
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->regNurse($data))
          {
            // flash('register_success', 'You are registered and can log in');
            redirect('/admin/searchNurse');
          }
           else 
          {
            die('Something went wrong');
          }

        } 
        else
        {
          // Load view with errors
          $this->view('admin/register_email', $data);
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
        $this->view('admin/register_email', $data);
      }
      


    }
    
    public function regPatient()
    {
      $this->view('admin/regPatient');


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
          'email' => trim($_POST['email']),
          'phone_number' => trim($_POST['phone_number']),
          'password' => trim($_POST['password']),
          'firstname_err' => '',
          'lastname_err' => '',
          'email_err' => '',
          'phonenum_err' => '',
          'password_err' => ''
        ];

        // Validate Email
        if(empty($data['email']))
        {
          $data['email_err'] = 'Please enter email address';
        }
         else 
        {
          // Check email
          if($this->userModel->findUserByEmail($data['email']))
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
        if(empty($data['email']))
        {
          $data['email_err'] = 'Please enter valid email address';

        }
        
        if(empty($data['phone_number']))
        {
          $data['phonenum_err'] = 'Please enter valid email address';

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
        if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['phonenum_err']) && empty($data['email_err']) && empty($data['password_err']))
        {
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->regPatient($data))
          {
            // flash('register_success', 'You are registered and can log in');
            redirect('/admin/searchPatient');
          }
           else 
          {
            die('Something went wrong');
          }

        } 
        else
        {
          // Load view with errors
          $this->view('admin/register_email', $data);
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
        $this->view('admin/register_email', $data);
      }
      


    }

    public function regPharmacist()
    {
     


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
          'email' => trim($_POST['email']),
          'phone_number' => trim($_POST['phone_number']),
          'password' => trim($_POST['password']),
          'firstname_err' => '',
          'lastname_err' => '',
          'email_err' => '',
          'phonenum_err' => '',
          'password_err' => ''
        ];

        // Validate Email
        if(empty($data['email']))
        {
          $data['email_err'] = 'Please enter email address';
        }
         else 
        {
          // Check email
          if($this->userModel->findUserByEmail($data['email']))
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
        if(empty($data['email']))
        {
          $data['email_err'] = 'Please enter valid email address';

        }
        
        if(empty($data['phone_number']))
        {
          $data['phonenum_err'] = 'Please enter valid email address';

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
        if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['phonenum_err']) && empty($data['email_err']) && empty($data['password_err']))
        {
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->regPharmacist($data))
          {
            // flash('register_success', 'You are registered and can log in');
            redirect('/admin/searchPharmacist');
          }
           else 
          {
            die('Something went wrong');
          }

        } 
        else
        {
          // Load view with errors
          $this->view('admin/register_email', $data);
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
        $this->view('admin/register_email', $data);
      }
      


    }

    public function regReceptionist()
    {
      $this->view('admin/regReceptionist');


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
          'email' => trim($_POST['email']),
          'phone_number' => trim($_POST['phone_number']),
          'password' => trim($_POST['password']),
          'firstname_err' => '',
          'lastname_err' => '',
          'email_err' => '',
          'phonenum_err' => '',
          'password_err' => ''
        ];

        // Validate Email
        if(empty($data['email']))
        {
          $data['email_err'] = 'Please enter email address';
        }
         else 
        {
          // Check email
          if($this->userModel->findUserByEmail($data['email']))
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
        if(empty($data['email']))
        {
          $data['email_err'] = 'Please enter valid email address';

        }
        
        if(empty($data['phone_number']))
        {
          $data['phonenum_err'] = 'Please enter valid email address';

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
        if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['phonenum_err']) && empty($data['email_err']) && empty($data['password_err']))
        {
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->regReceptionist($data))
          {
            // flash('register_success', 'You are registered and can log in');
            redirect('/admin/searchReceptionist');
          }
           else 
          {
            die('Something went wrong');
          }

        } 
        else
        {
          // Load view with errors
          $this->view('admin/register_email', $data);
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
        $this->view('admin/register_email', $data);
      }
      


    }

    public function deleteProfileDoc($id)
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        if($this->userModel->deleteProfileDoc($id))
        {
          echo"Profile sucessfully deleted";
        }
        else
        {
          echo"something went wrong";
        }
      }
    }
    public function deleteProfileLabtech($id)
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        if($this->userModel->deleteProfileLabtech($id))
        {
          echo"Profile sucessfully deleted";
        }
        else
        {
          echo"something went wrong";
        }
      }
    }
    public function deleteProfileHealthsup($id)
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        if($this->userModel->deleteProfileHealthsup($id))
        {
          echo"Profile sucessfully deleted";
        }
        else
        {
          echo"something went wrong";
        }
      }
    }

    public function deleteProfileNurse($id)
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        if($this->userModel-> deleteProfileNurse($id))
        {
          echo"Profile sucessfully deleted";
        }
        else
        {
          echo"something went wrong";
        }
      }
    }
    public function deleteProfilePatient($id)
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        if($this->userModel->deleteProfilePatient($id))
        {
          echo"Profile sucessfully deleted";
        }
        else
        {
          echo"something went wrong";
        }
      }
    }
    public function deleteProfilePharmacist($id)
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        if($this->userModel->deleteProfilePharmacist($id))
        {
          echo"Profile sucessfully deleted";
        }
        else
        {
          echo"something went wrong";
        }
      }
    }

    public function deleteProfileReceptionist($id)
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        if($this->userModel->deleteProfileReceptionist($id))
        {
          echo"Profile sucessfully deleted";
        }
        else
        {
          echo"something went wrong";
        }
      }
    }

    public function showProfileDoc($id)
    {
      $table = 'doctors';
      $doctor = $this->userModel->getDoctorbyID($id);

      $data= [
        'doctor'=>$doctor
      ];
      $this->view('admin/doctorProfile', $data);      

    }

    public function showProfileHealthsup($id)
    {
      $table = 'healthsupervisors';
      $healthsup = $this->userModel->getSupervisorbyID($id);

      $data= [
        'doctor'=>$healthsup
      ];
      $this->view('admin/healthsupProfile', $data);
       
    }

    public function showProfileLabtech($id)
    {
      $table = 'labtechnicians';
      $labtech = $this->userModel->getLabtechbyID($id);

      $data= [
        'doctor'=>$labtech
      ];
      $this->view('admin/labtechProfile', $data);
       

    }
    public function showProfileNurse($id)
    {
      $table= 'nurses';
      $nurse = $this->userModel->getNursebyID($id);

      $data= [
        'doctor'=>$nurse
      ];
      $this->view('admin/nurseProfile', $data);
       

    }
    public function showProfilePatient($id)
    {
      $table = 'patients';
      $patient = $this->userModel->getPatientbyID($id);

      $data= [
        'doctor'=>$patient
      ];
      $this->view('admin/patientProfile', $data);
       

    }
    public function showProfilePharmacist($id)
    {
      $table= 'pharmacists';
      $pharmacist = $this->userModel->getPharmacistbyID($id);

      $data= [
        'doctor'=>$pharmacist
      ];
      $this->view('admin/pharmacistProfile', $data);
       

    }
    public function showProfileReceptionist($id)
    {
      $table = 'receptionists';
      $receptionist = $this->userModel->getReceptionistbyID($id);

      $data= [
        'doctor'=>$receptionist
      ];
      $this->view('admin/receptionistProfile', $data);
       

    }

    public function updateProfile($id)
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        $data = [
          'id' => $id,
          'first_name' => trim($_POST['first_name']),
          'last_name' => trim($_POST['last_name']),
          'email' => trim($_POST['email']),
          'phone_number' => trim($_POST['phone_number']),
          'password' => trim($_POST['password']),
          'firstname_err' => '',
          'lastname_err' => '',
          'email_err' => '',
          'phonenum_err' => '',
          'password_err' => ''
        ];

        if(empty($data['email']))
        {
          $data['email_err'] = 'Please enter email address';
        }

        else 
        {
          // Check email
          if($this->userModel->findUserByEmail($data['email']))
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
        if(empty($data['email']))
        {
          $data['email_err'] = 'Please enter valid email address';

        }
        
        if(empty($data['phone_number']))
        {
          $data['phonenum_err'] = 'Please enter valid email address';

        }

        else if(strlen($data['password']) < 6)
        {
          $data['password_err'] = 'Password must be at least 6 characters';
        }

        // Make sure errors are empty
        if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['phonenum_err']) && empty($data['email_err']) && empty($data['password_err']))
        {
          if(empty($data['title_err']) && empty($data['body_err'])){
            // Validation passed
            //Execute
            if($this->userModel->updatePost($data)){
            // flash('post_message', 'Post Updated');
            redirect('posts');
            } else {
              die('Something went wrong');
            }
          } 

      }
    }
  }

    
    
    
    
  }