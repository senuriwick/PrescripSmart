<?php
class Nurse extends Controller
{
    private $nurseModel;
    public function __construct()
    {
        $this->nurseModel = $this->model('M_Nurse');
    }

    public function index()
    {
        // $this->view('doctor/patients');
    }

    public function patients_dashboard()
    {
        $patients = $this->nurseModel->patients();
        $data = [
            'patients' => $patients
        ];
        $this->view('nurse/patients_dashboard', $data);
    }

    public function patient_profile()
    {
        $patientID = $_GET['patientId'];
        $patient = $this->nurseModel->patientdetails($patientID);
        $data = [
            'patient' => $patient
        ];
        $this->view('nurse/patient_profile', $data);
    }
}