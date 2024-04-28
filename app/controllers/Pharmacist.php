<?php
    class Pharmacist extends Controller{
        public function __construct(){
            $this->pharmacistModel = $this->model('M_Pharmacist');
        }

        public function index(){

        }

        // public function dashboard(){
        //     $patients = $this->pharmacistModel->getPatients();
        //     $data = [
        //         'patients' => $patients
        //     ];
        //     $this->view('pharmacist/pharmacist_dashboard', $data);
        // }

            
        public function login(){
            $this->view('pharmacist/login');
        }

        public function loginCheck(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST["username"];
                $password = $_POST["password"];
    
                $user = $this->pharmacistModel->getUserByUsername($username);
                // $pharmacist = $this->pharmacistModel->pharmacistInfo($user->user_ID);
    
                if ($user && password_verify($password, $user->password)) {
                    // Password is correct
                    session_start();
                    $_SESSION['USER_DATA'] = $user;
                    // $_SESSION['pharmacist'] = $pharmacist;
                    redirect("/Pharmacist/dashboard");
                    exit();
                } else {
                    // Password is incorrect
                    $error = "Invalid username or password";
                }
            }
    
            
        }
        // public function dashboard($page = 1){
        //     $user = $_SESSION['USER_DATA'];
        //     $itemsPerPage =5;
        //     $offset = ($page - 1) * $itemsPerPage;
        //     $patients = $this->pharmacistModel->getPatientsPaginated($itemsPerPage,$offset);
        //     $totalPatients = $this->pharmacistModel->getTotalPatientsCount();
        //     $totalPages = ceil($totalPatients/$itemsPerPage);

        //     $data = [
        //         'user' => $user,
        //         'patients' => $patients,
        //         'totalPatients' => $totalPatients,
        //         'currentPage' => $page,
        //         'totalPages' => $totalPages,
        //     ];

        //     $this->view('pharmacist/pharmacist_dashboard', $data);
        // }

        public static function logged_in()
        {
            if (!empty($_SESSION['USER_DATA'])) {
                return true;
            }
            return false;
        }

        public function dashboard($page = 1)
        {
            if ($this->logged_in()) {
                $allPatients = $this->pharmacistModel->getAllPatients();
                $recordsPerPage = 5;
                $totalPatients = count($allPatients);
                $totalPages = ceil($totalPatients / $recordsPerPage);
    
                $offset = ($page - 1) * $recordsPerPage;
                $patients = array_slice($allPatients, $offset, $recordsPerPage);
    
                $data = [
                    'patients' => $patients,
                    'allPatients' => $allPatients,
                    'currentPage' => $page,
                    'totalPages' => $totalPages
                ];
    
                $this->view('pharmacist/pharmacist_dashboard', $data);
            } else {
                header("Location: /prescripsmart/general/error_page");
            }
        }

       

        public function searchPatientAjax(){
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
                $patientName = $_POST['search'];
                $patients = $this->pharmacistModel->searchPatient($patientName);
        
                $data = [
                    'patients' => $patients
                ];

                $this->view('pharmacist/pharmacist_patientAjax', $data);
            }
                
        }
        
        public function account_information() {
            if ($this->logged_in()) {
            $user_id = $_SESSION['USER_DATA']->user_ID;
            $pharmacist = $this->pharmacistModel->getUserDetails($user_id);
            $data = [
                'pharmacist' => $pharmacist
            ];

            $this->view('pharmacist/pharmacist_profile', $data);
        }else{
            header("Location: /prescripsmart/general/error_page");
        }
        }

        public function accountInfoUpdate()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST["username"];

                $this->pharmacistModel->updateAccInfo($username);

                redirect("/Pharmacist/account_information");
                exit();
            }
        }
        public function passwordReset()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $newpassword = $_POST["newpassword"];
                $_SESSION['USER_DATA']->password = password_hash($newpassword, PASSWORD_BCRYPT);
                $this->pharmacistModel->resetPassword($newpassword);
    
                redirect('/Pharmacist/account_information');
                exit();
            }
        }

        public function checkCurrentPassword() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['currentPassword'])) {
                $currentPassword = $_POST['currentPassword'];
    
                // Assume $user is the object representing the logged-in user
                $user_id = $_SESSION['USER_DATA']->user_id;
                $user = $this->pharmacistModel->getUserDetails($user_id);
    
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

        public function personal_information(){

            if ($this->logged_in()) {
                $user_id = $_SESSION['USER_DATA']->user_ID;
                $pharmacist = $this->pharmacistModel->pharmacistInfo($user_id);
                $data = [
                    'pharmacist' => $pharmacist
                ];
                $this->view('pharmacist/pharmacist_personalInfoCheck',$data);
            }else{
                header("Location: /prescripsmart/general/error_page"); 
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

                $this->pharmacistModel->updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $regno, $qual, $spec, $dep);

                redirect("/Pharmacist/personal");
                exit();
            } else {
                redirect("/general/error_page");
            }
        }


       
        public function searchPatient($page = 1){
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {

                $user = $_SESSION['user'];
                $pharmacist = $_SESSION['pharmacist'];
                $patientName = $_POST['search'];
                $itemsPerPage =5;
                $offset = ($page - 1) * $itemsPerPage;
                $patients = $this->pharmacistModel->getSearchedPatientsPaginated($itemsPerPage,$offset, $patientName);
                $totalPatients = $this->pharmacistModel->getTotalPatientsCount();
                $totalPages = ceil($totalPatients/$itemsPerPage);
        
                if (!empty($patients)) {
                    $data = [
                        'user' => $user,
                        'pharmacist' => $pharmacist,
                        'patients' => $patients,
                        'totalPatients' => $totalPatients,
                        'currentPage' => $page,
                        'totalPages' => $totalPages,
                    ];
                    $this->view('pharmacist/pharmacist_dashboard', $data);  
                } else {
                    // Condition 3: If medicine not found, redirect to addNewMed page
                    $data = [
                        'user' => $user,
                        'pharmacist' => $pharmacist
                    ];
                    $this->view('pharmacist/pharmacist_dashboard', $data);
                    exit();
                }
            }
        }


        
        public function security(){

            if ($this->logged_in()) {

                $user = $_SESSION['USER_DATA'];
                $data = [
                    'user'=>$user,
                ];
                $this->view('pharmacist/pharmacist_2factor', $data);
            }else{
                header("Location: /prescripsmart/general/error_page"); 
            }
        }

        public function toggle2FA()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['toggle_state'])) {
                    $toggleState = $_POST['toggle_state'];
                    $userID = $_POST['userID'];
            
                    if ($toggleState == 'ON') {
                        $this->pharmacistModel->manage2FA($toggleState, $userID);
                    } else if ($toggleState == 'OFF') {
                        $this->pharmacistModel->manage2FA($toggleState, $userID);
                    }
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Toggle state not provided']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            }

        }

        public function allPrescriptions()
    {
        if ($this->logged_in()) {
            $patientId = $_GET['patient_id'];
            $prescriptions = $this->pharmacistModel->prescriptions($patientId);
            $prescriptionDetails = [];

            foreach ($prescriptions as $prescription) {
                $prescriptionID = $prescription->prescription_ID;
                $medicineData = $this->pharmacistModel->getMedicationDetails($prescriptionID);
                $prescriptionDetails[$prescriptionID] = $medicineData;
            }

            $data = [
                'prescriptions' => $prescriptions,
                'prescriptionDetails' => $prescriptionDetails,
            ];
            $this->view('pharmacist/pharmacist_prescription', $data);
        }else{
            header("Location: /prescripsmart/general/error_page"); 
        }
    }

    public function prescriptionStatus($page = 1)
    {
        if ($this->logged_in()) {
            $allPrescriptions = $this->pharmacistModel->allPrescriptions();
            $recordsPerPage = 5;
            $totalPrescriptions = count($allPrescriptions);
            $totalPages = ceil($totalPrescriptions / $recordsPerPage);
            $prescriptionDetails = [];
            
            $offset = ($page - 1) * $recordsPerPage;
            $prescriptions = array_slice($allPrescriptions, $offset, $recordsPerPage);

            foreach ($prescriptions as $prescription) {
                $prescriptionID = $prescription->prescription_ID;
                $medicineData = $this->pharmacistModel->getMedicationDetails($prescriptionID);
                $prescriptionDetails[$prescriptionID] = $medicineData;
            }


            $data = [
                'prescriptions' => $prescriptions,
                'prescriptionDetails' => $prescriptionDetails,
                'totalPages' => $totalPages,
                'currentPage' => $page
            ];
            $this->view('pharmacist/pharmacist_prescriptionStatus', $data);
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
                    $result = $this->nurseModel->updateProfilePicture($image, $userID);
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

    public function updateMedicineStatus(){
        {
            if (isset($_POST['id']) && isset($_POST['status'])) {
                $id = $_POST['id'];
                $status = $_POST['status'];
                $success = $this->pharmacistModel->markMedicationStatus($status, $id);
    
                if ($success) {
                    echo json_encode(array('success' => true));
                } else {
                    echo json_encode(array('success' => false, 'message' => 'Failed to update appointment status'));
                }
            } else {
                echo json_encode(array('success' => false, 'message' => 'Appointment ID or status not provided'));
            }
        } 
    }

    public function analysis(){

        if ($this->logged_in()) {
        
            $commonlyPrescribedMedications = $this->pharmacistModel->fetchCommonlyPrescribedMedications();
            
            $data = [
                "commonlyPrescribedMedications" => $commonlyPrescribedMedications
            ];
            $this->view('pharmacist/pharmacist_analysis', $data);
        }else{
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function analysisMonth(){
        // Check if 'month' query parameter is set
        $selectedMonth = isset($_GET['month']) ? $_GET['month'] : null;
        
        if (!empty($selectedMonth)) {
            // If month is selected, fetch data for the specified month
            $commonlyPrescribedMedications = $this->pharmacistModel->fetchMonthlyData($selectedMonth);
        }
        // Output JSON data
        echo json_encode($commonlyPrescribedMedications);
    }

    public function filterPatients()
    {
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
        $filteredPatients = $this->pharmacistModel->filterPatients($searchQuery);
        echo json_encode($filteredPatients);
    }
    
}   
?>
