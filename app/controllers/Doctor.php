<?php
class Doctor extends Controller{
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
        $sessionsDetails = $this->dpModel->getSessionsDetails();
        $data = [
            'sessionsData' => $sessionsDetails
        ];
        $this->view('doctor/sessions',$data);
    }

    public function viewOngoingSession(){
        $this->view('doctor/on-going_session');
    }

    public function Profile(){
        $this->view('doctor/profile');
    }

    public function personalInfo(){
        $this->view('doctor/personalinfo');
    }
    
    public function security(){
        $this->view('doctor/security');
    }

}
?>