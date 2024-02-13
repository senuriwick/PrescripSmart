<?php

class M_LabTechnician {
    private $db;

    public function __construct(){
        $this->db = new DataBase;
    }

    public function repotsToUploadList(){
        $this->db->query('SELECT reports.* , patientdetails.* FROM `reports` LEFT JOIN `patientdetails` 
        ON reports.patient_id=patientdetails.patient_id WHERE file_name="" GROUP BY patientdetails.patient_id');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getPatient($patientID){
        $this->db->query('SELECT * FROM patientdetails WHERE patient_id=:id');
        $this->db->bind(':id',$patientID);
        $results = $this->db->single();
        return $results;
    }
}