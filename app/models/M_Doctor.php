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

    
}