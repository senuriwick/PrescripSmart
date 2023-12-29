<?php
    class Patient extends Controller{
        public function __construct(){
            // // echo "this is a pages controller";
            // $this->patientModel = $this->model('M_Patient');
        }

        public function index(){
            // $this->view('doctor/patients');
        }

        public function inquiries_dashboard(){
            // $patients = $this->pharmacistModel->getPatients();
            // $data = [
            //     'patients' => $patients
            // ];
            $this->view('patient/inquiries_dashboard');
            // echo "insaf";
        }

        public function appointments_dashboard(){
            $this->view('patient/appointments_dashboard');
            // echo "insaf";
        }
    }
?>