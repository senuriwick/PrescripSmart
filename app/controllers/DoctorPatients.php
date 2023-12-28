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

    

}
?>