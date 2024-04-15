<?php

class LabTechnician extends Controller{
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

    public function profile(){
        $this->view('lab_tech/profile');
    }

    public function personalInfo(){
        $this->view('lab_tech/personalinfo');
    }

    public function security(){
        $this->view('lab_tech/security');
    }

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
        if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['testid'])){
            $testid = $_POST['testid'];
            $this->dpModel->markedTest($testid);
        }else{
            echo "Error";
        }
    }

    public function reportUpload($id,$testid){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(isset($_POST['upload'])){
                $reportname = $_FILES['file']['name'];
                $reporttype = $_FILES['file']['type'];
                $reportTemp = $_FILES['file']['tmp_name'];
                $destination = 'C:/xampp/htdocs/PrescripSmart/public/uploads/reports/'.$reportname;
                if(is_uploaded_file($reportTemp)){
                    if($reporttype=='application/pdf'){
                        if(move_uploaded_file($reportTemp,$destination)){
                            echo "Uploaded succes";
                            $this->dpModel->uploadReport($testid,$reportname,$id);
                        }
                    }else{
                        echo "Please select only pdf file";
                    }
                }else{
                    echo "No file selected";

                }        
        }
        // redirect('LabTechnician/reports');
        // exit();
        }
    }

    public function deletereport(){
        if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['delete'])){
            $testid = $_POST['testid'];
            $reportid = $this->dpModel->getReportid($testid);

            $this->dpModel->deleteReport($reportid);
            $this->dpModel->removeReport($testid);
        }
    }

}
