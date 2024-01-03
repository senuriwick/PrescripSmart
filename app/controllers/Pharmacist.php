<?php
    class Pharmacist extends Controller{
        public function __construct(){
            // echo "this is a pages controller";
            $this->pharmacistModel = $this->model('M_Pharmacist');
        }

        public function index(){

        }

        public function dashboard(){
            $patients = $this->pharmacistModel->getPatients();
            $data = [
                'patients' => $patients
            ];
            $this->view('pharmacist/pharmacist_dashboard', $data);
            // echo "insaf";
        }

        public function medications(){
            $medications = $this->pharmacistModel->getMedications();
            $data = [
                'medications' => $medications
            ];
            $this->view('pharmacist/pharmacist_allMedications', $data);
        }

        public function profile(){
            $this->view('pharmacist/pharmacist_profile');
        }

        public function personal(){
            $this->view('pharmacist/pharmacist_personalInfo');
        }

        public function security(){
            $this->view('pharmacist/pharmacist_2factor');
        }

        public function pharmacistMedication(){
            $this->view('pharmacist/pharmacist_medication');
        }

        public function addNewMed(){
            $this->view('pharmacist/pharmacist_addNewMed');
        }

        public function oneMedDetails(){
            $this->view('pharmacist/pharmacist_oneMedDetails');
        }

        public function enterNewMed(){
            $this->view('pharmacist/pharmacist_newMed');
        }

        public function allPrescriptions(){
            $this->view('pharmacist/pharmacist_prescription');
        }
    }
?>
