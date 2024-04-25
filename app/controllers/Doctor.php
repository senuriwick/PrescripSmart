<?php
class Doctor extends Controller{

    private $dpModel;
    public function __construct(){
        $this->dpModel = $this->model('M_Doctor');
    }
    public function index(){
        $this->view('doctor/patients');
    }
    public function patients(){
        $patientsDetails = $this->dpModel->getPatientsDetails();
        $data = [
            'patientsData' => $patientsDetails
        ];
        $this->view('doctor/patients',$data);
    }

    public function addPrescription($id){

            $patient = $this->dpModel->getonePatient($id);
            $data = [
                'patient' => $patient,
            
            ];
            $this->view('doctor/add_prescription',$data);
       
    }

    public function addMedication()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $diagnosis = $_POST['diagnosis'];
            $medications = $_POST['medications'];
            $remarks = $_POST['remarks'];
            $patient_id = $_POST['patientId'];
            $this->dpModel->addDiagnosis($patient_id, $diagnosis);
            // Process each medication and its corresponding remark
            for ($i = 0; $i < count($medications); $i++) {
                $medication = $medications[$i];
                $remark = $remarks[$i];
                $diagnosisID = $this->dpModel->getDiagnosisId($patient_id);

                // Insert into database
                // Your DB insertion code here
                $this->dpModel->addMedication($patient_id, $diagnosisID->prescription_ID, $medication, $remark);
            }

            if($_POST['tests']){
                $tests = $_POST['tests'];
                $testremarks = $_POST['testremarks']?? '';
                for($i =0;$i<count($tests);$i++){
                    $test = $tests[$i];
                    $testremark = $testremarks[$i];
                    $diagnosisID = $this->dpModel->getDiagnosisId($patient_id);
                    $testid = $this->dpModel->getTestId($test);
                    $this->dpModel->addTest($patient_id,$testid->test_ID,$diagnosisID->prescription_ID, $testremark);
                }
            }
            // After processing
            // Redirect or inform the user of success/failure
            redirect('/doctor/patients');
        }
        
    }

    public function searchMedication(){
        $query = $_GET['query'] ?? '';
        if (!empty($query)) {
            $results = $this->dpModel->searchMedications($query);
            header('Content-Type: application/json');
            echo json_encode($results);
        }
    }

    public function searchTest(){
        $query = $_GET['query']?? '';
        if(!empty($query)){
            $results = $this->dpModel->searchTests($query);
            header('Content-Type: application/json');
            echo json_encode($results);
        }
    }

    public function viewPrescriptions($id){
        $prescriptionDetails = $this->dpModel->getPrescriptionDetails($id);
        $prescriptionCount = $this->dpModel->getPrescriptionCount($id);
        $patient = $this->dpModel->getonePatient($id);

        $data = [
            'prescriptionsData' => $prescriptionDetails,
            'prescriptionsCount' => $prescriptionCount,
            'patient' => $patient
        ];
        $this->view('doctor/prescriptions',$data);
    }

    public function showDiagnosis(){
        $prescriptionid = $_GET['prescriptionid']?? '';
        if(!empty($prescriptionid)){
            $result = $this->dpModel->getDiagnosis($prescriptionid);
            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    public function showMedications(){
        $prescriptionid = $_GET['prescriptionid']?? '';
        if(!empty($prescriptionid)){
            $result = $this->dpModel->getMedications($prescriptionid);
            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    public function showTests(){
        $prescriptionid = $_GET['prescriptionid']?? '';
        if(!empty($prescriptionid)){
            $result = $this->dpModel->getTests($prescriptionid);
            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    public function viewReports($id){
        $reportDetails = $this->dpModel->getReportDetails($id);
        $reportCount = $this->dpModel->getReportCount($id);
        $patient = $this->dpModel->getonePatient($id);

        $data = [
            'reportsData' => $reportDetails,
            'reportsCount' => $reportCount,
            'patient' => $patient
        ];
        $this->view('doctor/reports',$data);
    }

    public function loadReport(){
        $reportid = $_GET['reportid']?? '';
        if(!empty($reportid)){
            $report = $this->dpModel->getReport($reportid);
            $filename = $report->report;
            $filepath = 'C:/xampp/htdocs/PrescripSmart/public/uploads/reports/'.$filename;
            if(file_exists($filepath)){
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="' .$filepath . '"');
                header('Content-Length:'.filesize($filepath));

                ob_clean();
                flush();

                readfile($filepath);
                exit;
            }else{
                echo 'Report not found or not uploaded';
            }
        }
    }

    public function sessions(){
        $userid = $_SESSION['USER_DATA']->user_ID;
        $sessionsDetails = $this->dpModel->getSessionsDetails($userid);
        $data = [
            'sessionsData' => $sessionsDetails
        ];
        $this->view('doctor/sessions',$data);
    }

    public function viewOngoingSession(){
        $this->view('doctor/on-going_session');
    }

    public function Profile(){
        $userid = $_SESSION['USER_DATA']->user_ID;
        $user = $this->dpModel->getProfileDetails($userid);
        $data = [
            'user' => $user
        ];
        $this->view('doctor/profile',$data);
    }

    public function changePassword(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if($_POST['submit']){
                $newpw = $_POST['newpw'];
                $confirmpw = $_POST['confirmPW'];
                

            }
        }
    }

    // public function personalInfo(){
    //     $userid = $_SESSION['USER_DATA']->user_ID;
    //     $user = $this->dpModel->getPersonalInfo($userid);
    //     $data = [
    //         'user' =>$user
    //     ];
    //     $this->view('doctor/personalinfo',$data);
    // }
    
    // public function security(){
    //     $this->view('doctor/security');
    // }

    public function personal_information()
    {
        $patient = $this->dpModel->doctorDetails();
        $user = $this->dpModel->doctorInfo();
        $data = [
            'doctor' => $patient,
            'user' => $user
        ];
        $this->view('doctor/personal_information', $data);
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

            $this->dpModel->updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $regno, $qual, $spec, $dep);

            header("Location: /prescripsmart/doctor/personal_information");
            exit();
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function account_information()
    {
        $doctor = $this->dpModel->doctorInfo();
        $data = [
            'doctor' => $doctor
        ];
        $this->view('doctor/account_information', $data);
    }

    public function accountInfoUpdate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $this->dpModel->updateAccInfo($username);

            header("Location: /prescripsmart/doctor/account_information");
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

    public function passwordReset()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newpassword = $_POST["newpassword"];
            $this->dpModel->resetPassword($newpassword);
            $this->dpModel->resetPassword($newpassword);

            header("Location: /prescripsmart/doctor/account_information");
            exit();
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
                    $result = $this->dpModel->updateProfilePicture($image, $userID);
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

    public function security()
    {
        $userID = $_SESSION['USER_DATA']->user_ID;
        $user = $this->dpModel->find_user_by_id($userID);
        $data = [
            'user' => $user
        ];
        $this->view('doctor/security', $data);
    }

    public function toggle2FA()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['toggle_state'])) {
                $toggleState = $_POST['toggle_state'];
                $userID = $_POST['userID'];

                if ($toggleState == 'on') {
                    $this->dpModel->manage2FA($toggleState, $userID);
                } else if ($toggleState == 'off') {
                    $this->dpModel->manage2FA($toggleState, $userID);
                }
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Toggle state not provided']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }

    }

}
?>