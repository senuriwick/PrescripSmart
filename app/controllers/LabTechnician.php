<?php

class LabTechnician extends Controller{

    private $dpModel;
    public function __construct(){
        $this->dpModel = $this->model('M_LabTechnician');
    }

    public function index(){
        $this->view('lab_tech/patient');
    }

    public function patient(){
        $reportsToUpload = $this->dpModel->repotsToUploadList();
        $data = [
            'reportsToUpload' => $reportsToUpload
        ];

        $this->view('lab_tech/patient',$data);
    }

    // public function getpatientDetails($id){
    //     $patientDetails = $this->dpModel->getpatient($id);
    //     echo json_decode($patientDetails);
    // }

    // public function profile(){
    //     $this->view('lab_tech/profile');
    // }

    // public function personalInfo(){
    //     $this->view('lab_tech/personalinfo');
    // }

    // public function security(){
    //     $this->view('lab_tech/security');
    // }

    public function reports($id){
        $testData = $this->dpModel->getTests($id);
        $patientDetails = $this->dpModel->getPatient($id);
        $testCount = $this->dpModel->getTestCount($id);
        $data = [
            'patientDetails'=>$patientDetails,
            'testData'=>$testData,
            'testCount' =>$testCount
        ];
        $this->view('lab_tech/reports',$data);
    }

    public function markedRead(){
        if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['reportid'])){
            $reportid = $_POST['reportid'];
            
            $this->dpModel->markedTest($reportid);
            // $patient = $this->dpModel->checkReport($reportid);
            // $patientId =$patient->patient_ID;

            // header('Location:'.URLROOT.'/LabTechnician/reports/'.$patientId);
            // exit;
        }else{
            echo "Error";
        }
        
    }

    public function reportUpload(){
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            if(isset($_POST['upload'])){
                $patientid = $_POST['patientid'];
                $reportid = $_POST['reportid'];
                $reportname = $_FILES['file']['name'];
                $reporttype = $_FILES['file']['type'];
                $reportTemp = $_FILES['file']['tmp_name'];
                $reportsize = $_FILES['file']['size'];
                $destination = 'C:/xampp/htdocs/PrescripSmart/public/uploads/reports/'.$reportname;
                if(is_uploaded_file($reportTemp)){
                    if($reporttype=='application/pdf'){
                        if(move_uploaded_file($reportTemp,$destination)){
                            echo "Uploaded succes";
                            $this->dpModel->uploadReport($reportid,$reportname,$reportsize);
                        }
                    }else{
                        echo "Please select only pdf file";
                    }
                }else{
                    echo "No file selected";

                }        
        }
        header('Location:'.URLROOT.'/LabTechnician/reports/'.$patientid);
        exit;
        }
    }

    public function deletereport(){
        if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['reportid'])){
            $reportid = $_POST['reportid'];
                $this->dpModel->deleteReport($reportid);

        }
    }

    public function account_information()
    {
        $tech = $this->dpModel->techInfo();
        $data = [
            'tech' => $tech
        ];
        $this->view('lab_tech/account_information', $data);
    }

    public function accountInfoUpdate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $this->dpModel->updateAccInfo($username);

            header("Location: /prescripsmart/LabTechnician/account_information");
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

            header("Location: /prescripsmart/LabTechnician/account_information");
            exit();
        }
    }

    public function personal_information()
    {
        $tech = $this->dpModel->techDetails();
        $user = $this->dpModel->techInfo();
        $data = [
            'tech' => $tech,
            'user' => $user
        ];
        $this->view('lab_tech/personal_information', $data);
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

            header("Location: /prescripsmart/LabTechnician/personal_information");
            exit();
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function security()
    {
        $userID = $_SESSION['USER_DATA']->user_ID;
        $user = $this->dpModel->find_user_by_id($userID);
        $data = [
            'user' => $user
        ];
        $this->view('lab_tech/security', $data);
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

}
