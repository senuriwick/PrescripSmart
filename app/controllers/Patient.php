<?php

use Twilio\Rest\Client;

class Patient extends Controller
{
    private $patientModel;
    public function __construct()
    {
        $this->patientModel = $this->model('M_Patient');
    }

    public function index()
    {
        // $this->view('doctor/patients');
    }

    public function registration()
    {
        $this->view('patient/registration');
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
        // use Twilio\Rest\Client;

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
        $user = $this->patientModel->find_user_by_email($phone);
        $userID = $user->user_ID;
        $otp = $this->generate_OTP(6);
        $this->send_otp($phone, $otp);
        $this->patientModel->updateOTP($otp, $userID);

        echo json_encode(["success" => true]);
    }

    public function send_activation_email($email, $activation_code)
    {
        // create the activation link
        $activation_link = "http://localhost/prescripsmart/patient/activate?email=$email&activation_code=$activation_code";
        $message = <<<MESSAGE
            Hi,
            Please click the following link to activate your account:
            $activation_link
            MESSAGE;

        require '../PHPMailerAutoload.php';

        $mail = new PHPMailer;
        //$mail->SMTPDebug = 4;                               // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'annabethwalker22@gmail.com';       // SMTP username
        $mail->Password = 'loezmkkmqombsiyb';                 // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('annabethwalker22@gmail.com', 'Prescripsmart');
        $mail->addAddress($email);     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                     // Set email format to HTML

        $mail->Subject = 'Please activate your account';
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
            $activation_code = $this->generate_activation_code();


            // create the activation link
            $activation_link = "http://localhost/prescripsmart/patient/activate?email=$email&activation_code=$activation_code";
            $message = <<<MESSAGE
            Hi,
            Please click the following link to activate your account:
            $activation_link
            MESSAGE;

            require '../PHPMailerAutoload.php';

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'annabethwalker22@gmail.com';
            $mail->Password = 'loezmkkmqombsiyb';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('annabethwalker22@gmail.com', 'Prescripsmart');
            $mail->addAddress($email);
            $mail->isHTML(true);

            $mail->Subject = 'Please activate your account';
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
        $user = $this->patientModel->find_user_by_email($email);

        $currentTimestamp = date('Y-m-d H:i:s');
        if ($user->activation_expiry < $currentTimestamp) {
            $this->patientModel->delete_user_by_id($user->user_ID);

        } else if ($user->active == 0 && password_verify($activatecode, $user->activation_code)) {
            $this->patientModel->activate($email);
            header("Location: /prescripsmart/patient/registrationContd?id=$user->user_ID");
        } else {
            header("Location: /prescripsmart/patient/login");
        }
    }

    public function registerwithEmail()
    {
        $this->view('patient/registerwithEmail');
    }
    public function registrationEmail()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $first_name = $_POST["first_name"];
                $last_name = $_POST["last_name"];
                $email_address = $_POST["email_address"];
                $password = $_POST["password"];

                $result = $this->patientModel->find_user_by_email($email_address);

