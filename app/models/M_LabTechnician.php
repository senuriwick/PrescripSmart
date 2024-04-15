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

    public function getTests($patientID){
        $this->db->query('SELECT test.* , doctordetails.* FROM `test` LEFT JOIN `doctordetails` 
        ON test.doctor_id=doctordetails.doctor_id WHERE test.patient_id=:id AND test.marked=""');
        $this->db->bind(':id',$patientID);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getTestCount($patientID){
        $this->db->query('SELECT * FROM test WHERE patient_id=:id AND marked=""');
        $this->db->bind(':id',$patientID);
        $results=$this->db->resultSet();
        return $this->db->rowCount();
    }

    public function markedTest($testNo){
        $this->db->query('UPDATE test SET marked="1" WHERE test_no=:num');
        $this->db->bind(':num',$testNo);
        $this->db->execute();
    }

    public function getReportid($testno){
        //
    }

    public function uploadReport($testid,$reportname,$patientid){
        $this->db->query('INSERT INTO reports (test_id,patient_id,file_name) VALUES (:testid,:patientid,:reportname)');
        $this->db->bind(':testid',$testid);
        $this->db->bind(':patientid',$patientid);
        $this->db->bind(':reportname',$reportname);
        $this->db->execute();
    }
}