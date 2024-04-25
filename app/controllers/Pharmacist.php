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
        public function dashboard($page = 1){
            $user = $_SESSION['USER_DATA'];
            $itemsPerPage =5;
            $offset = ($page - 1) * $itemsPerPage;
            $patients = $this->pharmacistModel->getPatientsPaginated($itemsPerPage,$offset);
            $totalPatients = $this->pharmacistModel->getTotalPatientsCount();
            $totalPages = ceil($totalPatients/$itemsPerPage);

            $data = [
                'user' => $user,
                'patients' => $patients,
                'totalPatients' => $totalPatients,
                'currentPage' => $page,
                'totalPages' => $totalPages,
            ];

            $this->view('pharmacist/pharmacist_dashboard', $data);
        }

        public function medications($page = 1){

            $user = $_SESSION['USER_DATA'];
            $itemsPerPage = 4;
            $offset = ($page - 1) * $itemsPerPage;
            $medications = $this->pharmacistModel->getMedicationsPaginated($itemsPerPage, $offset);
            $totalMedications = $this->pharmacistModel->getTotalMedicationsCount(); 
            $totalPages = ceil($totalMedications / $itemsPerPage);
        
            $data = [
                'user' => $user,
                'medications' => $medications,
                'totalMedications' => $totalMedications,
                'currentPage' => $page,
                'totalPages' => $totalPages,
            ];
        
            $this->view('pharmacist/pharmacist_allMedications', $data);
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

        public function searchMedicineAjax(){
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
                $medicineName = $_POST['search'];
                $medications = $this->pharmacistModel->searchMedicine($medicineName);

                $data = [
                    'medications' => $medications
                ];

                $this->view('pharmacist/pharmacist_medicineAjax',$data);
            }
        }
        
        public function profile() {
            $user_id = $_SESSION['USER_DATA']->user_ID;
            $pharmacist = $this->pharmacistModel->getUserDetails($user_id);
            $data = [
                'pharmacist' => $pharmacist
            ];

            $this->view('pharmacist/pharmacist_profile', $data);
        }
        public function accountInfoUpdate()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST["username"];

                $this->pharmacistModel->updateAccInfo($username);

                redirect("/Pharmacist/profile");
                exit();
            }
        }
        public function passwordReset()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $newpassword = $_POST["newpassword"];
    
                $this->pharmacistModel->resetPassword($newpassword);
    
                redirect('/Pharmacist/profile');
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

        public function personal(){
            $user_id = $_SESSION['USER_DATA']->user_ID;
            $pharmacist = $this->pharmacistModel->pharmacistInfo($user_id);
            $data = [
                'pharmacist' => $pharmacist
            ];
            $this->view('pharmacist/pharmacist_personalInfoCheck',$data);
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

            $this->nurseModel->updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $regno, $qual, $spec, $dep);

            redirect("/Pharmacist/personal");
            exit();
        } else {
            redirect("/general/error_page");
        }
    }


        public function insertNewMedication(){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $medicationData = [
                    'name' => $_POST['name'],
                    'expiry_date' => $_POST['expiry'],
                    'quantity' => $_POST['quantity'],
                    'dosage' => $_POST['dosage'],
                    'batch' => $_POST['batch'],
                    'status' => $_POST['status']
                ];
            $result = $this->pharmacistModel->insertMedication($medicationData);

            if($result){
                redirect("/Pharmacist/medications");
            }
            else{
                echo "Error: Medication could not be added. please try again";
            }
            }
        }

        public function markOutOfStock(){
            if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])){
                $medication_id = $_GET['id'];

                $result = $this->pharmacistModel->markMedicationOutOfStock($medication_id);

                if($result){
                    redirect("/Pharmacist/medications");
                }else{
                    echo "Error:Medication could not be marked as out of stock";
                }
            }else{
                echo "Invalid request or missing parameters";
            }
        }

        public function updateMedicationQuantity(){
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['medication_id']) && isset($_POST['quantity'])) {
                $medicationId = $_POST['medication_id'];
                $quantity = $_POST['quantity'];
        
                $result = $this->pharmacistModel->updateMedicationQuantity($medicationId, $quantity);
        
                if($result){
                    echo json_encode(array('success' => true, 'message' => 'Medication quantity updated successfully'));
                } else {
                    echo json_encode(array('success' => false, 'message' => 'Error updating medication quantity'));
                }
            } else {
                echo json_encode(array('success' => false, 'message' => 'Invalid request or missing parameters'));
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


        public function searchMedicine($page = 1) {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
                $medicineName = $_POST['search'];
                $itemsPerPage = 4;
                $offset = ($page - 1) * $itemsPerPage;
                $medications = $this->pharmacistModel->getSearchedMedicationsPaginated($itemsPerPage, $offset, $medicineName);
                $totalMedications = $this->pharmacistModel->getTotalMedicationsCount();
                $totalPages = ceil($totalMedications / $itemsPerPage);
                
                // Condition 2: If medicine found, display it
                if (!empty($medications)) {
                    $data = [
                        'medications' => $medications,
                        'totalMedications' => $totalMedications,
                        'currentPage' => $page,
                        'totalPages' => $totalPages,
                    ];
                    $this->view('pharmacist/pharmacist_allMedications', $data);
                } else {
                    // Condition 3: If medicine not found, redirect to addNewMed page
                    redirect('/pharmacist/addNewMed');
                    exit();
                }
            }
        }

        
        public function security(){
            $user = $_SESSION['USER_DATA'];
            $data = [
                'user'=>$user,
            ];
            $this->view('pharmacist/pharmacist_2factor', $data);
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

        // public function allPrescriptions(){
        //     $this->view('pharmacist/pharmacist_prescription');
        // }

        public function allPrescriptions() {
            $patientId = $_GET['patient_id'];

            $prescriptions = $this->pharmacistModel->getAllPrescriptions($patientId);
            $prescriptionCount = $this->pharmacistModel->getPrescriptionCount($patientId);

            $data = [
                'prescriptions' => $prescriptions,
                'prescriptionCount' => $prescriptionCount
            ];
            $this->view('pharmacist/pharmacist_prescription', $data);
        }

        public function getPrescriptionDetails(){
            $prescriptionId = $_GET['prescription_id']; // Retrieve the prescription ID from the GET parameter
            // Now you can use $prescriptionId to fetch the specific prescription details from your model
            $patient = $this->pharmacistModel->getPatientDetails($prescriptionId);
            $diagnoses = $this->pharmacistModel->getDiagnosisDetails($prescriptionId);
            $medications = $this->pharmacistModel->getMedicationDetails($prescriptionId);
            $labtests = $this->pharmacistModel->getLabDetails($prescriptionId);
        
            // Then you can pass this data to your view
            $data = [
                'patient' => $patient,
                'diagnoses' =>$diagnoses,
                'medications' => $medications,
                'labtests' => $labtests
            ];
        
            $this->view('pharmacist/pharmacist_prescriptionPopup', $data);
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
        
        
        
    }
    
?>
