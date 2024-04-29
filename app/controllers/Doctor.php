<?php
class Doctor extends Controller{

    private $dpModel;
    public function __construct(){
        $this->dpModel = $this->model('M_Doctor');

        // if(!isLoggedIn())
        // {
        //     redirect('/general/home');
        // }
        
    }
    public function index(){
        $this->view('doctor/patients');
    }
    public function patients($page = 1){
        $doctorid = $_SESSION['USER_DATA']->user_ID;
        $ongoingsession = $this->dpModel->getOngonigSession($doctorid);
        if($ongoingsession){
            $ongoingsessionid = $ongoingsession->session_ID;
            $patientsDetails = $this->dpModel->getPatientsDetails($ongoingsessionid);
            $recodesPerPage =8;
            $totalPatients = count($patientsDetails);
            $totalPages = ceil($totalPatients / $recodesPerPage);

            $offset = ($page -1)*$recodesPerPage;
            $patients = array_slice($patientsDetails,$offset,$recodesPerPage);
            
        }else{
            $patientsDetails = '';
            $ongoingsession = '';
            $patients='';
            $page='';
            $totalPages='';
        }
        $data = [
            'patientsData' => $patientsDetails,
            'patients' => $patients,
            'ongoingSession' =>$ongoingsession,
            'currentPage' =>$page,
            'totalPages'=>$totalPages
        ];
        $this->view('doctor/patients',$data);
    }

