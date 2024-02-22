<?php

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

    public function employee_authentication()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email_address = $_POST["email_address"];
            $password = $_POST["password"];

            $result = $this->generalModel->employee_authentication($email_address, $password);

            if ($result) {
                if (password_verify($password, $result->password)) 
                {
                    //session_start();
                    //$_SESSION['user_ID'] = $result->user_ID;
                    echo json_encode(["success" => true, "role" => $result->role]);
                } else {
                    echo json_encode(["error" => "Invalid password"]);
                }
            } else {
                echo json_encode(["error" => "Email/Phone Number does not exist"]);
            }
        }
    }
}