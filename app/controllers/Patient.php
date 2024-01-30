<?php
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

    public function activate()
    {
        $email = $_GET['email'] ?? null;
        $user = $this->patientModel->users($email);

        if ($user->active == 0) {
            $this->patientModel->activate($email);
            header("Location: /prescripsmart/patient/login");
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

                $result = $this->patientModel->users($email_address);

                if ($result) {
                    echo json_encode(["error" => "User already exists!"]);
                } else {
                    $activation_code = $this->generate_activation_code();
                    //$expiry = 1 * 24 * 60 * 60;
                    $reference = $this->patientModel->register($first_name, $last_name, $email_address, $password, $activation_code);
                    //$this->send_activation_email($email_address, $activation_code);
                    echo json_encode(["success" => true, "reference" => $reference]);
                }
            }
        } catch (Exception $e) {
            // Log or handle the exception
            error_log($e->getMessage());
            echo json_encode(["error" => "An error occurred. Please try again later."]);
        }

    }

    public function emailverification()
    {
        $user_ID = $_GET['reference'] ?? null;

        if ($user_ID !== null) {
            $user = $this->patientModel->user($user_ID);
            $data = [
                'user' => $user
            ];
            $this->send_activation_email($user->email_phone, $user->activation_code);
            $this->view('patient/emailverification', $data);
        } else {
            echo "User ID not provided";
        }
    }

    public function registerwithPhone()
    {
        $this->view('patient/registerwithPhone');
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
                if ($password == $result->password) {
                    echo json_encode(["success" => true]);
                } else {
                    echo json_encode(["error" => "Invalid password"]);
                }
            } else {
                echo json_encode(["error" => "Email/Phone Number does not exist"]);
            }
        }
    }

    public function inquiries_dashboard()
    {
        $this->view('patient/inquiries_dashboard');
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

    public function appointment_reservation(int $patient_ID, int $session_ID, int $doctor_ID, $time, $date)
    {
        $referrence = $this->patientModel->confirmAppointment($patient_ID, $session_ID, $doctor_ID, $time, $date);
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
        $this->view('patient/appointment_complete');
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

}