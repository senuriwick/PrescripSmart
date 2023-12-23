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
    }
?>