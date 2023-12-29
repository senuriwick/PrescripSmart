<?php
class Patient extends Controller{
    public function __construct(){
        $this->patientModel = $this->model('M_Patient'); // Corrected model name
    }

    public function index(){
        // $this->view('doctor/patients');
    }

    public function inquiries_dashboard(){
        $this->view('patient/inquiries_dashboard');
    }

    public function appointments_dashboard(){
        $appointments = $this->patientModel->getAppointments();
        $data = [
            'appointments' => $appointments
        ];
        $this->view('patient/appointments_dashboard', $data); // Passing data to the view
    }
}
?>