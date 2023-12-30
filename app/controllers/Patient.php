<?php
class Patient extends Controller
{
    public function __construct()
    {
        $this->patientModel = $this->model('M_Patient'); // Corrected model name
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
        $this->view('patient/appointments_dashboard', $data); // Passing data to the view
    }

    // public function view_appointment($appointment_ID)
    // {
    //     $appointment = $this->patientModel->viewAppointment($appointment_ID);
    //     $data = [
    //         'appointment' => $appointment
    //     ];
    //     $this->view('patient/view_appointment', $data);
    // }

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
        // Handle the case where appointment_id is not provided
        // You might want to redirect the user or display an error message
        echo "Appointment ID not provided";
    }
}
}
?>