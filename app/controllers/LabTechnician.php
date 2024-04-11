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
        if(isset($_GET['testno'])){
            $testno = $_GET['testno'];
            $this->dpModel->markedTest($testno);
            echo "done";

            // header("Location: /prescripsmart/LabTechnician/reports");
            // exit();
        }
        

    }

    public function uploadReport($testid){
        echo $testid;
    }
}