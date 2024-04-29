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
      $this->view('general/home');
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
      $this->view('admin/register_email');
    }

    public function register()
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
            $this->view('admin/login');
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
      $_SESSION['USER_DATA'] = $user;
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
    
            $allPatients = $this->userModel->getPatient_set();
            $recordsPerPage = 10;
            $totalPatients = count($allPatients);
            $totalPages = ceil($totalPatients / $recordsPerPage);

            $offset = ($page - 1) * $recordsPerPage;
            $patients = array_slice($allPatients, $offset, $recordsPerPage);

            $data = [
                'patients' => $patients,
                'allPatients' => $allPatients,
                'currentPage' => $page,
                'totalPages' => $totalPages
            ];

            $this->view('admin/searchPatient', $data);
        
    }

    public function filterPatients()
    {
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
        $filteredPatients = $this->userModel->filterPatients($searchQuery);
        echo json_encode($filteredPatients);
    }
    public function filterDoctors()
    {
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
        $filteredPatients = $this->userModel->filterDofilterPatientsctors($searchQuery);
        echo json_encode($filteredPatients);
    }
    public function filterHealthsups()
    {
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
        $filteredPatients = $this->userModel->filterHealthsups($searchQuery);
        echo json_encode($filteredPatients);
    }
    public function filterLabtechs()
    {
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
        $filteredPatients = $this->userModel->filterLabtechs($searchQuery);
        echo json_encode($filteredPatients);
    }
    public function filterNurses()
    {
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
        $filteredPatients = $this->userModel->filterNurses($searchQuery);
        echo json_encode($filteredPatients);
    }
    public function filterPharmacists()
    {
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
        $filteredPatients = $this->userModel->filterPharmacists($searchQuery);
        echo json_encode($filteredPatients);
    }
    public function filterReceptionists()
    {
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
        $filteredPatients = $this->userModel->filterReceptionists($searchQuery);
        echo json_encode($filteredPatients);
    }
    

    public function searchDoctor($page = 1)
    {
            $alldoctors = $this->userModel->getalldoctors();
            $recordsPerPage = 2;
            $totalPatients = count($alldoctors);
            $totalPages = ceil($totalPatients / $recordsPerPage);

            $offset = ($page - 1) * $recordsPerPage;
            $doctors = array_slice($alldoctors, $offset, $recordsPerPage);

            $data = [
                'patients' => $doctors,
                'allDoctors' => $alldoctors,
                'currentPage' => $page,
                'totalPages' => $totalPages
            ];

            $this->view('admin/searchDoctor', $data);
    }

    public function searchHealthsup($page = 1)
    {

            $allHealthsups = $this->userModel->getHealthsup_set();
            $recordsPerPage = 2;
            $totalHealthsups = count($allHealthsups);
            $totalPages = ceil($totalHealthsups / $recordsPerPage);

            $offset = ($page - 1) * $recordsPerPage;
            $healthsups = array_slice($allHealthsups, $offset, $recordsPerPage);

            $data = [
                'patients' => $healthsups,
                'allHealthsups' => $allHealthsups,
                'currentPage' => $page,
                'totalPages' => $totalPages
            ];

            $this->view('admin/searchHealthsup', $data);
    }

    public function searchLabtech($page = 1)
    {
            $allLabtechs = $this->userModel->getLabtech_set();
            $recordsPerPage = 2;
            $totalLabtechs = count($allLabtechs);
            $totalPages = ceil($totalLabtechs / $recordsPerPage);

            $offset = ($page - 1) * $recordsPerPage;
            $labtechs = array_slice($allLabtechs, $offset, $recordsPerPage);

            $data = [
                'patients' => $labtechs,
                'allLabtechs' => $allLabtechs,
                'currentPage' => $page,
                'totalPages' => $totalPages
            ];

            $this->view('admin/searchLabtech', $data);
    }

    public function searchNurse($page = 1)
    {
            $allNurses = $this->userModel->getNurse_set();
            $recordsPerPage = 2;
            $totalNurses = count($allNurses);
            $totalPages = ceil($totalNurses / $recordsPerPage);

            $offset = ($page - 1) * $recordsPerPage;
            $nurses = array_slice($allNurses, $offset, $recordsPerPage);

            $data = [
                'patients' => $nurses,
                'allNurses' => $allNurses,
                'currentPage' => $page,
                'totalPages' => $totalPages
            ];

            $this->view('admin/searchNurse', $data);
    }


    public function searchPharmacist($page = 1)
    {
            $allPharmacists = $this->userModel->getPharmacist_set();
            $recordsPerPage = 2;
            $totalPharmacists = count($allPharmacists);
            $totalPages = ceil($totalPharmacists / $recordsPerPage);

            $offset = ($page - 1) * $recordsPerPage;
            $pharmacists = array_slice($allPharmacists, $offset, $recordsPerPage);

            $data = [
                'patients' => $pharmacists,
                'allPharmacists' => $allPharmacists,
                'currentPage' => $page,
                'totalPages' => $totalPages
            ];

            $this->view('admin/searchPharmacist', $data);
    }

    public function searchReceptionist($page = 1)
    {
            $allReceptionists = $this->userModel->getReceptionist_set();
            $recordsPerPage = 2;
            $totalreceptionists = count($allReceptionists);
            $totalPages = ceil($totalreceptionists / $recordsPerPage);

            $offset = ($page - 1) * $recordsPerPage;
            $receptionists = array_slice($allReceptionists, $offset, $recordsPerPage);

            $data = [
                'receptionists' => $receptionists,
                'allReceptionists' => $allReceptionists,
                'currentPage' => $page,
                'totalPages' => $totalPages
            ];

            $this->view('admin/searchReceptionist', $data);
    }

    

    public function viewRegdoctor()
    {
      $data =[
        'first_name' => '',
        'last_name' => '',
        'email_address' => '',
        'password' => '',
        'firstname_err' => '',
        'lastname_err' => '',
        'email_err' => '',
        'phonenum_err' => '',
        'password_err' => ''
      ];
      $this->view('admin/regDoctor',$data);
    }

    public function viewReghealthsup()
    {
      $data =[
        'first_name' => '',
        'last_name' => '',
        'email_address' => '',
        'password' => '',
        'firstname_err' => '',
        'lastname_err' => '',
        'email_err' => '',
        'phonenum_err' => '',
        'password_err' => ''
      ];
      $this->view('admin/regHealthsup',$data);
    }

    public function viewReglabtech()
    {
      $data =[
        'first_name' => '',
        'last_name' => '',
        'email_address' => '',
        'password' => '',
        'firstname_err' => '',
        'lastname_err' => '',
        'email_err' => '',
        'phonenum_err' => '',
        'password_err' => ''
      ];
      $this->view('admin/regLabtech',$data);
    }

    public function viewRegnurse()
    {
      $data =[
        'first_name' => '',
        'last_name' => '',
        'email_address' => '',
        'password' => '',
        'firstname_err' => '',
        'lastname_err' => '',
        'email_err' => '',
        'phonenum_err' => '',
        'password_err' => ''
      ];
      $this->view('admin/regNurse',$data);
    }

    public function viewRegpatient()
    {
      $data =[
        'first_name' => '',
        'last_name' => '',
        'email_address' => '',
        'password' => '',
        'firstname_err' => '',
        'lastname_err' => '',
        'email_err' => '',
        'phonenum_err' => '',
        'password_err' => ''
      ];
      $this->view('admin/regPatient',$data);
    }

    public function viewRegpharmacist()
    {
      $data =[
        'first_name' => '',
        'last_name' => '',
        'email_address' => '',
        'password' => '',
        'firstname_err' => '',
        'lastname_err' => '',
        'email_err' => '',
        'phonenum_err' => '',
        'password_err' => ''
      ];
      $this->view('admin/regPharmacist',$data);
    }

    public function viewRegreceptionist()
    {
      $data =[
        'first_name' => '',
        'last_name' => '',
        'email_address' => '',
        'password' => '',
        'firstname_err' => '',
        'lastname_err' => '',
        'email_err' => '',
        'phonenum_err' => '',
        'password_err' => ''
      ];
      $this->view('admin/regReceptionist',$data);
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
          $this->view('admin/regPatient', $data);
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
          redirect('/admin/searchDoctor');
        }
        else
        {
          header("Location: /prescripsmart/general/error_page");
        }
      }
    }
    public function deleteProfileLabtech($id)
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        if($this->userModel->deleteProfileLabtech($id))
        {
          redirect('/admin/searchLabtech');
        }
        else
        {
          header("Location: /prescripsmart/general/error_page");
        }
      }
    }
    public function deleteProfileHealthsup($id)
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        if($this->userModel->deleteProfileHealthsup($id))
        {
          redirect('/admin/searchHealthsup');
        }
        else
        {
          header("Location: /prescripsmart/general/error_page");
        }
      }
    }

    public function deleteProfileNurse($id)
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        if($this->userModel-> deleteProfileNurse($id))
        {
          redirect('/admin/searchNurse');
        }
        else
        {
          header("Location: /prescripsmart/general/error_page");
        }
      }
    }
    public function deleteProfilePatient($id)
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        
        if($this->userModel->deleteProfilePatient($id))
        {
          redirect('/admin/searchPatient');
        }
        else
        {
          header("Location: /prescripsmart/general/error_page");
        }
      }
    }
    public function deleteProfilePharmacist($id)
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        if($this->userModel->deleteProfilePharmacist($id))
        {
          redirect('/admin/searchPharmacist');
        }
        else
        {
          header("Location: /prescripsmart/general/error_page");
        }
      }
    }

    public function deleteProfileReceptionist($id)
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        if($this->userModel->deleteProfileReceptionist($id))
        {
          redirect('/admin/searchReceptionist');
        }
        else
        {
          header("Location: /prescripsmart/general/error_page");
        }
      }
    }

    public function showProfileDoc($id)
    {
     
      $doctor = $this->userModel->getDoctorbyID($id);

      $data= [
        'doctor'=>$doctor
      ]; 
      $this->view('admin/doctorProfile', $data);      

    }

    public function showProfileHealthsup($id)
    {
  
      $healthsup = $this->userModel->getSupervisorbyID($id);

      $data= [
        'healthsup'=>$healthsup
      ];
      $this->view('admin/healthsupProfile', $data);
       
    }

    public function showpatientProfile($id)
    {
  
      $patient = $this->userModel->getPatientbyID($id);

      $data= [
        'patient'=>$patient
      ];
      $this->view('admin/patientProfile', $data);
       
    }

    public function showProfileLabtech($id)
    {
  
      $labtech = $this->userModel->getLabtechbyID($id);

      $data= [
        'labtech'=>$labtech
      ];
      $this->view('admin/labtechProfile', $data);
       

    }
    public function showProfileNurse($id)
    {
     
      $nurse = $this->userModel->getNursebyID($id);

      $data= [
        'nurse'=>$nurse
      ];
      $this->view('admin/nurseProfile', $data);
       

    }
    public function showProfilePatient($id)
    {
      $patient = $this->userModel->getPatientbyID($id);

      $data= [
        'patient'=>$patient
      ];
      $this->view('admin/patientProfile', $data);
       

    }
    public function showProfilePharmacist($id)
    {
 
      $pharmacist = $this->userModel->getPharmacistbyID($id);

      $data= [
        'pharmacist'=>$pharmacist
      ];
      $this->view('admin/pharmacistProfile', $data);
       

    }
    public function showProfileReceptionist($id)
    {

      $receptionist = $this->userModel->getReceptionistbyID($id);

      $data= [
        'receptionist'=>$receptionist
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

  public function account_information()
    {
        $admin = $this->userModel->adminInfo();
        $data = [
            'admin' => $admin
        ];
        $this->view('admin/account_information', $data);
    }

    public function accountInfoUpdate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $this->userModel->updateAccInfo($username);

            header("Location: /prescripsmart/admin/account_information");
            exit();
        }
    }

    public function checkPassword()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $enteredPassword = $_POST["password"];
            $databasePasswordHash = $_SESSION['USER_DATA']->password;

            if (password_verify($enteredPassword, $databasePasswordHash)) {
                echo json_encode(array("match" => true));
            } else {
                echo json_encode(array("match" => false));
            }
        }
    }
    public function passwordReset()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newpassword = $_POST["newpassword"];
            $_SESSION['USER_DATA']->password = password_hash($newpassword, PASSWORD_BCRYPT);
            $this->userModel->resetPassword($newpassword);

            header("Location: /prescripsmart/admin/account_information");
            exit();
        }
    }

    public function personal_information()
    {
        $admin = $this->userModel->adminDetails();
        $user = $this->userModel->adminInfo();
        $data = [
            'admin' => $admin,
            'user' => $user
        ];
        $this->view('admin/personal_information', $data);
    }

    public function personalInfoUpdate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $dname = $_POST["dname"];
            $haddress = $_POST["haddress"];
            $nic = $_POST["nic"];
            $cno = $_POST["cno"];
            $dep = $_POST["dep"];

            $this->userModel->updateInfo($fname, $lname, $dname, $haddress, $nic, $cno,$dep);

            header("Location: /prescripsmart/admin/personal_information");
            exit();
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function security()
    {
        $userID = $_SESSION['USER_DATA']->user_ID;
        $user = $this->userModel->find_user_by_id($userID);
        $data = [
            'user' => $user
        ];
        $this->view('admin/security', $data);
    }

    public function toggle2FA()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['toggle_state'])) {
                $toggleState = $_POST['toggle_state'];
                $userID = $_POST['userID'];

                if ($toggleState == 'on') {
                    $this->userModel->manage2FA($toggleState, $userID);
                } else if ($toggleState == 'off') {
                    $this->userModel->manage2FA($toggleState, $userID);
                }
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Toggle state not provided']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }

    }

    public function updateProfilePicture()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
            $target_dir = "C:/xampp/htdocs/PrescripSmart/public/uploads/profile_images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


            // Check file size
            // if ($_FILES["image"]["size"] > 500000) {
            //     echo "Sorry, your file is too large.";
            //     $uploadOk = 0;
            // }

            //Allow only certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }


            if ($uploadOk == 0) {
                // echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";

                    $image = basename($_FILES["image"]["name"]);

                    $userID = $_SESSION['USER_DATA']->user_ID;
                    $result = $this->userModel->updateProfilePicture($image, $userID);
                    $_SESSION['USER_DATA']->profile_photo = $image;

                    if ($result) {
                        echo json_encode(array("success" => true));
                    } else {
                        echo json_encode(array("success" => false, "message" => "Failed to update profile picture in database"));
                    }
                } else {
                    header("Location: /prescripsmart/general/error_page");
                }
            }
        }
    }

  }