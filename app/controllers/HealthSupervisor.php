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
            $this->view('healthSupervisor/healthSupervisor_dash', $data);
        }


        public function inquiryDetails(){
            if(isset($_GET['id'])) {
                $inquiry_id = $_GET['id'];
                $inquiryDetails = $this->healthSupervisorModel->getInquiryDetailsById($inquiry_id);
                $data = [
                    'inquiry' =>$inquiryDetails
                ];
                $this->view('healthSupervisor/healthSupervisor_oneInquiry', $data);
            }
            else{
                echo "nothing";
            }
        }
        
        public function history(){
            $readInquiries = $this->healthSupervisorModel->
            $this->view('healthSupervisor/healthSupervisor_History');
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