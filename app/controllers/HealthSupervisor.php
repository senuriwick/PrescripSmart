<?php
    class HealthSupervisor extends Controller{
        public function __construct(){
            $this->healthSupervisorModel = $this->model('M_HealthSupervisor');
        }

        public function index(){

        }

        public function login(){
            $this->view('healthSupervisor/login');
        }

        public function loginCheck(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST["username"];
                $password = $_POST["password"];
    
                $user = $this->healthSupervisorModel->getUserByUsername($username);
    
                if ($user && password_verify($password, $user->password)) {
                    // Password is correct
                    session_start();
                    $_SESSION['data'] = $user;
                    redirect("/healthSupervisor/dashboard");
                    exit();
                } else {
                    // Password is incorrect
                    $error = "Invalid username or password";
                }
            }
    
            
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

        public function sendEmail(){

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve the values from the $_POST superglobal
                $inquiry_id = $_POST["inquiry_id"];
                $inquiry_email = $_POST["inquiry_email"];
                $message_content = $_POST["message_content"];
                $result = $this->healthSupervisorModel->markAsRead($inquiry_id);

                require '../PHPMailerAutoload.php';

                $mail = new PHPMailer;
                $mail->isSMTP();                                      
                $mail->Host = 'smtp.gmail.com';                       
                $mail->SMTPAuth = true;                               
                $mail->Username = 'prescripsmart@gmail.com';       
                $mail->Password = 'fgpacxjdxjogzlwk';                  
                $mail->SMTPSecure = 'tls';                            
                $mail->Port = 587;                                    

                $mail->setFrom('prescripsmart@gmail.com', 'Prescripsmart');
                $mail->addAddress($inquiry_email);     
                $mail->isHTML(true);

                $mail->Subject = 'Reply to your Inquiry';
                $mail->Body = $message_content;

                if (!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Message has been sent';
                }

                redirect('/healthSupervisor/dashboard');
            }
        }

        public function profile(){
            $this->view('healthSupervisor/healthSupervisor_profile');
        }

        public function personal(){
            $this->view('healthSupervisor/healthSupervisor_personalInfo');
        }

        // public function security(){
        //     $this->view('healthSupervisor/healthSupervisor_2factor');
        // }

        public function security(){
            $user = $_SESSION['data'];

            $data = [
                'user' => $user
            ];
            $this->view('healthSupervisor/healthSupervisor_2factor', $data);
        }
    }
?>