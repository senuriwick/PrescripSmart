<?php
class Patient extends Controller
{
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
    }

    public function new_appointment()
    {
        $doctors = $this->patientModel->searchDoctor();
        $data = [
            'doctors' => $doctors
        ];
        $this->view('patient/new_appointment', $data);
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
        $referrence = $this->patientModel->confirmAppointment(); 
        header("Location: /prescripsmart/patient/appointment_complete?referrence=$referrence");
    }

    public function appointment_complete()
    {
        $referrence = $_GET['referrence'] ?? null;
        $this->view('patient/appointment_complete');
    }
    

}
?>