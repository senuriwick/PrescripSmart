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
        $this->db->query('SELECT * FROM appointments WHERE patient_ID = 125 AND status = "active"');
        $result = $this->db->resultSet();
        return $result;
    }

    public function viewAppointment($appointment_ID)
    {
        $this->db->query('SELECT * FROM appointments WHERE patient_ID = 125 AND appointment_ID = :appointment_id AND status="active"');
        $this->db->bind(':appointment_id', $appointment_ID);
        $result = $this->db->single();
        return $result;
    }

    public function deleteAppointment($appointment_ID)
    {
        $this->db->query('UPDATE appointments SET status = "cancelled" 
        WHERE appointment_ID = :appointment_id');
        $this->db->bind(':appointment_id', $appointment_ID);
        return $this->db->execute();
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

    public function getSessionDetails($session_ID)
    {
        $this->db->query('SELECT * FROM sessions WHERE session_ID = :session_id');
        $this->db->bind(':session_id', $session_ID);
        $result = $this->db->single();
        return $result;
    }

    public function confirmAppointment($patient_ID, $session_ID, $doctor_ID, $time, $date)
    {
        try {
            $this->db->beginTransaction();

            // Insert into appointments table
            $this->db->query('INSERT INTO appointments (patient_ID, session_ID, doctor_ID, time, date, status) 
                          VALUES (:patient_id, :session_id, :doctor_id, :sessionTime, :session_date, "active")');
            $this->db->bind(':patient_id', $patient_ID);
            $this->db->bind(':session_id', $session_ID);
            $this->db->bind(':doctor_id', $doctor_ID);
            $this->db->bind(':sessionTime', $time);
            $this->db->bind(':session_date', $date);
            $this->db->execute();

            // Get the last inserted ID
            $reference = $this->db->lastInsertId();

            // Increment current_appointment in sessions table
            $this->db->query('UPDATE sessions SET current_appointment = current_appointment + 1 
                          WHERE session_ID = :session_id');
            $this->db->bind(':session_id', $session_ID);
            $this->db->execute();

            $this->db->commit();

            // Return the last inserted ID
            return $reference;
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            $this->db->rollBack();
            // Handle the exception
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function prescriptions()
    {
        $this->db->query('SELECT p. *, d.fName, d.lName FROM prescriptions p 
        INNER JOIN doctors d ON p.doctor_ID = d.doctor_ID 
        WHERE p.patient_ID = 125
        ORDER BY p.prescription_Date ASC');

        $result = $this->db->resultSet();
        return $result;
    }

    public function viewPrescription($prescription_ID)
    {
        $this->db->query('SELECT * FROM prescriptions WHERE patient_ID = 125 AND prescription_ID = :prescription_id');
        $this->db->bind(':prescription_id', $prescription_ID);
        $result = $this->db->single();
        return $result;
    }

    public function labreports()
    {
        $this->db->query('SELECT l.*, d.fName, d.lName, p.prescription_Date 
        FROM lab_reports l
        INNER JOIN doctors d ON l.doctor_ID = d.doctor_ID 
        INNER JOIN prescriptions p ON l.prescription_ID = p.prescription_ID
        WHERE l.patient_ID = 125
        ORDER BY l.report_Date ASC');

        $result = $this->db->resultSet();
        return $result;
    }
}
?>