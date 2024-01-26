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

    public function delete_appointment(int $appointment_ID) {
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

    public function appointment_reservation(int $patient_ID, int $session_ID, int $doctor_ID, $time,$date) 
    {
        $referrence = $this->patientModel->confirmAppointment($patient_ID,$session_ID,$doctor_ID,$time,$date); 
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
    
            $this->patientModel->updateInfo($fname,$lname,$dname,$haddress,$nic,$cno,$dob,$age,$gender,$height,$weight,$ename,$econtact,$relationship);
    
            header("Location: /prescripsmart/patient/personal_information");
            exit();
        }
    }

}