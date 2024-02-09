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

    public function doctors($doctorID)
    {
        $this->db->query('SELECT * FROM doctors WHERE doctor_ID = :doctorID');
        $this->db->bind(':doctorID', $doctorID);
        $result = $this->db->single();
        return $result;
    }

    public function patientdetails($patientID)
    {
        $this->db->query('SELECT patient_ID, display_Name, age, weight, height, gender FROM patients WHERE patient_ID = :patientID');
        $this->db->bind(':patientID', $patientID);
        $result = $this->db->single();
        return $result;
    }

    public function currentSession()
    {
        $this->db->query('SELECT * FROM sessions WHERE sessionDate = CURRENT_DATE AND start_time <= CURRENT_TIME AND end_time >= CURRENT_TIME AND nurse_ID = :nurseID');
        $this->db->bind(':nurseID', 1254638);

        $result = $this->db->single();
        return $result;
    }

    public function appointments($sessionID)
    {
        $this->db->query('SELECT a.*, p.display_Name, p.gender FROM appointments a
        INNER JOIN patients p ON a.patient_ID = p.patient_ID
        WHERE a.session_ID = :sessionID');
        $this->db->bind(':sessionID', $sessionID);
        //$this->db->bind(':nurseID', 1254638);
        $result = $this->db->resultSet();
        return $result;
    }

    public function filter_appointment_by_ID($appointmentID)
    {
        $this->db->query('SELECT * FROM appointments WHERE appointment_ID = :appointmentID');
        $this->db->bind(':appointmentID', $appointmentID);
        $result = $this->db->single();
        return $result;
    }

    public function markAppointmentComplete($appointmentID, $status)
    {
        try {
            $newStatus = ($status == 'completed') ? 'completed' : 'active';
            $this->db->query('UPDATE appointments SET status = :status WHERE appointment_ID = :appointmentID');
            $this->db->bind(':status', $newStatus);
            $this->db->bind(':appointmentID', $appointmentID);
            $this->db->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Error updating appointment status: ' . $e->getMessage());
            return false;
        }
    }
}