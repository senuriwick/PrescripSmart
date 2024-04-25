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
    $this->userModel = $this->model('M_Receptionist');

  }

  public function index()
  {

    $this->view('receptionist/addApp');
  }

  public function login()
  {
    // Check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Process form
      // Sanitize POST data
      //Then run the form
      //define('FILTER_SANITIZE_STRING', 513);

      // Now, instead of using the constant, you can use the integer value directly
      $_POST = filter_input_array(INPUT_POST, 513);

      // Init data
      $data = [
        'email_address' => trim($_POST['email_address']),
        'password' => trim($_POST['password']),
        'emailaddress_err' => '',
        'password_err' => '',
      ];

      // Validate Email
      if (empty($data['email_address'])) {
        $data['emailaddress_err'] = 'Please enter email address';
      }

      // Validate Password
      if (empty($data['password'])) {
        $data['password_err'] = 'Please enter password';
      }

      // Check for user/email
      if ($this->userModel->findUserByEmail($data['email_address'])) {
        // User found
      } else {
        // User not found
        $data['emailaddress_err'] = 'No user found';
      }

      // Make sure errors are empty
      if (empty($data['emailaddress_err']) && empty($data['password_err'])) {
        // Validated
        // Check and set logged in user
        $loggedInUser = $this->userModel->login($data['email_address'], $data['password']);

        if ($loggedInUser) {
          // Create Session
          $this->createusersession($loggedInUser);

        } else {
          $this->view('receptionist/login', $data);
        }
      } else {

        // Load view with errors
        $this->view('receptionist/login', $data);
      }


    } else {
      // Init data
      $data = [
        'email' => '',
        'password' => '',
        'email_err' => '',
        'password_err' => '',
      ];

      // Load view
      $this->view('receptionist/login', $data);

    }


  }

  public function searchAppointment()
  {
    $posts = $this->userModel->getAppointments();
    $data = [
      'appointments' => $posts
    ];

    $this->view('receptionist/searchApp', $data);
  }

  public function addAppointment()
  {
    $posts = $this->userModel->getDoctors();
    $ses_info = $this->userModel->getdocSessions();
    $data = [
      'doctors' => $posts,
      'sessions' => $ses_info
    ];

    $this->view('receptionist/addApp', $data);
  }

  public function create_appointment()
  {
    $session_ID = $_GET['sessionID'] ?? null;

    if ($session_ID != null) {

      $selectedSession = $this->userModel->getSessionDetails($session_ID);
      $posts = $this->userModel->getPatients();
      $selectedDoctor = $this->userModel->getDoctorDetails($selectedSession->doctor_id);

      $data = [
        'selectedSession' => $selectedSession,
        'patients' => $posts,
        'selectedDoctor' => $selectedDoctor
      ];



    } else {
      echo "Session ID not provided";
    }

  }

  public function confirm_patient()
  {
    $session_ID = $_GET['sessionID'] ?? null;
    $patient_ID = $_GET['patientID'] ?? null;
    $doctor_ID = $_GET['doctorID'] ?? null;

    if ($patient_ID != null) {
      if ($session_ID != null) {

        $selectedSession = $this->userModel->getSessionDetails($session_ID);
        $posts = $this->userModel->getPatientDetails($patient_ID);
        $selectedDoctor = $this->userModel->getDoctorDetails($doctor_ID);

        $data = [
          'selectedSession' => $selectedSession,
          'selectedPatient' => $posts,
          'selectedDoctor' => $selectedDoctor
        ];
        $this->view('receptionist/confirmApp', $data);

      } else {
        echo "Session not found";
      }

    } else {
      echo "Patient not found";
    }

  }

  public function confirm_appointment()
  {
    $session_ID = $_GET['sessionID'] ?? null;
    $patient_ID = $_GET['patientID'] ?? null;
    $doctor_ID = $_GET['doctorID'] ?? null;


    if ($patient_ID != null) {
      if ($session_ID != null) {

        $selectedSession = $this->userModel->getSessionDetails($session_ID);
        $posts = $this->userModel->getPatientDetails($patient_ID);
        $selectedDoctor = $this->userModel->getDoctorDetails($doctor_ID);

        $data = [
          'patient_id' => $patient_ID,
          'doctor_id' => $doctor_ID,
          'app_date' => $selectedSession->date,
          'app_time' => $selectedSession->start_time,
          'amount' => $selectedDoctor->visit_price
        ];

        $Appointment = $this->userModel->confirm_appointment($data);

        if ($Appointment) {
          echo "Appointment fixed successfully";
        } else {
          echo "Something went wrong";
        }


      } else {
        echo "Session not found";
      }

    } else {
      echo "Patient not found";
    }




  }

  public function sessionManage()
  {
    $posts = $this->userModel->getSessions();
    $data = [
      'sessions' => $posts
    ];

    $this->view('receptionist/manageSessions', $data);
  }


  public function searchPatient()
  {
    $posts = $this->userModel->getPatients();
    $data = [
      'patients' => $posts
    ];

    $this->view('receptionist/searchPatient', $data);
  }

  public function searchDoctor()
  {
    $posts = $this->userModel->getDoctors();
    $data = [
      'doctors' => $posts
    ];

    $this->view('receptionist/searchDoctor', $data);
  }

  public function searchNurse()
  {
    $posts = $this->userModel->getNurses();
    $data = [
      'nurses' => $posts
    ];


    $this->view('receptionist/searchNurse', $data);
  }

  public function viewregDoctor()
  {
    $this->view('receptionist/regDoctor');
  }

  public function viewregNurse()
  {
    $this->view('receptionist/regNurse');
  }

  public function viewregPatient()
  {
    $this->view('receptionist/regPatient');
  }

  public function deleteProfileDoc($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->userModel->deleteProfileDoc($id)) {
        echo "Profile sucessfully deleted";
      } else {
        echo "something went wrong";
      }
    }
  }

  public function deleteProfileNurse($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->userModel->deleteProfileNurse($id)) {
        echo "Profile sucessfully deleted";
      } else {
        echo "something went wrong";
      }
    }
  }

  public function deleteProfilePatient($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->userModel->deleteProfilePatient($id)) {
        echo "Profile sucessfully deleted";
      } else {
        echo "something went wrong";
      }
    }
  }

  public function regDoctor()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter email address';
      } else {
        // Check email
        if ($this->userModel->findUserByEmail($data['email'])) {

          $data['email_err'] = 'Email is already taken';
        }
      }

      // Validate First Name
      if (empty($data['first_name'])) {
        $data['firstname_err'] = 'Please enter first name';
      }

      if (empty($data['last_name'])) {
        $data['lastname_err'] = 'Please enter last name';
      }

      // Validate Email address
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter valid email address';

      }

      if (empty($data['phone_number'])) {
        $data['phonenum_err'] = 'Please enter valid email address';

      } else if (strlen($data['password']) < 6) {
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
      if (empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['phonenum_err']) && empty($data['email_err']) && empty($data['password_err'])) {
        // Hash Password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // Register User
        if ($this->userModel->regDoctor($data)) {
          // flash('register_success', 'You are registered and can log in');
          redirect('/receptionist/searchDoctor');

        } else {
          die('Something went wrong');

        }

      } else {
        // Load view with errors
        $this->view('admin/register_email', $data);

      }

    } else //if request method is not post
    {
      // Init data
      $data = [
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
      $this->view('receptionist/register_email', $data);

    }



  }

  public function regNurse()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter email address';
      } else {
        // Check email
        if ($this->userModel->findUserByEmail($data['email'])) {

          $data['email_err'] = 'Email is already taken';
        }
      }

      // Validate First Name
      if (empty($data['first_name'])) {
        $data['firstname_err'] = 'Please enter first name';
      }

      if (empty($data['last_name'])) {
        $data['lastname_err'] = 'Please enter last name';
      }

      // Validate Email address
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter valid email address';

      }

      if (empty($data['phone_number'])) {
        $data['phonenum_err'] = 'Please enter valid email address';

      } elseif (strlen($data['password']) < 6) {
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
      if (empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['phonenum_err']) && empty($data['email_err']) && empty($data['password_err'])) {
        // Hash Password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // Register User
        if ($this->userModel->regNurse($data)) {
          // flash('register_success', 'You are registered and can log in');
          redirect('/receptionist/searchNurse');
        } else {
          die('Something went wrong');
        }

      } else {
        // Load view with errors
        $this->view('receptionist/register_email', $data);
      }

    } else {
      // Init data
      $data = [
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
      $this->view('receptionist/register_email', $data);
    }



  }

  public function regPatient()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter email address';
      } else {
        // Check email
        if ($this->userModel->findUserByEmail($data['email'])) {

          $data['email_err'] = 'Email is already taken';
        }
      }

      // Validate First Name
      if (empty($data['first_name'])) {
        $data['firstname_err'] = 'Please enter first name';
      }

      if (empty($data['last_name'])) {
        $data['lastname_err'] = 'Please enter last name';
      }

      // Validate Email address
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter valid email address';

      }

      if (empty($data['phone_number'])) {
        $data['phonenum_err'] = 'Please enter valid email address';

      } elseif (strlen($data['password']) < 6) {
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
      if (empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['phonenum_err']) && empty($data['email_err']) && empty($data['password_err'])) {
        // Hash Password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // Register User
        if ($this->userModel->regPatient($data)) {
          // flash('register_success', 'You are registered and can log in');
          redirect('/receptionist/searchPatient');
        } else {
          die('Something went wrong');
        }

      } else {
        // Load view with errors
        $this->view('receptionist/register_email', $data);
      }

    } else {
      // Init data
      $data = [
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
      $this->view('receptionist/register_email', $data);
    }

  }

  public function createusersession($user)
  {
    $_SESSION['email_address'] = $user->email_address;
    $_SESSION['first_name'] = $user->first_name;
    redirect('/receptionist/searchApp');
  }

  public function showProfileDoc($id)
  {
    $table = 'doctors';
    $doctor = $this->userModel->getuserbyID($id, $table);

    $data = [
      'doctor' => $doctor
    ];
    $this->view('receptionist/doctorProfile', $data);

  }

  public function showProfileNurse($id)
  {
    $table = 'nurses';
    $nurse = $this->userModel->getuserbyID($id, $table);

    $data = [
      'doctor' => $nurse
    ];
    $this->view('receptionist/nurseProfile', $data);

  }

  public function showProfilePatient($id)
  {
    $table = 'patients';
    $patient = $this->userModel->getuserbyID($id, $table);

    $data = [
      'doctor' => $patient
    ];
    $this->view('receptionist/patientProfile', $data);

  }

  public function account_information()
  {
    $receptionist = $this->userModel->receptionistInfo();
    $data = [
      'receptionist' => $receptionist
    ];
    $this->view('receptionist/account_information', $data);
  }

  public function accountInfoUpdate()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = $_POST["username"];
      $this->userModel->updateAccInfo($username);

      header("Location: /prescripsmart/receptionist/account_information");
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
      

      header("Location: /prescripsmart/receptionist/account_information");
      exit();
    }
  }

  public function personal_information()
  {
    $receptionist = $this->userModel->receptionistDetails();
    $user = $this->userModel->receptionistInfo();
    $data = [
      'receptionist' => $receptionist,
      'user' => $user
    ];
    $this->view('receptionist/personal_information', $data);
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
      $regno = $_POST["regno"];
      $qual = $_POST["qual"];
      $spec = $_POST["spec"];
      $dep = $_POST["dep"];

      $this->userModel->updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $regno, $qual, $spec, $dep);

      header("Location: /prescripsmart/receptionist/personal_information");
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
    $this->view('receptionist/security', $data);
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
