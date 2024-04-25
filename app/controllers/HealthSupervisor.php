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
                    $_SESSION['USER_DATA'] = $user;
                    redirect("/healthSupervisor/dashboard");
                    exit();
                } else {
                    // Password is incorrect
                    $error = "Invalid username or password";
                }
            }
    
            
        }

        public function dashboard($page = 1){
            $user = $_SESSION['USER_DATA'];
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
                'user' => $user,
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

            $user = $_SESSION['USER_DATA'];
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
                'user' => $user,
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
            $user = $_SESSION['user'];
            $healthSupervisor = $this->healthSupervisorModel->healthSupervisorInfo();

            $data = [
                'user' => $user,
                'healthSupervisor' => $healthSupervisor
            ];

            $this->view('healthSupervisor/healthSupervisor_profile', $data);
        }

        public function personal(){
            $user = $_SESSION['user'];
            $healthSupervisor = $this->healthSupervisorModel->healthSupervisorInfo();

            $data = [
                'user' => $user,
                'healthSupervisor' => $healthSupervisor
            ];
            $this->view('healthSupervisor/healthSupervisor_personalInfo',$data);
        }

        // public function security(){
        //     $this->view('healthSupervisor/healthSupervisor_2factor');
        // }

        public function security(){
            $user = $_SESSION['user'];
            $healthSupervisor = $this->healthSupervisorModel->healthSupervisorInfo();

            $data = [
                'user' => $user,
                'healthSupervisor' => $healthSupervisor

            ];
            $this->view('healthSupervisor/healthSupervisor_2factor', $data);
        }

        public function toggle2FA()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['toggle_state'])) {
                    $toggleState = $_POST['toggle_state'];
                    $userID = $_POST['userID'];
            
                    if ($toggleState == 'ON') { 
                        $this->healthSupervisorModel->manage2FA($toggleState, $userID);
                    } else if ($toggleState == 'OFF') {
                        $this->healthSupervisorModel->manage2FA($toggleState, $userID);
                    }
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Toggle state not provided']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            }

        }

        public function accountInfoUpdate()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST["username"];

                $this->healthSupervisorModel->updateAccInfo($username);

                redirect("/healthSupervisor/profile");
                exit();
            }
        }

        public function passwordReset()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $newpassword = $_POST["newpassword"];
    
                $this->healthSupervisorModel->resetPassword($newpassword);
    
                redirect('/healthSupervisor/profile');
                exit();
            }
        }

        public function checkCurrentPassword() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['currentPassword'])) {
                $currentPassword = $_POST['currentPassword'];
    
                // Assume $user is the object representing the logged-in user
                $user_id = 3;
                $user = $this->healthSupervisorModel->getUserDetails($user_id);
    
                if ($user && password_verify($currentPassword, $user->password)) {
                    echo '<span style="color: green;">You\'re good to go!</span>';
                } else {
                    echo '<span style="color: red;">Incorrect password!</span>';
                }
            } else {
                // Handle invalid or missing parameters
                echo '<span style="color: red;">Error: Invalid request.</span>';
            }
        }

        public function personalInfoUpdate()
        {
            $user_id = $_SESSION['data']->user_id;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fname = $_POST["fName"];
                $lname = $_POST["lName"];
                $dname = $_POST["displayName"];
                $address = $_POST["address"];
                $nic = $_POST["nic"];
                $contact = $_POST["contact"];
                $regNo = $_POST["regNo"];
                $qualification = $_POST["qualification"];
    
                $this->healthSupervisorModel->updateInfo($user_id, $fname, $lname, $dname, $address, $nic, $contact, $regNo,$qualification);
                redirect("/healthSupervisor/personal");
                exit();
            }
        }


    }
?>