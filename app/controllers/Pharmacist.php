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
            $itemsPerPage =5;
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
        
        public function dashboardd($page = 1){
            $itemsPerPage =5;
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

        public function searchPatient($page = 1){
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {

                $patientName = $_POST['search'];

                $itemsPerPage =5;
                $offset = ($page - 1) * $itemsPerPage;

                $patients = $this->pharmacistModel->getSearchedPatientsPaginated($itemsPerPage,$offset, $patientName);
                $totalPatients = $this->pharmacistModel->getTotalPatientsCount();

                $totalPages = ceil($totalPatients/$itemsPerPage);
        
                if (!empty($patients)) {
                    $data = [
                        'patients' => $patients,
                        'totalMedications' => $totalMedications,
                        'currentPage' => $page,
                        'totalPages' => $totalPages,
                    ];
                    $this->view('pharmacist/pharmacist_dashboard', $data);  
                } else {
                    // Condition 3: If medicine not found, redirect to addNewMed page
                    $data = [];
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
        
        
        
    }
?>
