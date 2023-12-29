<?php
class M_Patient {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAppointments(){
        $this->db->query('SELECT * FROM appointments WHERE patient_ID = 125');
        $result = $this->db->resultSet();
        return $result;
    }
}
?>