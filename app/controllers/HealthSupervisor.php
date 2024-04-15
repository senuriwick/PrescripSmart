<?php
    class HealthSupervisor extends Controller{
        public function __construct(){
            $this->healthSupervisorModel = $this->model('M_HealthSupervisor');
        }

        public function index(){

        }

        public function dashboard($page = 1){
            $itemsPerPage =5;
            $offset = ($page - 1) * $itemsPerPage;

            $newInquiries = $this->healthSupervisorModel->getNewInquiriesPaginated($itemsPerPage,$offset);
            $totalNewInquiries = $this->healthSupervisorModel->getNewInquiriesCount();

            $totalPages = ceil($totalNewInquiries/$itemsPerPage);

            $data = [
                'newInquiries' => $newInquiries,
                'totalNewInquiries' => $totalNewInquiries,
                'currentPage' => $page,
                'totalPages' => $totalPages,
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
        
        // public function historry(){
        //     $readInquiries = $this->healthSupervisorModel->getReadInquiries();
        //     $readInquiriesCount = $this->healthSupervisorModel->getReadInquiriesCount();
        //     $data = [
        //         'inquiries' => $readInquiries,
        //         'count' => $readInquiriesCount
        //     ];
        //     $this->view('healthSupervisor/healthSupervisor_History', $data);
        // }

        public function history($page = 1){
            $itemsPerPage =5;
            $offset = ($page - 1) * $itemsPerPage;

            $readInquiries = $this->healthSupervisorModel->getReadInquiriesPaginated($itemsPerPage,$offset);
            $totalReadInquiries = $this->healthSupervisorModel->getReadInquiriesCount();

            $totalPages = ceil($totalReadInquiries/$itemsPerPage);

            $data = [
                'readInquiries' => $readInquiries,
                'totalReadInquiries' => $totalReadInquiries,
                'currentPage' => $page,
                'totalPages' => $totalPages,
            ];

            $this->view('healthSupervisor/healthSupervisor_History', $data);
        }

        public function markAsRead(){
            if(isset($_GET['id'])){
                $inquiry_id = $_GET['id'];
                $result = $this->healthSupervisorModel->markAsRead($inquiry_id);
                redirect('/healthSupervisor/dashboard');
            }
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