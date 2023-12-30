<?php
class M_Patient
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAppointments()
    {
        $this->db->query('SELECT * FROM appointments WHERE patient_ID = 125');
        $result = $this->db->resultSet();
        return $result;
    }

    public function viewAppointment($appointment_ID)
    {
        $this->db->query('SELECT * FROM appointments WHERE patient_ID = 125 AND appointment_ID = :appointment_id');
        $this->db->bind(':appointment_id', $appointment_ID);
        $result = $this->db->single(); // Assuming you have a method to retrieve a single row
        return $result;
    }
}
?>