    public function searchPatient(){
        $query = $_GET['query'];
        $doctorid = $_SESSION['USER_DATA']->user_ID;
        $ongoingsession = $this->dpModel->getOngonigSession($doctorid);
        if($ongoingsession){
            $ongoingsessionid = $ongoingsession->session_ID;
            $patientsDetails = $this->dpModel->filterPatients($ongoingsessionid,$query);
            header('Content-Type: application/json');
            echo json_encode($patientsDetails);
        }

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
            $patient_id = $_POST['patientId'];
            $doctorid = $_SESSION['USER_DATA']->user_ID;
            // $appointmentid = $this->dpModel->getAppointmentId();
            $sessionId = $this->dpModel->getOngonigSession($doctorid)->session_ID;
            $appointment = $this->dpModel->getpatientAppointmentId($sessionId,$patient_id);
            $this->dpModel->addDiagnosis($patient_id, $diagnosis,$doctorid,$appointment->appointment_ID);

            if($_POST['medications']){
                $medications = $_POST['medications'];
                $remarks = $_POST['remarks'];

            // Process each medication and its corresponding remark
                for ($i = 0; $i < count($medications); $i++) {
                    $medication = $medications[$i];
                    $remark = $remarks[$i];
                    $diagnosisID = $this->dpModel->getDiagnosisId($patient_id);
                    $medicationId = $this->dpModel->getMedicationId($medication);

                    // Insert into database
                    // Your DB insertion code here
                    $this->dpModel->addMedication($patient_id, $diagnosisID->prescription_ID,$medicationId->medicine_ID, $medication, $remark);
                }

            }

            if($_POST['tests']){
                $tests = $_POST['tests'];
                $testremarks = $_POST['testremarks']?? '';
                for($i =0;$i<count($tests);$i++){
                    $test = $tests[$i];
                    $testremark = $testremarks[$i];
                    $diagnosisID = $this->dpModel->getDiagnosisId($patient_id);
                    $testid = $this->dpModel->getTestId($test);
                    $this->dpModel->addTest($patient_id,$testid->test_ID,$diagnosisID->prescription_ID, $testremark, $doctorid);
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

    public function viewPrescriptions($id,$page=1){
        $prescriptionDetails = $this->dpModel->getPrescriptionDetails($id);
        $prescriptionCount = $this->dpModel->getPrescriptionCount($id);
        $patient = $this->dpModel->getonePatient($id);
        $recodesPerPage=8;
        $totalprescriptions=count($prescriptionDetails);
        $totalPages = ceil($totalprescriptions/$recodesPerPage);

        $offset = ($page-1)*$recodesPerPage;
        $prescriptions = array_slice($prescriptionDetails,$offset,$recodesPerPage);

        $data = [
            'prescriptionsData' => $prescriptionDetails,
            'prescriptionsCount' => $prescriptionCount,
            'patient' => $patient,
            'prescriptions'=>$prescriptions,
            'currentPage'=>$page,
            'totalPages'=>$totalPages
        ];
        $this->view('doctor/prescriptions',$data);
    }

    public function showDiagnosis(){
        $prescriptionid = $_GET['prescriptionid']?? '';
        if(!empty($prescriptionid)){
            $diagnosis = $this->dpModel->getDiagnosis($prescriptionid);
            $doctor = $this->dpModel->getDoctor($_SESSION['USER_DATA']->user_ID);
            header('Content-Type: application/json');
            echo json_encode(["prescription"=>$diagnosis,"doctor"=>$doctor]);
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

    public function viewReports($id,$page=1){
        $reportDetails = $this->dpModel->getReportDetails($id);
        $reportCount = $this->dpModel->getReportCount($id);
        $patient = $this->dpModel->getonePatient($id);
        $recodesPerPage=8;
        $totalreports = count($reportDetails);
        $totalPages = ceil($totalreports/$recodesPerPage);

        $offset = ($page-1)*$recodesPerPage;
        $reports = array_slice($reportDetails,$offset,$recodesPerPage);

        $data = [
            'reportsData' => $reportDetails,
            'reportsCount' => $reportCount,
            'patient' => $patient,
            'reports'=>$reports,
            'currentPage'=>$page,
            'totalPages'=>$totalPages
        ];
        $this->view('doctor/reports',$data);
    }

    public function chechRoport(){
        $reportid = $_GET['reportid']?? '';

        if(!empty($reportid)){
            $report = $this->dpModel->getReport($reportid);
            header('Content-Type: application/json');
            echo json_encode($report);
            // return $report;

        }
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


    public function showSessionPatients(){
        $sessionId = $_GET['sessionid'];
        if(!empty($sessionId)){
            $sessionPatients = $this->dpModel->getSessionPatients($sessionId);
            $sessionPatientCount = $this->dpModel->getSessionPatientsCount($sessionId);
            header('Content-Type: application/json');
            echo json_encode(["sessionPatients"=>$sessionPatients,"patientCount"=>$sessionPatientCount,"sessionId"=>$sessionId]);
        }
    }

    public function cancelSession(){
        $sessionId = $_GET['sessionid'];
        // var_dump($sessionId);
        // $msg = [];
        if(!empty($sessionId)){
            $cancel = $this->dpModel->cancelSession($sessionId);
            if($cancel){
                $msg = "Canceling session succesfull";
            }else{
                $msg="error";
            }
            header('Content-Type: application/json');
            echo json_encode($msg);
        }
    }

    public function verifyDoctor(){
        $userId = $_GET['userId'] ?? '';
        if (!empty($userId)) {
            $result = $this->dpModel->verifyDoctor($userId);
            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }

    public function viewOngoingSession(){

        $doctorid = $_SESSION['USER_DATA']->user_ID;
        $ongoingsession = $this->dpModel->getOngonigSession($doctorid);
        if($ongoingsession){
            $ongoingsessionid = $ongoingsession->session_ID;
            $ongoingPatient = $this->dpModel->getOngoingPatient($ongoingsessionid);
            
        }else{
            $ongoingPatient = '';
        }
        $data = [
            'ongoingPatient' => $ongoingPatient,
            'ongoingSession' => $ongoingsession
        ];
        $this->view('doctor/on-going_session',$data);
        
    }

    public function ongoingSessionPatient(){
        $patientId = $_GET['patientid'];
        $patient = $this->dpModel->getonePatient($patientId);
        header('Content-Type: application/json');
        echo json_encode($patient);
    }

    public function Profile(){
        $userid = $_SESSION['USER_DATA']->user_ID;
        $user = $this->dpModel->getProfileDetails($userid);
        $data = [
            'user' => $user
        ];
        $this->view('doctor/profile',$data);
    }

    // public function changePassword(){
    //     if($_SERVER['REQUEST_METHOD']=='POST'){
    //         if($_POST['submit']){
    //             $newpw = $_POST['newpw'];
    //             $confirmpw = $_POST['confirmPW'];
                

    //         }
    //     }
    // }

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

            if ($_FILES["sign"]["error"] === UPLOAD_ERR_OK) {
                $target_dir = "C:/xampp/htdocs/PrescripSmart/public/uploads/signatures/";
                $target_file = $target_dir . basename($_FILES["sign"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

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
                    if (move_uploaded_file($_FILES["sign"]["tmp_name"], $target_file)) {
                        echo "The file " . htmlspecialchars(basename($_FILES["sign"]["name"])) . " has been uploaded.";
                        $image = basename($_FILES["sign"]["name"]);
                        $userID = $_SESSION['USER_DATA']->user_ID;
                        $this->dpModel->updateSign($image, $userID);
                    } else {
                        header("Location: /prescripsmart/general/error_page");
                        exit();
                    }
                }
            }
            header("Location: /prescripsmart/doctor/personal_information");
            exit();
        } else {
            header("Location: /prescripsmart/general/error_page");
            exit();
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
            $_SESSION['USER_DATA']->password = password_hash($newpassword, PASSWORD_BCRYPT);
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