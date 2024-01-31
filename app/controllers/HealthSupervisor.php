<?php
    class HealthSupervisor extends Controller{
        public function __construct(){
            $this->healthSupervisorModel = $this->model('M_HealthSupervisor');
        }

        public function index(){

        }

        public function dashboard(){
            $inquiries = $this->healthSupervisorModel->getInquiries();
            $data = [
                'inquiries' => $inquiries
            ];
            $this->view('healthSupervisor/healthSupervisor_dash');
        }

        public function history(){
            $this->view('healthSupervisor/healthSupervisor_History');
        }

        public function oneInquiry(){
            $this->view('healthSupervisor/healthSupervisor_oneInquiry');
        }

        public function profile(){
            $this->view('healthSupervisor/healthSupervisor_profile');
        }

        public function personal(){
            $this->view('healthSupervisor/healthSupervisor_personalInfo');
        }

        public function security(){
            $this->view('healthSupervisor/healthSupervisor_2factor');
        }
    }
?>