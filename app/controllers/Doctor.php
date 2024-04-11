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

        $searchTerm = isset($_GET['query']) ? $_GET['query'] : '';

            $patient = $this->dpModel->getonePatient($id);
            $medications = $this->dpModel->searchMedications($searchTerm);
            $this->dpModel->addPrescriptionTableforId($id);
            $data = [
                'patient' => $patient,
                'medications'=> $medications
            ];
            $this->view('doctor/add_prescription',$data);
       
    }

    public function searchMedication(){
        if(isset($_GET['query'])){
            $searchTerm = $_GET['query'];
            $medications = $this->dpModel->searchMedications($searchTerm);
            $data = [
                'medications' =>$medications
            ];
            $this->view('doctor/add_prescription',$data);
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