<?php

use Twilio\Rest\Client;
class General extends Controller
{
    private $generalModel;
    public function __construct()
    {
        $this->generalModel = $this->model('M_General');
    }

    public function index()
    {
        // $this->view('doctor/patients');
    }

    public function home()
    {
        $this->view('general/home');
    }

    public function employee_login()
    {
        $this->view('general/employee_login');
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

    public function employee_authentication()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email_address = $_POST["email_address"];
            $password = $_POST["password"];

            $result = $this->generalModel->employee_authentication($email_address, $password);

            if ($result) {
                $_SESSION['USER_DATA'] = $result;
                if (password_verify($password, $result->password)) 
                {
                    if($result->two_factor_auth == "on"){
                        if($result->method_of_signin == "Email"){
                            $security_code = $this->generate_OTP(6);
                            $this->generalModel->updateCode($security_code, $result->user_ID);
                            $this->send_security_email($result->email_phone, $security_code);
                        } else {
                            $security_code = $this->generate_OTP(6);
                            $this->generalModel->updateCode($security_code, $result->user_ID);
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
        $this->generalModel->updateCode($security_code, $email);
        $this->send_security_email($email, $security_code);
        echo json_encode(["success" => true]);
    }

    public function resend_security_sms()
    {
        $phone = $_POST['emailPhone'];
        $security_code = $this->generate_OTP(6);
        $this->generalModel->updateCode($security_code, $phone);
        $this->send_security_sms($phone, $security_code);
        echo json_encode(["success" => true]);
    }

    public function two_factor_authentication()
    {
        $userCred = $_GET['user'];
        $user = $this->generalModel->find_user_by_email($userCred);
        $data = [
            'user' => $user
        ];
        $this->view('general/two_factor_authentication', $data);
    }

    public function twofactorverification()
    {
        $code = $_POST['code'];
        $emailphone = $_POST['phone'];

        $user = $this->generalModel->find_user_by_email($emailphone);

        if($user->two_factor_auth == "on" && password_verify($code, $user->otp_code)){
            echo json_encode(["success" => true, "role" => $user->role]);
        } else {
            echo json_encode(["error" => "Incorrect code"]);
        }
    }

    public function logout()
    {
        if(!empty($_SESSION['USER_DATA'])) 
        {
            unset($_SESSION['USER_DATA']);
        }
    }

    //forgotton password functionality
    public function forgot_password()
    {
        $this->view('general/forgot_password');
    }

    public function forgotten_password_reset()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email_phone = $_POST["email"];

            $result = $this->generalModel->find_user_by_email($email_phone);

            if(!empty($result)){
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["error" => "Sorry! User not found."]);
            }
        }
    }

    public function reset_password()
    {
        $this->view('general/reset_password');
    }

    public function password_recovery()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email_phone = $_POST["email"];

            $result = $this->generalModel->find_user_by_email($email_phone);

            if(!empty($result)){
                if($result->method_of_signin == "Email") 
                {
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
        // create the recovery link
        $recovery_link = "http://localhost/prescripsmart/general/resetPassword?user=$email";
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
        $recovery_link = "http://localhost/prescripsmart/general/resetPassword?user=$phone_number";
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
        $this->view('general/recovery_contd');
    }

    public function resetPassword()
    {
        $user = $_GET['user'];
        $this->view('general/resetPassword');
    }

    public function reset_user_password()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $_POST['user'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            if($newPassword == $confirmPassword)
            {
                $this->generalModel->reset_password($newPassword, $user);
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["error" => "An error occured. Please try again later."]);
            }
        }  
    }

    public function reset_successful()
    {
        $this->view('general/reset_successful');
    }

    public function privacy_policy()
    {
        $this->view('general/privacy_policy');
    }

    public function terms_of_service()
    {
        $this->view('general/terms_of_service');
    }

    public function contact_us()
    {
        $this->view('general/contact_us');
    }

    public function error_page()
    {
        $this->view('general/error_page');
    }

}