                if ($result) {
                    echo json_encode(["error" => "User already exists!"]);
                } else {
                    $activation_code = $this->generate_activation_code();
                    //$expiry = 1 * 24 * 60 * 60;
                    $reference = $this->patientModel->register($first_name, $last_name, $email_address, $password, $activation_code);
                    $this->send_activation_email($email_address, $activation_code);
                    echo json_encode(["success" => true, "reference" => $reference]);
                }
            }
        } catch (Exception $e) {
            // Log or handle the exception
            error_log($e->getMessage());
            echo json_encode(["error" => "An error occurred. Please try again later."]);
        }

    }

    public function registrationContd()
    {
        $userID = $_GET["id"];

        if ($userID !== null) {
            $user = $this->patientModel->find_user_by_id($userID);
            $data = [
                'user' => $user
            ];
            $this->patientModel->patientRegistration($user->user_ID, $user->first_Name, $user->last_Name, $user->email_phone);
            $this->view('patient/registrationContd', $data);
            exit;
        } else {
            echo "User ID not provided";
        }
    }

    public function registrationContd_02()
    {
        $userID = $_GET["id"];

        if ($userID !== null) {
            $user = $this->patientModel->find_user_by_id($userID);
            $data = [
                'user' => $user
            ];
            $this->view('patient/registrationContd_02', $data);
            exit;
        } else {
            echo "User ID not provided";
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

                //$user = $this->patientModel->find_user_by_id($id);
                //$this->patientModel->patientRegistration($user->user_ID, $user->first_Name, $user->last_Name, $user->email_phone);
                $this->patientModel->patientRegistration_02($NIC, $DOB, $age, $address, $phone, $id);
                header("Location: /prescripsmart/patient/registrationContd_02?id=$id");
                exit;
            }
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }

    public function emailregistrationContd_02()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $gender = $_POST['gender'];
                $weight = $_POST['weight'];
                $height = $_POST['height'];
                $emergency = $_POST['emergency'];
                $phoneNo = $_POST['phoneNo'];
                $id = $_POST['id'];

                $this->patientModel->patientRegistration_03($gender, $weight, $height, $emergency, $phoneNo, $id);
                header("Location: /prescripsmart/patient/registrationCompleted");
                exit;
            }
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }

    public function registrationCompleted()
    {
        $this->view('/patient/registrationCompleted');
    }

    public function emailverification()
    {
        $user_ID = $_GET['reference'] ?? null;

        if ($user_ID !== null) {
            $user = $this->patientModel->find_user_by_id($user_ID);
            $data = [
                'user' => $user
            ];
            //$this->send_activation_email($user->email_phone, $user->activation_code);
            $this->view('patient/emailverification', $data);
        } else {
            echo "User ID not provided";
        }
    }

    public function emailverification_2()
    {
        $this->view('patient/emailverification_2');
    }

    public function registerwithPhone()
    {
        $this->view('patient/registerwithPhone');
    }

    public function registrationPhone()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $first_name = $_POST["first_name"];
                $last_name = $_POST["last_name"];
                $phone_number = $_POST["phone_number"];
                $password = $_POST["password"];

                $result = $this->patientModel->find_user_by_email($phone_number);

                if ($result) {
                    echo json_encode(["error" => "User already exists!"]);
                } else {
                    $otp = $this->generate_OTP(6);
                    //$expiry = 1 * 24 * 60 * 60;
                    $reference = $this->patientModel->registerPhone($first_name, $last_name, $phone_number, $password, $otp);
                    $this->send_otp($phone_number, $otp);
                    echo json_encode(["success" => true, "reference" => $reference]);
                }
            }
        } catch (Exception $e) {
            // Log or handle the exception
            error_log($e->getMessage());
            echo json_encode(["error" => "An error occurred. Please try again later."]);
        }

    }

    public function phoneverification()
    {
        $user_ID = $_GET['reference'] ?? null;

        if ($user_ID !== null) {
            $user = $this->patientModel->find_user_by_id($user_ID);
            $data = [
                'user' => $user
            ];
            //$this->send_activation_email($user->email_phone, $user->activation_code);
            $this->view('patient/phoneverification', $data);
        } else {
            echo "User ID not provided";
        }
    }

    public function verifyotp()
    {
        $phone = $_POST['phone'] ?? null;
        $activatecode = $_POST['code'] ?? null;
        $user = $this->patientModel->find_user_by_email($phone);

        $currentTimestamp = date('Y-m-d H:i:s');
        if ($user->activation_expiry < $currentTimestamp) {
            $this->patientModel->delete_user_by_id($user->user_ID);

        } else if ($user->active == 0 && password_verify($activatecode, $user->activation_code)) {
            $this->patientModel->activate($phone);
            header("Location: /prescripsmart/patient/registrationContd_?id=$user->user_ID");
        } else {
            header("Location: /prescripsmart/patient/login");
        }
    }

    public function registrationContd_()
    {
        $userID = $_GET["id"];

        if ($userID !== null) {
            $user = $this->patientModel->find_user_by_id($userID);
            $data = [
                'user' => $user
            ];
            $this->patientModel->patientRegistrationPhone($user->user_ID, $user->first_Name, $user->last_Name, $user->email_phone);
            $this->view('patient/registrationContd_', $data);
            exit;
        } else {
            echo "User ID not provided";
        }
    }

    public function phoneregistrationContd()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $NIC = $_POST['nic'];
                $DOB = $_POST['dob'];
                $age = $_POST['age'];
                $address = $_POST['address'];
                $email = $_POST['email'];
                $id = $_POST['id'];

                //$user = $this->patientModel->find_user_by_id($id);
                //$this->patientModel->patientRegistration($user->user_ID, $user->first_Name, $user->last_Name, $user->email_phone);
                $this->patientModel->patientRegistration_02Phone($NIC, $DOB, $age, $address, $email, $id);
                header("Location: /prescripsmart/patient/registrationContd_02?id=$id");
                exit;
            }
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }

    public function login()
    {
        $this->view('patient/login');
    }

    public function authenticate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email_address = $_POST["email_address"];
            $password = $_POST["password"];

            $result = $this->patientModel->authenticate($email_address, $password);

            if ($result) {
                $_SESSION['USER_DATA'] = $result;
                if (password_verify($password, $result->password)) {
                    if($result->two_factor_auth == "on"){
                        if($result->method_of_signin == "Email"){
                            $security_code = $this->generate_OTP(6);
                            $this->patientModel->updateCode($security_code, $result->user_ID);
                            $this->send_security_email($result->email_phone, $security_code);
                        } else {
                            $security_code = $this->generate_OTP(6);
                            $this->patientModel->updateCode($security_code, $result->user_ID);
                            $this->send_security_sms($result->email_phone, $security_code);
                        }
                        echo json_encode(["success" => true, "two_factor_required" => true]);
                    } else {
                        echo json_encode(["success" => true, "two_factor_required" => false]);
                    }
                    //session_start();
                    //$_SESSION['user_ID'] = $result->user_ID;
                } else {
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
        $mail->Username = 'annabethwalker22@gmail.com';       
        $mail->Password = 'loezmkkmqombsiyb';                 
        $mail->SMTPSecure = 'tls';                            
        $mail->Port = 587;                                    

        $mail->setFrom('annabethwalker22@gmail.com', 'Prescripsmart');
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

    public function resend_security_email()
    {
        $email = $_POST['emailPhone'];
        $security_code = $this->generate_OTP(6);
        $this->patientModel->updateCode($security_code, $email);
        $this->send_security_email($email, $security_code);
        echo json_encode(["success" => true]);
    }

    public function resend_security_sms()
    {
        $phone = $_POST['emailPhone'];
        $security_code = $this->generate_OTP(6);
        $this->patientModel->updateCode($security_code, $phone);
        $this->send_security_sms($phone, $security_code);
        echo json_encode(["success" => true]);
    }

    public function inquiries_dashboard()
    {
        $this->view('patient/inquiries_dashboard');
    }

    public function inquiries()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $name = $_POST["name"];
            $message = $_POST["message"];
            
            $inquirySaved = $this->patientModel->inquiries($_SESSION['USER_DATA']->user_ID, $email, $name, $message);
    
            if ($inquirySaved) {
                echo json_encode(array("success" => true));
            } else {
                echo json_encode(array("success" => false, "message" => "Failed to save the inquiry."));
            }
            
            exit();
        }
    }
    
    public function appointments_dashboard()
    {
        $appointments = $this->patientModel->getAppointments();
        $data = [
            'appointments' => $appointments
        ];
        $this->view('patient/appointments_dashboard', $data);
    }

    public function view_appointment()
    {
        $appointment_ID = $_GET['appointment_id'] ?? null;

        if ($appointment_ID !== null) {
            $appointment = $this->patientModel->viewAppointment($appointment_ID);
            $data = [
                'appointment' => $appointment
            ];
            $this->view('patient/view_appointment', $data);
        } else {
            echo "Appointment ID not provided";
        }

        // $this->patientModel->deleteAppointment();
        // header("Location: /prescripsmart/patient/appointment_cancelled");
    }

    public function delete_appointment(int $appointment_ID)
    {
        $this->patientModel->deleteAppointment($appointment_ID);
        header("Location: /prescripsmart/patient/appointment_cancelled");
    }

    public function new_appointment()
    {
        $doctors = $this->patientModel->searchDoctor();
        $data = [
            'doctors' => $doctors
        ];
        $this->view('patient/new_appointment', $data);
    }

    public function appointment_reservation(int $patient_ID, int $doctor_ID, int $session_ID, $time, $date)
    {
        $referrence = $this->patientModel->confirmAppointment($patient_ID, $doctor_ID, $session_ID, $time, $date);
        header("Location: /prescripsmart/patient/appointment_complete?referrence=$referrence");
    }

    public function doctor_sessions()
    {
        $doctor_ID = $_GET['doctor_ID'] ?? null;

        if ($doctor_ID !== null) {
            $session = $this->patientModel->docSession($doctor_ID);
            $data = [
                'session' => $session
            ];
            $this->view('patient/doctor_sessions', $data);
        } else {
            echo "Doctor ID not provided";
        }
    }

    public function appointment_confirmation()
    {
        $session_ID = $_GET['sessionID'] ?? null;

        if ($session_ID != null) {

            $selectedSession = $this->patientModel->getSessionDetails($session_ID);
            $data = [
                'selectedSession' => $selectedSession
            ];
            $this->view('patient/appointment_confirmation', $data);
            // $referrence = $this->patientModel->confirmAppointment();
        } else {
            echo "Session ID not provided";
        }

        // // var_dump($_POST);
        // $referrence = $this->patientModel->confirmAppointment(); 
        // header("Location: /prescripsmart/patient/appointment_complete?referrence=$referrence");
    }

    public function appointment_complete()
    {
        $referrence = $_GET['referrence'] ?? null;
        $appointment = $this->patientModel->appointment($referrence);
        $patient = $this->patientModel->patientInfo($appointment->patient_ID);
        $merchant_id = 1226371;
        $order_id = $appointment->appointment_ID;
        $amount = "1000";
        $currency = "LKR";
        $merchant_secret = 'MTMzMjU4MTIxODMwMjE1OTE3MDIxOTQxMzUxMDM3NzkxMDIzNDI=';

        $hash = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                number_format($amount, 2, '.', '') . 
                $currency .  
                strtoupper(md5($merchant_secret)) 
            ) 
        );
        $data = [
            'appointment' => $appointment,
            'hash' => $hash,
            'patient' => $patient
        ];
        $this->view('patient/appointment_complete', $data);
    }

    public function notify_url()
    {
        $merchant_id = $_POST['merchant_id'];
        $order_id = $_POST['order_id'];
        $payhere_amount = $_POST['payhere_amount'];
        $payment_id = $_POST['payment_id'];
        $method = $_POST['method'];
        $payhere_currency = $_POST['payhere_currency'];
        $status_code = $_POST['status_code'];
        $md5sig = $_POST['md5sig'];
        

        $merchant_secret = 'MTMzMjU4MTIxODMwMjE1OTE3MDIxOTQxMzUxMDM3NzkxMDIzNDI=';

        $local_md5sig = strtoupper(
            md5(
                $merchant_id .
                $order_id .
                $payhere_amount .
                $payhere_currency .
                $status_code .
                strtoupper(md5($merchant_secret))
            )
        );

        if (($local_md5sig === $md5sig) and ($status_code == 2)) {
            $this->patientModel->updatePayment($order_id, $payment_id, $method);
        }
    }

    public function update_payment()
    {
        $appointment_ID = $_POST['orderId'];
        $this->patientModel->updatePayment($appointment_ID);
    }


    public function appointment_cancelled()
    {
        $this->view('patient/appointment_cancelled');
    }

    public function prescriptions_dashboard()
    {
        $prescriptions = $this->patientModel->prescriptions();
        $data = [
            'prescriptions' => $prescriptions
        ];
        $this->view('patient/prescriptions_dashboard', $data);
    }

    public function reports_dashboard()
    {
        $reports = $this->patientModel->labreports();
        $data = [
            'reports' => $reports
        ];
        $this->view('patient/reports_dashboard', $data);
    }

    public function qr_download()
    {
        $this->view('patient/qr_download');
    }

    public function public_prescriptionView()
    {
        $prescription_ID = $_GET['prescription'] ?? null;
        $prescriptions = $this->patientModel->viewPrescription($prescription_ID);
        $data = [
            'prescription' => $prescriptions
        ];

        $this->view('patient/public_prescriptionView', $data);
    }

    public function updateDownloadCount($reportId)
    {
        $this->patientModel->updateDownloadCount($reportId);
    }

    public function account_information()
    {
        $patient = $this->patientModel->patientInfo();
        $data = [
            'patient' => $patient
        ];
        $this->view('patient/account_information', $data);
    }

    public function accountInfoUpdate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            // $password = $_POST["password"];
            // $newpassword = $_POST["newpassword"];

            $this->patientModel->updateAccInfo($username);

            header("Location: /prescripsmart/patient/account_information");
            exit();
        }
    }

    public function passwordReset()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newpassword = $_POST["newpassword"];

            $this->patientModel->resetPassword($newpassword);

            header("Location: /prescripsmart/patient/account_information");
            exit();
        }
    }

    public function personal_information()
    {
        $patient = $this->patientModel->patientInfo();
        $data = [
            'patient' => $patient
        ];
        $this->view('patient/personal_information', $data);
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
            $dob = $_POST["dob"];
            $age = $_POST["age"];
            $gender = $_POST["gender"];
            $height = $_POST["height"];
            $weight = $_POST["weight"];
            $ename = $_POST["ename"];
            $econtact = $_POST["econtact"];
            $relationship = $_POST["relationship"];

            $this->patientModel->updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $dob, $age, $gender, $height, $weight, $ename, $econtact, $relationship);

            header("Location: /prescripsmart/patient/personal_information");
            exit();
        }
    }

    public function security()
    {
        $userID = 1254659;
        $user = $this->patientModel->find_user_by_id($userID);
        $data = [
            'user' => $user
        ];
        $this->view('patient/security', $data);
    }
    
    public function two_factor_authentication()
    {
        $userCred = $_GET['user'];
        $user = $this->patientModel->find_user_by_email($userCred);
        $data = [
            'user' => $user
        ];
        $this->view('patient/two_factor_authentication', $data);
    }

    public function toggle2FA()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['toggle_state'])) {
                $toggleState = $_POST['toggle_state'];
                $userID = $_POST['userID'];
        
                if ($toggleState == 'on') {
                    $this->patientModel->manage2FA($toggleState, $userID);
                } else if ($toggleState == 'off') {
                    $this->patientModel->manage2FA($toggleState, $userID);
                }
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Toggle state not provided']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }

    }

    public function twofactorverification()
    {
        $code = $_POST['code'];
        $emailphone = $_POST['phone'];

        $user = $this->patientModel->find_user_by_email($emailphone);

        if($user->two_factor_auth == "on" && password_verify($code, $user->otp_code)){
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["error" => "Incorrect code"]);
        }
    }

}