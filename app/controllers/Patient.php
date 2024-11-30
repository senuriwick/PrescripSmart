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

        $account_sid = '';
        $auth_token = '';
        $twilio_number = "";

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
        $mail->Password = '';                 // SMTP password
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
            $user = $this->patientModel->find_user_by_email($email);
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
            $mail->Password = '';
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

    public function registration()
    {
        $this->view('patient/registration');
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
                    $reference = $this->patientModel->register($first_name, $last_name, $email_address, $password, $activation_code);
                    $this->send_activation_email($email_address, $activation_code);
                    echo json_encode(["success" => true, "reference" => $reference]);
                }
            }
        } catch (Exception $e) {
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
            header("Location: /prescripsmart/general/error_page");
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
            $this->view('patient/emailverification', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
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
                    $reference = $this->patientModel->registerPhone($first_name, $last_name, $phone_number, $password, $otp);
                    $this->send_otp($phone_number, $otp);
                    echo json_encode(["success" => true, "reference" => $reference]);
                }
            }
        } catch (Exception $e) {
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
            $this->view('patient/phoneverification', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
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
            header("Location: /prescripsmart/general/error_page");
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

    public function logout()
    {
        if (!empty($_SESSION['USER_DATA'])) {
            unset($_SESSION['USER_DATA']);
        }
    }

    public static function logged_in()
    {
        if (!empty($_SESSION['USER_DATA'])) {
            return true;
        }
        return false;
    }

    public function forgot_password()
    {
        $this->view('patient/forgot_password');
    }

    public function forgotten_password_reset()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email_phone = $_POST["email"];

            $result = $this->patientModel->find_user_by_email($email_phone);

            if (!empty($result)) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["error" => "Sorry! User not found."]);
            }
        }
    }

    public function reset_password()
    {
        $this->view('patient/reset_password');
    }

    public function password_recovery()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email_phone = $_POST["email"];

            $result = $this->patientModel->find_user_by_email($email_phone);

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
        $mail->Password = '';
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

        $account_sid = '';
        $auth_token = '';
        $twilio_number = "";

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

    public function recovery_contd()
    {
        $this->view('patient/recovery_contd');
    }

    public function resetPassword()
    {
        $user = $_GET['user'];
        $this->view('patient/resetPassword');
    }

    public function reset_user_password()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $_POST['user'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($newPassword == $confirmPassword) {
                $this->patientModel->reset_password($newPassword, $user);
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["error" => "An error occured. Please try again later."]);
            }
        }
    }

    public function reset_successful()
    {
        $this->view('patient/reset_successful');
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
                    if ($result->two_factor_auth == "on") {
                        if ($result->method_of_signin == "Email") {
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
        $mail->Username = 'prescripsmart@gmail.com';
        $mail->Password = '';
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

    public function send_security_sms($phone, $code)
    {
        require '../vendor/autoload.php';

        $account_sid = '';
        $auth_token = '';
        $twilio_number = "";

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
        if ($this->logged_in()) {
            $this->view('patient/inquiries_dashboard');
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function inquiries()
    {
        if ($this->logged_in()) {
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
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    //APPOINTMENTS
    public function appointments_dashboard()
    {
        if ($this->logged_in()) {
            $appointments = $this->patientModel->getAppointments($_SESSION['USER_DATA']->user_ID);
            $data = [
                'appointments' => $appointments
            ];
            $this->view('patient/appointments_dashboard', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function view_appointment()
    {
        if ($this->logged_in()) {
            $appointment_ID = $_GET['appointment_id'] ?? null;
            $appointment = $this->patientModel->viewAppointment($appointment_ID, $_SESSION['USER_DATA']->user_ID);
            $patient = $this->patientModel->patientDetails($appointment->patient_ID);
            $merchant_id = 1226371;
            $order_id = "$appointment->appointment_ID";
            $amount = "$appointment->amount";
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

            if ($appointment_ID !== null) {

                $data = [
                    'appointment' => $appointment,
                    'hash' => $hash,
                    'patient' => $patient
                ];
                $this->view('patient/view_appointment', $data);
            } else {
                header("Location: /prescripsmart/general/error_page");
            }
        } else {
            header("Location: /prescripsmart/general/error_page");
        }

    }

    public function delete_appointment(int $appointment_ID)
    {
        if ($this->logged_in()) {
            $this->patientModel->deleteAppointment($appointment_ID);
            header("Location: /prescripsmart/patient/appointment_cancelled");
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function new_appointment()
    {
        if ($this->logged_in()) {
            $doctors = $this->patientModel->searchDoctor();
            $data = [
                'doctors' => $doctors
            ];
            $this->view('patient/new_appointment', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function appointment_reservation()
    {
        if ($this->logged_in()) {
            $doctor_ID = $_POST['doctor_ID'];
            $session_ID = $_POST['session_ID'];
            $time = $_POST['time'];
            $date = $_POST['date'];
            $charge = $_POST['charge'];
            $number = $_POST['number'];
            $referrence = $this->patientModel->confirmAppointment($_SESSION['USER_DATA']->user_ID, $doctor_ID, $session_ID, $time, $date, $charge, $number);
            header("Location: /prescripsmart/patient/appointment_complete?referrence=$referrence");
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }
    public function doctor_sessions()
    {
        if ($this->logged_in()) {
            $doctor_ID = $_GET['doctor_ID'] ?? null;

            if ($doctor_ID !== null) {
                $session = $this->patientModel->docSession($doctor_ID);
                $doctorImage = $this->patientModel->docImage($doctor_ID);
                $doctorDetails = $this->patientModel->searchDoctor_byID($doctor_ID);
                $data = [
                    'session' => $session,
                    'image' => $doctorImage,
                    'doctor' => $doctorDetails
                ];
                $this->view('patient/doctor_sessions', $data);
            } else {
                header("Location: /prescripsmart/general/error_page");
            }
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function appointment_confirmation()
    {
        if ($this->logged_in()) {
            $session_ID = $_GET['sessionID'] ?? null;

            if ($session_ID != null) {

                $selectedSession = $this->patientModel->getSessionDetails($session_ID);
                $data = [
                    'selectedSession' => $selectedSession
                ];
                $this->view('patient/appointment_confirmation', $data);
            } else {
                header("Location: /prescripsmart/general/error_page");
            }
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function appointment_complete()
    {
        if ($this->logged_in()) {
            $referrence = $_GET['referrence'] ?? null;
            $appointment = $this->patientModel->appointment($referrence);
            $patient = $this->patientModel->patientDetails($appointment->patient_ID);
            $doctor = $this->patientModel->searchDoctor_byID($appointment->doctor_ID);
            $merchant_id = 1226371;
            $order_id = "$appointment->appointment_ID";
            $amount = "$appointment->amount";
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

            if ($_SESSION['USER_DATA']->method_of_signin == "Email") {
                $this->appointment_email($_SESSION['USER_DATA']->email_phone, $_SESSION['USER_DATA']->first_Name, $_SESSION['USER_DATA']->last_Name, $doctor->first_Name, $doctor->last_Name);
            } else {
                $this->appointment_message($_SESSION['USER_DATA']->email_phone, $_SESSION['USER_DATA']->first_Name, $_SESSION['USER_DATA']->last_Name, $doctor->first_Name, $doctor->last_Name);
            }
            $this->view('patient/appointment_complete', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function appointment_email($email, $firstName, $lastName, $doctorF, $doctorL)
    {
        $message = <<<MESSAGE
            Dear Mr/Ms. $firstName $lastName;
            Your appointment with Dr.$doctorF $doctorL has been confirmed. Please login to view more details.
            Thank You!
            MESSAGE;

        require '../PHPMailerAutoload.php';

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'prescripsmart@gmail.com';
        $mail->Password = '';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('prescripsmart@gmail.com', 'Prescripsmart');
        $mail->addAddress($email);
        $mail->isHTML(true);

        $mail->Subject = 'Appointment Confirmation';
        $mail->Body = $message;

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            //echo 'Message has been sent';
        }
    }

    public function appointment_message($phone_number, $firstName, $lastName, $doctorF, $doctorL)
    {
        require '../vendor/autoload.php';

        $account_sid = '';
        $auth_token = '';
        $twilio_number = "";

        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            $phone_number,
            array(
                'from' => $twilio_number,
                'body' => 'Dear Mr/Ms. ' . $firstName . ' ' . $lastName . ';
                Your appointment for Dr. ' . $doctorF . ' ' . $doctorL . ' has been confirmed. Please login to view more details.
                Thank You!'
            )
        );
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
        if ($this->logged_in()) {
            $this->view('patient/appointment_cancelled');
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    //PRESCRIPTIONS
    public function prescriptions_dashboard()
    {
        if ($this->logged_in()) {
            $userID = $_SESSION['USER_DATA']->user_ID;
            $patient = $this->patientModel->patientDetails();
            $prescriptions = $this->patientModel->prescriptions($userID);
            $prescriptionDetails = [];
            $labDetails = [];
            foreach ($prescriptions as $prescription) {
                $prescriptionID = $prescription->prescription_ID;
                $medicineData = $this->patientModel->prescriptionMedicines($prescriptionID);
                $labTests = $this->patientModel->labTests($prescriptionID);
                $prescriptionDetails[$prescriptionID] = $medicineData;
                $labDetails[$prescriptionID] = $labTests;
            }

            $data = [
                'prescriptions' => $prescriptions,
                'prescriptionDetails' => $prescriptionDetails,
                'labDetails' => $labDetails,
            ];
            $this->view('patient/prescriptions_dashboard', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function public_prescriptionView()
    {
        $prescription_ID = $_GET['prescription'] ?? null;
        $prescriptions = $this->patientModel->publicPrescriptionView($prescription_ID);
        $prescriptionDetails = [];
        $labDetails = [];
        $medicineData = $this->patientModel->prescriptionMedicines($prescription_ID);
        $labTests = $this->patientModel->labTests($prescription_ID);
        $doctor = $this->patientModel->searchDoctor_byID($prescriptions->doctor_ID);
        $prescriptionDetails[$prescription_ID] = $medicineData;
        $labDetails[$prescription_ID] = $labTests;
        $data = [
            'prescription' => $prescriptions,
            'prescriptionDetails' => $prescriptionDetails,
            'labDetails' => $labDetails,
            'doctor' => $doctor
        ];

        $this->view('patient/public_prescriptionView', $data);
    }

    public function qr_download()
    {
        if ($this->logged_in()) {
            $this->view('patient/qr_download');
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    //REPORTS
    public function reports_dashboard()
    {
        if ($this->logged_in()) {
            $reports = $this->patientModel->labreports($_SESSION['USER_DATA']->user_ID);
            $data = [
                'reports' => $reports
            ];
            $this->view('patient/reports_dashboard', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function updateDownloadCount($reportId)
    {
        $this->patientModel->updateDownloadCount($reportId);
    }

    public function account_information()
    {
        if ($this->logged_in()) {
            $patient = $this->patientModel->patientInfo();
            $data = [
                'patient' => $patient
            ];
            $this->view('patient/account_information', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function accountInfoUpdate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $this->patientModel->updateAccInfo($username, $_SESSION['USER_DATA']->user_ID);

            header("Location: /prescripsmart/patient/account_information");
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
            $this->patientModel->resetPassword($newpassword);

            header("Location: /prescripsmart/patient/account_information");
            exit();
        }
    }

    public function personal_information()
    {
        if ($this->logged_in()) {
            $patient = $this->patientModel->patientDetails();
            $user = $this->patientModel->patientInfo();
            $data = [
                'patient' => $patient,
                'user' => $user
            ];
            $this->view('patient/personal_information', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
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

            $this->patientModel->updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $dob, $age, $gender, $height, $weight, $ename, $econtact, $relationship, $_SESSION['USER_DATA']->user_ID);

            header("Location: /prescripsmart/patient/personal_information");
            exit();
        }
    }

    public function security()
    {
        if ($this->logged_in()) {
            $userID = $_SESSION['USER_DATA']->user_ID;
            $user = $this->patientModel->find_user_by_id($userID);
            $data = [
                'user' => $user
            ];
            $this->view('patient/security', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
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

        if ($user->two_factor_auth == "on" && password_verify($code, $user->otp_code)) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["error" => "Incorrect code"]);
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
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";

                    $image = basename($_FILES["image"]["name"]);

                    $userID = $_SESSION['USER_DATA']->user_ID;
                    $result = $this->patientModel->updateProfilePicture($image, $userID);
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
