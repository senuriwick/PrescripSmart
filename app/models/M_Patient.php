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
        $result = $this->db->single();
        return $result;
    }

    public function searchDoctor(){
        $this->db->query('SELECT * FROM doctors');
        $result = $this->db->resultSet();
        return $result;
    }

    public function docSession($doctor_ID)
    {
        $currentDate = date('Y-m-d');
        $this->db->query('SELECT s. *, d.fName, d.lName, d.specialization FROM sessions s INNER JOIN doctors d ON s.doctor_ID = d.doctor_ID WHERE s.doctor_ID = :doctor_id AND s.sessionDate >= :current_date ORDER BY s.sessionDate ASC, s.time ASC');
        $this->db->bind(':doctor_id', $doctor_ID);
        $this->db->bind(':current_date', $currentDate);
        $result = $this->db->resultSet();
        return $result;
    }
}
?>