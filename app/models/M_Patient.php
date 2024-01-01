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

    public function searchDoctor()
    {
        $this->db->query('SELECT * FROM doctors');
        $result = $this->db->resultSet();
        return $result;
    }

    public function docSession($doctor_ID)
    {
        $currentDate = date('Y-m-d');
        $this->db->query('SELECT s. *, d.fName, d.lName, d.specialization FROM sessions s 
        INNER JOIN doctors d ON s.doctor_ID = d.doctor_ID 
        WHERE s.doctor_ID = :doctor_id 
        AND s.sessionDate >= :current_date 
        AND s.total_appointments >= s.current_appointment
        ORDER BY s.sessionDate ASC, s.time ASC');
        $this->db->bind(':doctor_id', $doctor_ID);
        $this->db->bind(':current_date', $currentDate);
        $result = $this->db->resultSet();
        return $result;
    }


    public function confirmAppointment($patient_ID, $session_ID)
    {
        $sessionDetails = $this->getSessionDetails($session_ID);

        if ($sessionDetails) {
            $doctor_ID = $sessionDetails->doctor_ID;

            // Start a database transaction
            $this->db->beginTransaction();

            try {
                $this->db->query('INSERT INTO appointments (patient_ID, session_ID, doctor_ID, date) 
                             VALUES (:patient_id, :session_id, :doctor_id, :session_date)');
                $this->db->bind(':patient_id', $patient_ID);
                $this->db->bind(':session_id', $session_ID);
                $this->db->bind(':doctor_id', $doctor_ID);
                $this->db->bind(':session_date', $sessionDetails->sessionDate);
                $this->db->execute();

                $this->db->query('UPDATE sessions SET current_appointment = current_appointment + 1 WHERE session_ID = :session_id');
                $this->db->bind(':session_id', $session_ID);
                $this->db->execute();

                $this->db->commit();

                return true;
            } catch (Exception $e) {
                // An error occurred, rollback the transaction
                $this->db->rollBack();
                return false;
            }
        }

        return false;
    }

    public function getSessionDetails($session_ID)
    {
        $this->db->query('SELECT * FROM sessions WHERE session_ID = :session_id');
        $this->db->bind(':session_id', $session_ID);
        $result = $this->db->single();
        return $result;
    }

}
?>