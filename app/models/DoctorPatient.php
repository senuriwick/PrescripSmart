<?php

class DoctorPatient {
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function getPatientsDetails(){
        $this->db->query('SELECT * FROM patientDetails');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getPrescriptionDetails(){
        $this->db->query('SELECT * FROM prescriptions');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getPrescriptionCount(){
        $this->db->query('SELECT * FROM prescriptions');
        $this->db->resultSet();
        return $this->db->rowCount();
    }

    public function getReportDetails(){
        $this->db->query('SELECT * FROM reports');
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

    
}