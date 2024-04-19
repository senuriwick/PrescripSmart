<?php

class M_Doctor {
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function getPatientsDetails(){
        $this->db->query('SELECT * FROM patients');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getPrescriptionDetails($patientid){
        $this->db->query('SELECT * FROM patients_diagnosis WHERE patient_id=:id');
        $this->db->bind(':id',$patientid);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getPrescriptionCount($patientid){
        $this->db->query('SELECT * FROM patients_diagnosis WHERE patient_id=:id');
        $this->db->bind(':id',$patientid);
        $this->db->resultSet();
        return $this->db->rowCount();
    }

    public function getReportDetails($patientid){
        $this->db->query('SELECT lab_reports.* , doctors.*, tests.* FROM `lab_reports` LEFT JOIN `doctors` ON lab_reports.doctor_ID=doctors.doctor_ID LEFT JOIN `tests` ON lab_reports.test_ID=tests.test_ID WHERE lab_reports.patient_ID=:id');
        $this->db->bind(':id',$patientid);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getReportCount($patientid){
        $this->db->query('SELECT lab_reports.* , doctors.*, tests.* FROM `lab_reports` LEFT JOIN `doctors` ON lab_reports.doctor_ID=doctors.doctor_ID LEFT JOIN `tests` ON lab_reports.test_ID=tests.test_ID WHERE lab_reports.patient_ID=:id');
        $this->db->bind(':id',$patientid);
        $this->db->resultSet();
        return $this->db->rowCount();
    }

    public function getSessionsDetails(){
        $this->db->query('SELECT * FROM doctorSessions');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getonePatient($patientid){
        $this->db->query('SELECT * FROM patients WHERE patient_ID=:id');
        $this->db->bind(':id',$patientid);
        $results = $this->db->single();
        return $results;
    }

    public function searchMedications($query){
        $this->db->query("SELECT * FROM medications WHERE Material_Description LIKE '%$query%'");
        $results  = $this->db->resultSet();
        return $results;
    }

    public function searchTests($query){
        $this->db->query("SELECT * FROM tests WHERE name LIKE '%$query%'");
        $results = $this->db->resultSet();
        return $results;
    }

    public function addMedication($patientId, $diagnosisId, $medication, $remark)
    {
        // Using placeholders in the query to prevent SQL injection
        $this->db->query('INSERT INTO patients_medications (patient_id, diagnosis_id, medication, remark) VALUES (:patient_id, :diagnosis_id, :medication, :remark)');

        // Binding parameters
        $this->db->bind(':patient_id', $patientId);
        $this->db->bind(':diagnosis_id',$diagnosisId);
        $this->db->bind(':medication', $medication);
        $this->db->bind(':remark', $remark);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addDiagnosis($patientId, $diagnosis)
    {
        $this->db->query('INSERT INTO patients_diagnosis (patient_id, diagnosis) VALUES (:patient_id, :diagnosis)');
        $this->db->bind(':patient_id', $patientId);
        $this->db->bind(':diagnosis', $diagnosis);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addTest($patientId,$testId,$diagnosisId,$remark){
        $this->db->query('INSERT INTO lab_reports (test_ID, patient_ID, prescription_ID, remarks) VALUES (:test_id, :patient_id, :diagnosis_id, :remarks)');
        $this->db->bind(':patient_id',$patientId);
        $this->db->bind(':test_id',$testId);
        $this->db->bind(':diagnosis_id',$diagnosisId);
        $this->db->bind(':remarks',$remark);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getDiagnosisId($patientid){
        $this->db->query('SELECT diagnosis_id FROM patients_diagnosis WHERE patient_id=:id ORDER BY diagnosis_id DESC LIMIT 1');
        $this->db->bind(':id',$patientid);
        $results = $this->db->single();
        return $results;
    }

    public function getTestId($testname){
        $this->db->query("SELECT * FROM tests WHERE name=:testname");
        $this->db->bind(':testname',$testname);
        $results = $this->db->single();
        return $results;
    }
    
}