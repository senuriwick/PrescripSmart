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

    public function sessions()
    {
        $this->db->query('SELECT s.*, d.fName, d.lName, d.specialization FROM sessions s
        INNER JOIN doctors d ON s.doctor_ID = d.doctor_ID
        WHERE s.sessionDate >= CURRENT_DATE AND s.nurse_ID = :nurseID');
        $this->db->bind(':nurseID', 1254638);

        $result = $this->db->resultSet();
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

    public function nurseInfo()
    {
        // $this->db->query('SELECT * FROM nurses WHERE nurse_ID = 1254638');
        $this->db->query('SELECT user_ID,username,email_phone,password FROM users WHERE user_ID = 1254638');
        $result = $this->db->single();
        return $result;
    }

    public function updateAccInfo($username)
    {
        $this->db->query('UPDATE users SET username = :username 
        WHERE user_ID = 1254638');
        $this->db->bind(':username', $username);
        // $this->db->bind(':password', $newpassword);

        $this->db->execute();
    }

    public function resetPassword($newpassword)
    {
        $this->db->query('UPDATE users SET password = :newpassword 
        WHERE user_ID = 1254638');
        $this->db->bind(':newpassword', password_hash($newpassword, PASSWORD_BCRYPT));
        $this->db->execute();
    }

    public function nurseDetails()
    {
        $this->db->query('SELECT * FROM nurses WHERE nurse_ID = 1254638');
        $result = $this->db->single();
        return $result;
    }

    public function updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $regno, $qual, $spec)
    {
        $this->db->query('UPDATE nurses SET first_Name = :fname, last_Name = :lname, display_Name = :dname, 
            home_Address = :haddress, NIC = :nic, contact_Number = :cno, registration_No = :regno, qualifications = :qual, 
            specializations = :spec
            WHERE nurse_ID = 1254638');

        $this->db->bind(':fname', $fname);
        $this->db->bind(':lname', $lname);
        $this->db->bind(':dname', $dname);
        $this->db->bind(':haddress', $haddress);
        $this->db->bind(':nic', $nic);
        $this->db->bind(':cno', $cno);
        $this->db->bind(':regno', $regno);
        $this->db->bind(':qual', $qual);
        $this->db->bind(':spec', $spec);

        $this->db->execute();
    }

    public function find_user_by_id($user_ID)
    {
        $this->db->query('SELECT * FROM users WHERE user_ID = :user_ID');
        $this->db->bind(':user_ID', $user_ID);
        $result = $this->db->single();
        return $result;
    }

    public function manage2FA($toggleState, $userID)
    {
        $this->db->query('UPDATE users SET two_factor_auth = :TFA WHERE user_ID = :userID');
        $this->db->bind(':TFA', $toggleState);
        $this->db->bind(':userID', $userID);
        $this->db->execute();
    }
}