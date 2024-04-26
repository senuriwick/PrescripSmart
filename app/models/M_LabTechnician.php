<?php

class M_LabTechnician {
    private $db;

    public function __construct(){
        $this->db = new DataBase;
    }

    public function repotsToUploadList(){
        $this->db->query('SELECT lab_reports.* , patients.* FROM `lab_reports` LEFT JOIN `patients` 
        ON lab_reports.patient_ID=patients.patient_ID WHERE lab_reports.report IS NULL OR lab_reports.date_of_conduct IS NULL GROUP BY patients.patient_ID');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getPatient($patientID){
        $this->db->query('SELECT * FROM patients WHERE patient_ID=:id');
        $this->db->bind(':id',$patientID);
        $results = $this->db->single();
        return $results;
    }

    public function getTests($patientID){
        $this->db->query('SELECT lab_reports.* , doctors.*, tests.* FROM `lab_reports` LEFT JOIN `doctors` 
        ON lab_reports.doctor_ID=doctors.doctor_ID LEFT JOIN `tests`ON tests.test_ID=lab_reports.test_ID WHERE lab_reports.patient_ID=:id AND date_of_conduct IS NULL');
        $this->db->bind(':id',$patientID);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getTestCount($patientID){
        $this->db->query('SELECT * FROM lab_reports WHERE patient_ID=:id AND date_of_conduct IS NULL');
        $this->db->bind(':id',$patientID);
        $results=$this->db->resultSet();
        return $this->db->rowCount();
    }

    public function markedTest($testNo){
        $this->db->query('UPDATE lab_reports SET date_of_conduct=NOW() WHERE report_ID=:num');
        $this->db->bind(':num',$testNo);
        $this->db->execute();
    }


    public function uploadReport($testid,$reportname,$filesize){
        $this->db->query('UPDATE lab_reports SET report=:reportname, size=:filesize, date_of_report=NOW() WHERE report_ID=:testid');
        $this->db->bind(':testid',$testid);
        $this->db->bind(':filesize',$filesize);
        $this->db->bind(':reportname',$reportname);
        $this->db->execute();
    }

    public function deleteReport($reportid){
        $this->db->query('UPDATE lab_reports SET report="",date_of_report=NULL WHERE report_ID=:reportid');
        $this->db->bind(':reportid',$reportid);
        $this->db->execute();
    }

    public function checkReport($testid){
        $this->db->query('SELECT * FROM lab_reports WHERE report_ID=:testid');
        $this->db->bind(':testid',$testid);
        $results = $this->db->single();
        return $results;
    }
}