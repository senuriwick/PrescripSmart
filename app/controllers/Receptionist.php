<?php

use Twilio\Rest\Client;

  class Receptionist extends Controller 
  {
    public $repModel;
    public function __construct()
    {
      // if(!isLoggedIn())
      // {
      //   redirect('receptionist/login');
      // }
      $this->repModel = $this->model('M_Receptionist');
    }

    public function index()
    {    
      $posts = $this->repModel->getAppointments();
      $data = [
        'appointments'=> $posts
      ];

      $this->view('receptionist/searchApp', $data);
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
        if($this->repModel->findUserByEmail($data['email_address']))
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
          $loggedInUser = $this->repModel->login($data['email_address'], $data['password']);

          if($loggedInUser)
          {
            // Create Session
            
            $this->createusersession($loggedInUser);           
          } 
          else 
          {
            $this->view('receptionist/login', $data);
          }
        } 
        else
        {
          
          // Load view with errors
          $this->view('receptionist/login', $data);
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
        $this->view('receptionist/login', $data);
        
      }
   }

   public function authenticate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email_address = $_POST["email_address"];
            $password = $_POST["password"];

            $result = $this->repModel->authenticate($email_address, $password);

            if ($result) {
                $_SESSION['USER_DATA'] = $result;
                if (password_verify($password, $result->password)) {
                    if ($result->two_factor_auth == "on") {
                        if ($result->method_of_signin == "Email") {
                            $security_code = $this->generate_OTP(6);
                            $this->repModel->updateCode($security_code, $result->user_ID);
                            $this->send_security_email($result->email_phone, $security_code);
                        } else {
                            $security_code = $this->generate_OTP(6);
                            $this->repModel->updateCode($security_code, $result->user_ID);
                            $this->send_security_sms($result->email_phone, $security_code);
                        }
                        echo json_encode(["success" => true, "two_factor_required" => true]);
                    } else {
                        echo json_encode(["success" => true, "two_factor_required" => false]);
                    }
                } else {
                    echo json_encode(["error" => "Invalid password"]);
                }
            } else {
                echo json_encode(["error" => "Email/Phone Number does not exist"]);
            }
        }
    }

   public function forgot_password()
    {
      $this->view('receptionist/forgot_password');
    }

    public function forgotten_password_reset()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email_phone = $_POST["email"];

            $result = $this->repModel->findUserByEmail($email_phone);

            if (!empty($result)) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["error" => "Sorry! User not found."]);
            }
        }
    }

    public function reset_password()
    {
        $this->view('receptionist/reset_password');
    }

    public function password_recovery()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email_phone = $_POST["email"];

            $result = $this->repModel->findUserByEmail($email_phone);

            if (!empty($result)) {
                if ($result->method_of_signin == "Email") {
                    $this->send_recovery_email($result->email_phone);
                    echo json_encode(["success" => true]);
                } else {
                    $this->send_recovery_message($result->email_phone);
                    echo json_encode(["success" => true]);
                }
            } else {
                echo json_encode(["error" => "Sorry! Please try again later."]);
            }
        }
    }

    public function send_recovery_email($email)
    {
        $recovery_link = "http://localhost/prescripsmart/patient/resetPassword?user=$email";
        $message = <<<MESSAGE
            Hi,
            Please use the following link to reset your password:
            $recovery_link
            MESSAGE;

        require '../PHPMailerAutoload.php';

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'prescripsmart@gmail.com';
        $mail->Password = 'fgpacxjdxjogzlwk';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('prescripsmart@gmail.com', 'Prescripsmart');
        $mail->addAddress($email);
        $mail->isHTML(true);

        $mail->Subject = 'Reset Password of Prescripsmart Account';
        $mail->Body = $message;

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            //echo 'Message has been sent';
        }
    }

    public function send_recovery_message($phone_number)
    {
        require '../vendor/autoload.php';

        $account_sid = 'ACb18f4915d6508e8c112c8f304f009608';
        $auth_token = 'b3aa1aebe6000a185c26365bf692a85b';
        $twilio_number = "+12674227302";

        $client = new Client($account_sid, $auth_token);
        $recovery_link = "http://localhost/prescripsmart/patient/resetPassword?user=$phone_number";
        $client->messages->create(
            $phone_number,
            array(
                'from' => $twilio_number,
                'body' => 'Please use the following link to reset your Prescripsmart account password: ' . $recovery_link
            )
        );
    }

    public function resetPassword()
    {
        $user = $_GET['user'];
        $this->view('patient/resetPassword');
    }

   public function employee_authentication()
  {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email_address = $_POST["email_address"];
            $password = $_POST["password"];

            $result = $this->repModel->employee_authentication($email_address, $password);

            if ($result) {
                $_SESSION['USER_DATA'] = $result;
                if (password_verify($password, $result->password)) 
                {
                    if($result->two_factor_auth == "on"){
                        if($result->method_of_signin == "Email"){
                            $security_code = $this->generate_OTP(6);
                            $this->repModel->updateCode($security_code, $result->user_ID);
                            $this->send_security_email($result->email_phone, $security_code);
                        } else {
                            $security_code = $this->generate_OTP(6);
                            $this->repModel->updateCode($security_code, $result->user_ID);
                            $this->send_security_sms($result->email_phone, $security_code);
                        }
                    echo json_encode(["success" => true, "two_factor_required" => true]);
                } else {
                    echo json_encode(["success" => true, "role" => $result->role, "two_factor_required" => false]);
                }}
                 else {
                    echo json_encode(["error" => "Invalid password"]);
                }
            } else {
                echo json_encode(["error" => "Email/Phone Number does not exist"]);
            }
        }
    }

    public function send_security_email($email, $code)
    {
        $message = <<<MESSAGE
            Hi,
            Please use the following security code to login:
            $code
            MESSAGE;

        require '../PHPMailerAutoload.php';

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'prescripsmart@gmail.com';
        $mail->Password = 'fgpacxjdxjogzlwk';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('prescripsmart@gmail.com', 'Prescripsmart');
        $mail->addAddress($email);
        $mail->isHTML(true);

        $mail->Subject = 'Security Login';
        $mail->Body = $message;

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            //echo 'Message has been sent';
        }
    }

   public function generate_activation_code()
    {
        return bin2hex(random_bytes(16));
    }

    function generate_OTP($length = 6)
    {
        $characters = '0123456789';
        $otp = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $otp .= $characters[rand(0, $max)];
        }
        return $otp;
    }

    public function send_otp($phone_number, $otp)
    {
        require '../vendor/autoload.php';

        $account_sid = 'ACb18f4915d6508e8c112c8f304f009608';
        $auth_token = 'b3aa1aebe6000a185c26365bf692a85b';
        $twilio_number = "+12674227302";

        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            $phone_number,
            array(
                'from' => $twilio_number,
                'body' => 'Please use the following OTP: ' . $otp
            )
        );
    }

    public function resendotp()
    {
        $phone = $_POST['phone'] ?? null;
        $user = $this->repModel->find_user_by_email($phone);
        $userID = $user->user_ID;
        $otp = $this->generate_OTP(6);
        $this->send_otp($phone, $otp);
        $this->repModel->updateOTP($otp, $userID);

        echo json_encode(["success" => true]);
    }

    public function send_activation_email($email, $activation_code)
    {
        $activation_link = "http://localhost/prescripsmart/patient/activate?email=$email&activation_code=$activation_code";
        $message = <<<MESSAGE
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                .header {
                    background-color: #0069ff;
                    color: white;
                    padding: 20px;
                    text-align: center;
                }
                .content {
                    padding: 20px;
                    background-color: #f2f2f2;
                }
                .activation-link {
                    color: #0069ff;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <h2>Welcome to Prescripsmart</h2>
            </div>
            <div class="content">
                <p>Hi,</p>
                <p>Thank you for joining PrescripSmart! To activate your account and start exploring, please click the verification link below:</p>
                <p><a href="$activation_link" class="activation-link">$activation_link</a></p><br>
                <p>Best Regards,</p>
                <p>Team PrescripSmart</p>
            </div>
        </body>
        </html>
        MESSAGE;

        require '../PHPMailerAutoload.php';

        $mail = new PHPMailer;
        //$mail->SMTPDebug = 4;                               // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'prescripsmart@gmail.com';       // SMTP username
        $mail->Password = 'fgpacxjdxjogzlwk';                 // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('prescripsmart@gmail.com', 'Prescripsmart');
        $mail->addAddress($email);     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                     // Set email format to HTML

        $mail->Subject = 'Prescripsmart account activation';
        $mail->Body = $message;
        //$mail->AltBody = $message;

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            //echo 'Message has been sent';
        }
    }


    public function resend_activation_email()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $user = $this->repModel->findUserByEmail($email);
            $activation_code = $this->generate_activation_code();

            $activation_link = "http://localhost/prescripsmart/patient/activate?email=$email&activation_code=$activation_code";
            $message = <<<MESSAGE
            Hey $user->first_Name $user->last_Name,

            Thank you for joining PrescripSmart! To activate your account and start exploring, please click the verification link below:

            $activation_link

            Best Regards,
            Team PrescripSmart
            MESSAGE;

            require '../PHPMailerAutoload.php';

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'prescripsmart@gmail.com';
            $mail->Password = 'fgpacxjdxjogzlwk';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('prescripsmart@gmail.com', 'Prescripsmart');
            $mail->addAddress($email);
            $mail->isHTML(true);

            $mail->Subject = 'Prescripsmart account activation';
            $mail->Body = $message;

            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                header("Location: /prescripsmart/patient/emailverification_2");
                //echo 'Message has been sent';
            }
        }
    }

    public function activate()
    {
        $email = $_GET['email'] ?? null;
        $activatecode = $_GET['activation_code'] ?? null;
        $user = $this->repModel->findUserByEmail($email);

        $currentTimestamp = date('Y-m-d H:i:s');
        if ($user->activation_expiry < $currentTimestamp) {
            $this->repModel->deleteUserByid($user->user_ID);

        } else if ($user->active == 0 && password_verify($activatecode, $user->activation_code)) {
            $this->repModel->activate($email);
            header("Location: /prescripsmart/receptionist/registrationContd?id=$user->user_ID");
        } else {
            header("Location: /prescripsmart/receptionist/login");
        }
    }

    public function send_security_sms($phone, $code)
    {
        require '../vendor/autoload.php';

        $account_sid = 'ACb18f4915d6508e8c112c8f304f009608';
        $auth_token = 'b3aa1aebe6000a185c26365bf692a85b';
        $twilio_number = "+12674227302";

        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            $phone,
            array(
                'from' => $twilio_number,
                'body' => 'Please use the following OTP: ' . $code
            )
        );
    }

    public function registrationContd()
    {
        $userID = $_GET["id"];

        if ($userID !== null) {
            $user = $this->repModel->findUserByid($userID);
            $data = [
                'user' => $user
            ];
            $this->repModel->receptionistRegistration($user->user_ID, $user->first_Name, $user->last_Name, $user->email_phone);
            $this->view('patient/registrationContd', $data);
            exit;
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function emailregistrationContd()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $NIC = $_POST['nic'];
                $DOB = $_POST['dob'];
                $age = $_POST['age'];
                $address = $_POST['address'];
                $phone = $_POST['phoneNo'];
                $id = $_POST['id'];

                $this->repModel->patientRegistration_02($NIC, $DOB, $age, $address, $phone, $id);
                header("Location: /prescripsmart/patient/registrationContd_02?id=$id");
                exit;
            }
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }

    public function searchAppointment()
    {
      $posts = $this->repModel->getAppointments();
      $data = [
        'appointments'=> $posts
      ];

      $this->view('receptionist/searchApp', $data);
    }

    public function addAppointment()
    {
      $posts = $this->repModel->getDoctors();
      $ses_info = $this->repModel->getdocSessions();
      $data = [
        'doctors'=> $posts,
        'sessions'=> $ses_info
      ];

      $this->view('receptionist/addApp', $data);
    }

    public function create_appointment()
    {
        $session_ID = $_GET['sessionID'] ?? null;

        if ($session_ID != null) {

            $selectedSession = $this->repModel->getSessionDetails($session_ID);
            $posts = $this->repModel->getPatients();
            $selectedDoctor = $this->repModel->getDoctorDetails($selectedSession->doctor_ID);

            $data = [
                'selectedSession' => $selectedSession,
                'patients' => $posts,
                'selectedDoctor'=> $selectedDoctor
            ];
            $this->view('receptionist/appointPatient',$data);           
            

        } else {
            echo "Session ID not provided";
        }

    }

    public function confirm_patient()
    {
        $session_ID = $_GET['sessionID'] ?? null;
        $patient_ID = $_GET['patientID'] ?? null;
        $doctor_ID = $_GET['doctorID'] ?? null;

        if($patient_ID != null)
        {
          if ($session_ID != null) {

            $selectedSession = $this->repModel->getSessionDetails($session_ID);
            $posts = $this->repModel->getPatientDetails($patient_ID);
            $selectedDoctor = $this->repModel->getDoctorDetails($doctor_ID);

            $data = [
                'selectedSession' => $selectedSession,
                'selectedPatient' => $posts,
                'selectedDoctor'=> $selectedDoctor
            ];
            $this->view('receptionist/confirmApp', $data);
            
            } else {
                echo "Session not found";
            }

        }
        else{
          echo"Patient not found";
        }

    }

    public function confirm_appointment()
    {
      $session_ID = $_GET['sessionID'] ?? null;
      $patient_ID = $_GET['patientID'] ?? null;
      $doctor_ID = $_GET['doctorID'] ?? null;
      

      if($patient_ID != null)
        {
          if ($session_ID != null) {

            $selectedSession = $this->repModel->getSessionDetails($session_ID);
            $posts = $this->repModel->getPatientDetails($patient_ID);
            $selectedDoctor = $this->repModel->getDoctorDetails($doctor_ID);
            $posts = $this->repModel->getAppointments();


            $data = [
                'patient_id' => $patient_ID,
                'session_id' => $session_ID,
                'doctor_id' => $doctor_ID,
                'app_date'=> $selectedSession->sessionDate,
                'app_time'=> $selectedSession->start_time,
                'amount'=> $selectedSession->sessionCharge,
            ];

            $apps = [
              'appointments'=>$posts
            ];

            $Appointment = $this->repModel->confirm_appointment($data);

            if($Appointment)
            {
              $this->view('receptionist/searchApp',$apps);
            }
            else
            {
              echo "Something went wrong";
            }
            
            
            } else {
                echo "Session not found";
            }

        }
        else{
          echo"Patient not found";
        }

    }

    public function sessionManage()
    {
      $posts = $this->repModel->getdocSessions();
      $data = [
          'sessions' => $posts
      ];

      $this->view('receptionist/manageSessions',$data);
    }


    public function searchPatient()
    {
      $posts = $this->repModel->getPatients();
      $data = [
        'patients'=> $posts
      ];

      $this->view('receptionist/searchPatient', $data);
    }

    public function searchDoctor()
    {
      $posts = $this->repModel->getDoctors();
      $data = [
        'doctors'=> $posts
      ];

      $this->view('receptionist/searchDoctor', $data);
    }

    public function searchNurse()
    {
      $posts = $this->repModel->getNurses();
      $data = [
        'nurses'=> $posts
      ];


      $this->view('receptionist/searchNurse', $data);
    }

    public function account_info()
    {
      $receptionist = $this->repModel->receptionistInfo();
        $data = [
            'receptionist' => $receptionist
        ];
      $this->view('receptionist/account_information' ,$data);
    }

    public function security()
    {
      $this->view('receptionist/security');
    }

    public function personal_info()
    {
      $this->view('receptionist/personal_info');
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
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        if($this->repModel->deleteProfileDoc($id))
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
        if($this->repModel-> deleteProfileNurse($id))
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
        if($this->repModel->deleteProfilePatient($id))
        {
          echo"Profile sucessfully deleted";
        }
        else
        {
          echo"something went wrong";
        }
      }
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
          if($this->repModel->findUserByEmail($data['email']))
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
          if($this->repModel->regDoctor($data))
          {
            // flash('register_success', 'You are registered and can log in');
            redirect('/receptionist/searchDoctor');
           
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
       $this->view('receptionist/register_email', $data);
       
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
          if($this->repModel->findUserByEmail($data['email']))
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
          if($this->repModel->regNurse($data))
          {
            // flash('register_success', 'You are registered and can log in');
            redirect('/receptionist/searchNurse');
          }
           else 
          {
            die('Something went wrong');
          }

        } 
        else
        {
          // Load view with errors
          $this->view('receptionist/register_email', $data);
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
        $this->view('receptionist/register_email', $data);
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
          if($this->repModel->findUserByEmail($data['email']))
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
          if($this->repModel->regPatient($data))
          {
            // flash('register_success', 'You are registered and can log in');
            redirect('/receptionist/searchPatient');
          }
           else 
          {
            die('Something went wrong');
          }

        } 
        else
        {
          // Load view with errors
          $this->view('receptionist/register_email', $data);
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
      $doctor = $this->repModel->getuserbyID($id,$table);

      $data= [
        'doctor'=>$doctor
      ];
      $this->view('receptionist/doctorProfile', $data);      

    }

    public function showProfileNurse($id)
    {
      $table= 'nurses';
      $nurse = $this->repModel->getuserbyID($id,$table);

      $data= [
        'doctor'=>$nurse
      ];
      $this->view('receptionist/nurseProfile', $data);
       
    }

    public function showProfilePatient($id)
    {
      $table = 'patients';
      $patient = $this->repModel->getuserbyID($id,$table);

      $data= [
        'doctor'=>$patient
      ];
      $this->view('receptionist/patientProfile', $data);

    }

    public function accountInfoUpdate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $this->repModel->updateAccInfo($username, $_SESSION['USER_DATA']->user_ID);

            header("Location: /prescripsmart/patient/account_information");
            exit();
        }
    }

  }
