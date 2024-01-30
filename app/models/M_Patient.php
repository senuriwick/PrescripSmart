<?php
class M_Patient
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function users($email_address)
    {
        $this->db->query('SELECT * FROM users WHERE email_phone = :email_address');
        $this->db->bind(':email_address', $email_address);
        $result = $this->db->single();
        return $result;
    }

    public function user($user_ID)
    {
        $this->db->query('SELECT * FROM users WHERE user_ID = :user_ID');
        $this->db->bind(':user_ID', $user_ID);
        $result = $this->db->single();
        return $result;
    }

    public function register($first_name, $last_name, $email_address, $password, $activation_code, int $expiry = 1 * 24  * 60 * 60)
    {
        $this->db->query('INSERT INTO users (username, email_phone, password, first_Name, last_Name, role, activation_code, activation_expiry) 
                          VALUES (:username, :email_address, :password, :first_name, :last_name, "Patient", :activation_code, :expiry)');
        $this->db->bind(':first_name', $first_name);
        $this->db->bind(':last_name', $last_name);
        $this->db->bind(':username', $first_name . '_' . $last_name);
        $this->db->bind(':email_address', $email_address);
        $this->db->bind(':password', password_hash($password, PASSWORD_BCRYPT));
        $this->db->bind(':activation_code', password_hash($activation_code, PASSWORD_DEFAULT));
        $this->db->bind(':expiry', date('Y-m-d H:i:s', time() + $expiry));

        $this->db->execute();
        $reference = $this->db->lastInsertId();
        return $reference;
    }
    public function authenticate($email_address, $password)
    {
        $this->db->query('SELECT * FROM patients WHERE email_Address = :email_address OR contact_Number = :email_address');
        $this->db->bind(':email_address', $email_address);
        $result = $this->db->single();
        return $result;
    }

    public function activate($email)
    {
        $this->db->query('UPDATE users SET active = 1, activated_at = CURRENT_TIMESTAMP WHERE email_phone = :email');
        $this->db->bind(':email', $email);
        $this->db->execute();
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

            $this->db->query('UPDATE sessions SET current_appointment = current_appointment + 1 
                          WHERE session_ID = :session_id');
            $this->db->bind(':session_id', $session_ID);
            $this->db->execute();

            $this->db->commit();

            return $reference;
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            $this->db->rollBack();
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
        $this->db->query('SELECT p. *, d.fName, d.lName FROM prescriptions p 
        INNER JOIN doctors d ON p.doctor_ID = d.doctor_ID 
        WHERE p.patient_ID = 125 AND p.prescription_ID = :prescription_id');
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

    public function updateDownloadCount($reportId)
    {
        $this->db->query('UPDATE lab_reports SET downloads = downloads + 1 WHERE report_ID = :report_id');
        $this->db->bind(':report_id', $reportId);
        $this->db->execute();
    }

    public function patientInfo()
    {
        $this->db->query('SELECT * FROM patients WHERE patient_ID = 1248623');
        $result = $this->db->single();
        return $result;
    }

    public function updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $dob, $age, $gender, $height, $weight, $ename, $econtact, $relationship)
    {
        $this->db->query('UPDATE patients SET first_Name = :fname, last_Name = :lname, display_Name = :dname, 
            home_Address = :haddress, NIC = :nic, contact_Number = :cno, DOB = :dob, age = :age, 
            gender = :gender, height = :height, weight = :weight, 
            emergency_Contact_Person = :ename, emergency_Contact_Number = :econtact, relationship = :relationship
                          WHERE patient_ID = 1248623');

        $this->db->bind(':fname', $fname);
        $this->db->bind(':lname', $lname);
        $this->db->bind(':dname', $dname);
        $this->db->bind(':haddress', $haddress);
        $this->db->bind(':nic', $nic);
        $this->db->bind(':cno', $cno);
        $this->db->bind(':dob', $dob);
        $this->db->bind(':age', $age);
        $this->db->bind(':gender', $gender);
        $this->db->bind(':height', $height);
        $this->db->bind(':weight', $weight);
        $this->db->bind(':ename', $ename);
        $this->db->bind(':econtact', $econtact);
        $this->db->bind(':relationship', $relationship);

        $this->db->execute();
    }

    public function updateAccInfo($username)
    {
        $this->db->query('UPDATE patients SET username = :username 
        WHERE patient_ID = 1248623');
        $this->db->bind(':username', $username);
        // $this->db->bind(':password', $newpassword);

        $this->db->execute();
    }

    public function resetPassword($newpassword)
    {
        $this->db->query('UPDATE patients SET password = :newpassword 
        WHERE patient_ID = 1248623');
        $this->db->bind(':newpassword', $newpassword);
        $this->db->execute();
    }

}