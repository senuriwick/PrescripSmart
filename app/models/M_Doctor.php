<?php

class M_Doctor {
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function getPatientsDetails(){
        $this->db->query('SELECT * FROM patientDetails');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getPrescriptionDetails($patientid){
        $this->db->query('SELECT * FROM prescriptions WHERE patient_id=:id');
        $this->db->bind(':id',$patientid);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getPrescriptionCount($patientid){
        $this->db->query('SELECT * FROM prescriptions WHERE patient_id=:id');
        $this->db->bind(':id',$patientid);
        $this->db->resultSet();
        return $this->db->rowCount();
    }

    public function getReportDetails($patientid){
        $this->db->query('SELECT * FROM reports WHERE patient_id=:id');
        $this->db->bind(':id',$patientid);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getReportCount(){
        $this->db->query('SELECT * FROM reports');
        $this->db->resultSet();
        return $this->db->rowCount();
    }

    public function getSessionsDetails(){
        $this->db->query('SELECT * FROM doctorSessions');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getonePatient($patientid){
        $this->db->query('SELECT * FROM patientDetails WHERE patient_id=:id');
        $this->db->bind(':id',$patientid);
        $results = $this->db->single();
        return $results;
    }

    public function searchMedications($term){
        $this->db->query('SELECT * FROM medications WHERE Material_Description LIKE :term');
        $this->db->bind(':term',$term);
        $results = $this->db->resultSet();
        return json_encode($results);
        // return $results;
    }

    public function addPrescriptionTableforId($patientid){
        $this->db->query('CREATE TABLE prescriptionfor (
            medication_id INT PRIMARY KEY,
            medication_name VARCHAR(50),
            dosage VARCHAR(50),
            remarks VARCHAR(50))');
        $this->db->bind(':id',$patientid);
    }

    public function addMedi(){
        $this->db->query('CREATE ');
    }
    
}