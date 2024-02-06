<?php
class M_Nurse
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function patients()
    {
        $this->db->query('SELECT * FROM patients');
        $result = $this->db->resultSet();
        return $result;
    }

    public function patientdetails($patientID)
    {
        $this->db->query('SELECT patient_ID, display_Name, age, weight, height, gender FROM patients WHERE patient_ID = :patientID');
        $this->db->bind(':patientID', $patientID);
        $result = $this->db->single();
        return $result;
    }
}