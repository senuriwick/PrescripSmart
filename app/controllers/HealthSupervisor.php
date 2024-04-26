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
                $this->healthSupervisorModel->storeReply($inquiry_id, $message_content);

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
            $user = $_SESSION['USER_DATA'];
            $healthSupervisor = $this->healthSupervisorModel->healthSupervisorInfo();

            $data = [
                'user' => $user,
                'healthSupervisor' => $healthSupervisor
            ];

            $this->view('healthSupervisor/healthSupervisor_profile', $data);
        }

        public function personal_information()
    {
        $healthSupervisor = $this->healthSupervisorModel->healthSupervisorDetails();
        $user = $this->healthSupervisorModel->healthSupervisorInfo();
        $data = [
            'healthSupervisor' => $healthSupervisor,
            'user' => $user
        ];
        $this->view('healthSupervisor/healthSupervisor_personalInfo', $data);
    }


        // public function security(){
        //     $this->view('healthSupervisor/healthSupervisor_2factor');
        // }

        public function security()
    {
        $userID = $_SESSION['USER_DATA']->user_ID;
        $user = $this->healthSupervisorModel->getUserDetails($userID);
        $data = [
            'user' => $user
        ];
        $this->view('healthSupervisor/healthSupervisor_2factor', $data);
    }

    public function toggle2FA()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['toggle_state'])) {
                $toggleState = $_POST['toggle_state'];
                $userID = $_POST['userID'];

                if ($toggleState == 'on') {
                    $this->healthSupervisorModel->manage2FA($toggleState, $userID);
                } else if ($toggleState == 'off') {
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



    public function checkPassword()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $enteredPassword = $_POST["password"];
            $databasePasswordHash = $_SESSION['USER_DATA']->password;

            if (password_verify($enteredPassword, $databasePasswordHash)) {
                echo json_encode(array("match" => true));
            } else {
                echo json_encode(array("match" => false));
            }
        }
    }

    public function personalInfoUpdate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $dname = $_POST["dname"];
            $haddress = $_POST["haddress"];
            $nic = $_POST["nic"];
            $cno = $_POST["cno"];
            $regno = $_POST["regno"];
            $qual = $_POST["qual"];
            $spec = $_POST["spec"];
            $dep = $_POST["dep"];

            $this->healthSupervisorModel->updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $regno, $qual, $spec, $dep);

            redirect('/healthSupervisor/personal_information');
            exit();
        } else {
            redirect('/general/error_page');
        }
    }

    public function updateProfilePicture()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
            $target_dir = "C:/xampp/htdocs/PrescripSmart/public/uploads/profile_images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


            // Check file size
            // if ($_FILES["image"]["size"] > 500000) {
            //     echo "Sorry, your file is too large.";
            //     $uploadOk = 0;
            // }

            //Allow only certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }


            if ($uploadOk == 0) {
                // echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";

                    $image = basename($_FILES["image"]["name"]);

                    $userID = $_SESSION['USER_DATA']->user_ID;
                    $result = $this->pharmacistModel->updateProfilePicture($image, $userID);
                    $_SESSION['USER_DATA']->profile_photo = $image;

                    if ($result) {
                        echo json_encode(array("success" => true));
                    } else {
                        echo json_encode(array("success" => false, "message" => "Failed to update profile picture in database"));
                    }
                } else {
                    header("Location: /prescripsmart/general/error_page");
                }
            }
        }
    }


    }
?>