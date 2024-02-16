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
    
                if ($user && password_verify($password, $user->password)) {
                    // Password is correct
                    session_start();
                    $_SESSION['user_id'] = $user->user_id;
                    $_SESSION['username'] = $user->username;
                    $_SESSION['role'] = $user->role;
                    redirect("/Pharmacist/dashboard");
                    exit();
                } else {
                    // Password is incorrect
                    $error = "Invalid username or password";
                }
            }
    
            
        }
        public function dashboard($page = 1){
            $itemsPerPage =6;
            $offset = ($page - 1) * $itemsPerPage;

            $patients = $this->pharmacistModel->getPatientsPaginated($itemsPerPage,$offset);
            $totalPatients = $this->pharmacistModel->getTotalPatientsCount();

            $totalPages = ceil($totalPatients/$itemsPerPage);

            $data = [
                'patients' => $patients,
                'totalPatients' => $totalPatients,
                'currentPage' => $page,
                'totalPages' => $totalPages,
            ];

            $this->view('pharmacist/pharmacist_dashboard', $data);
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
        

        // public function medications(){
        //     $medications = $this->pharmacistModel->getMedications();
        //     $totalMedications = count($medications);
        //     $data = [
        //         'medications' => $medications,  
        //         'totalMedications' => $totalMedications,
        //     ];
        //     $this->view('pharmacist/pharmacist_allMedications', $data);
        // }

        public function medications($page = 1){
            $itemsPerPage = 4;
            $offset = ($page - 1) * $itemsPerPage;
        
            $medications = $this->pharmacistModel->getMedicationsPaginated($itemsPerPage, $offset);
            $totalMedications = $this->pharmacistModel->getTotalMedicationsCount();
        
            $totalPages = ceil($totalMedications / $itemsPerPage);
        
            $data = [
                'medications' => $medications,
                'totalMedications' => $totalMedications,
                'currentPage' => $page,
                'totalPages' => $totalPages,
            ];
        
            $this->view('pharmacist/pharmacist_allMedications', $data);
        }
        
        public function profile() {
            // Assume $employeeId is the identifier for the logged-in pharmacist
            $userId = "1"; // Replace with actual employee ID retrieval logic
    
            // Fetch pharmacist profile details
            $pharmacistProfile = $this->pharmacistModel->getUserDetails($userId);
    
            // Pass the details to the view
            $data = [
                'userPharm' => $pharmacistProfile,
            ];
    
            $this->view('pharmacist/pharmacist_profileCheck', $data);
        }

        public function profileCheck() {
            // Assume $employeeId is the identifier for the logged-in pharmacist
            $userId = "1"; // Replace with actual employee ID retrieval logic
    
            // Fetch pharmacist profile details
            $pharmacistProfile = $this->pharmacistModel->getUserDetails($userId);
    
            // Pass the details to the view
            $data = [
                'userPharm' => $pharmacistProfile,
            ];
    
            $this->view('pharmacist/pharmacist_profile', $data);
        }

        public function accountInfoUpdate()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST["username"];
                // $password = $_POST["password"];
                // $newpassword = $_POST["newpassword"];

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
                $user_id = 1;
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

        public function personal(){
            $pharmacist = $this->pharmacistModel->pharmacistInfo();
            $data = [
                'pharmacist' => $pharmacist
            ];
            $this->view('pharmacist/pharmacist_personalInfoCheck',$data);
        }

        // public function personalInfoUpdate()
        // {
        //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //         $fname = $_POST["fName"];
        //         $lname = $_POST["lName"];
        //         $dname = $_POST["displayName"];
        //         $address = $_POST["address"];
        //         $nic = $_POST["nic"];
        //         $contact = $_POST["contact"];
        //         $regNo = $_POST["regNo"];
        //         $qualification = $_POST["qualification"];
    
        //         $this->pharmacistModel->updateInfo($fname, $lname, $dname, $address, $nic, $contact, $regNo,$qualification);
        //         redirect("Pharmacist/personal");
        //         exit();
        //     }
        // }

        public function personalInfoUpdate()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fname = $_POST["fName"];
                $lname = $_POST["lName"];
                $dname = $_POST["displayName"];
                $address = $_POST["address"];
                $nic = $_POST["nic"];
                $contact = $_POST["contact"];
                $regNo = $_POST["regNo"];
                $qualification = $_POST["qualification"];
    
                $this->pharmacistModel->updateInfo($fname, $lname, $dname, $address, $nic, $contact, $regNo,$qualification);
                redirect("/Pharmacist/personal");
                exit();
            }
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

        public function searchPatient(){
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
                $patientName = $_POST['search'];
                $patients = $this->pharmacistModel->searchPatient($patientName);
        
                $data = [
                    'patients' => $patients
                ];
                $this->view('pharmacist/pharmacist_searchedPatient', $data);
            }
        }

        // public function searchMedicine(){
        //     if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
        //         $medicineName = $_POST['search'];
        //         $medications = $this->pharmacistModel->searchMedicine($medicineName);
        
        //         $data = [
        //             'medications' => $medications
        //         ];
        //         $this->view('pharmacist/pharmacist_allMedications', $data);
        //     }
        // }

        public function searchMedicine(){
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
                $medicineName = $_POST['search'];
                $medications = $this->pharmacistModel->searchMedicine($medicineName);
                $totalMedications = $this->pharmacistModel->getTotalMedicationsCount(); // Fetch total count of medications
        
                if (empty($medications)) {
                    // No medicine found, redirect to the newMed view
                    $this->view('pharmacist/pharmacist_addNewMed');
                } else {
                    // Medicine found, display the searchedMedicine view
                    $data = [
                        'medications' => $medications,
                        'totalMedications' => $totalMedications, // Include total count in the data array
                    ];
            
                    $this->view('pharmacist/pharmacist_searchedMedicine', $data);
                }
            }
        }
        
        
    }
?>
