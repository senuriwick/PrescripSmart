<?php
class DoctorPatients extends Controller{
    public function __construct(){
        $this->dpModel = $this->model('DoctorPatient');
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

    public function addPrescription(){
        $this->view('doctor/add_prescription');
    }

    public function viewPrescriptions(){
        $prescriptionDetails = $this->dpModel->getPrescriptionDetails();
        $prescriptionCount = $this->dpModel->getPrescriptionCount();

        $data = [
            'prescriptionsData' => $prescriptionDetails,
            'prescriptionsCount' => $prescriptionCount
        ];
        $this->view('doctor/prescriptions',$data);
    }

    public function viewReports(){
        $reportDetails = $this->dpModel->getReportDetails();
        $reportCount = $this->dpModel->getReportCount();

        $data = [
            'reportsData' => $reportDetails,
            'reportsCount' => $reportCount
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
    

}
?>