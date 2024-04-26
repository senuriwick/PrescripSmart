<?php

class M_Doctor
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPatientsDetails($sessionId)
    {
        $this->db->query('SELECT appointments.*, patients.* FROM appointments LEFT JOIN patients ON appointments.patient_ID=patients.patient_ID WHERE appointments.session_ID=:session_id');
        $this->db->bind(':session_id',$sessionId);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getPrescriptionDetails($patientid)
    {
        $this->db->query('SELECT prescriptions.*, doctors.* FROM `prescriptions` LEFT JOIN `doctors` ON prescriptions.doctor_ID=doctors.doctor_ID WHERE patient_ID=:id');
        $this->db->bind(':id', $patientid);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getPrescriptionCount($patientid)
    {
        $this->db->query('SELECT * FROM prescriptions WHERE patient_ID=:id');
        $this->db->bind(':id', $patientid);
        $this->db->resultSet();
        return $this->db->rowCount();
    }

    public function getDiagnosis($diagnosisId)
    {
        $this->db->query('SELECT prescriptions.*, doctors.* ,patients.* FROM `prescriptions` LEFT JOIN `patients` ON patients.patient_ID=prescriptions.patient_ID LEFT JOIN `doctors` ON prescriptions.doctor_ID=doctors.doctor_ID WHERE prescription_ID=:id');
        $this->db->bind(':id', $diagnosisId);
        $results = $this->db->single();
        return $results;
    }

    public function getMedications($diagnosisId)
    {
        $this->db->query('SELECT * FROM patients_medications WHERE prescription_ID=:id');
        $this->db->bind(':id', $diagnosisId);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getTests($diagnosisId)
    {
        $this->db->query('SELECT lab_reports.*, tests.* FROM `lab_reports` LEFT JOIN `tests` ON lab_reports.test_ID=tests.test_ID WHERE prescription_ID=:id');
        $this->db->bind(':id', $diagnosisId);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getReportDetails($patientid)
    {
        $this->db->query('SELECT lab_reports.* , doctors.*, tests.* FROM `lab_reports` LEFT JOIN `doctors` ON lab_reports.doctor_ID=doctors.doctor_ID LEFT JOIN `tests` ON lab_reports.test_ID=tests.test_ID WHERE lab_reports.patient_ID=:id');
        $this->db->bind(':id', $patientid);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getReportCount($patientid)
    {
        $this->db->query('SELECT lab_reports.* , doctors.*, tests.* FROM `lab_reports` LEFT JOIN `doctors` ON lab_reports.doctor_ID=doctors.doctor_ID LEFT JOIN `tests` ON lab_reports.test_ID=tests.test_ID WHERE lab_reports.patient_ID=:id');
        $this->db->bind(':id', $patientid);
        $this->db->resultSet();
        return $this->db->rowCount();
    }

    public function getReport($reportid)
    {
        $this->db->query('SELECT * FROM lab_reports WHERE report_ID=:id');
        $this->db->bind(':id', $reportid);
        $result = $this->db->single();
        return $result;
    }

    public function getSessionsDetails($userid)
    {
        $this->db->query('SELECT * FROM sessions WHERE doctor_ID=:id');
        $this->db->bind(':id', $userid);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getOngonigSession($doctorId){
        $this->db->query('SELECT * FROM sessions WHERE (start_time <= end_time AND CURTIME() BETWEEN start_time AND end_time)
        OR (start_time > end_time AND (CURTIME() >= start_time OR CURTIME() <= end_time)) AND doctor_ID=:doctor_id');
        $this->db->bind(':doctor_id',$doctorId);
        $result = $this->db->single();
        return $result;
    }

    public function getOngoingPatient($sessionId){
        $this->db->query('SELECT appointments.*, patients.* FROM appointments LEFT JOIN patients ON appointments.patient_ID=patients.patient_ID WHERE appointments.status="active" AND appointments.session_ID=:session_id ORDER BY appointments.token_No ASC LIMIT 1');
        $this->db->bind(':session_id',$sessionId);
        $result = $this->db->single();
        return $result;
    }

    public function getonePatient($patientid)
    {
        $this->db->query('SELECT * FROM patients WHERE patient_ID=:id');
        $this->db->bind(':id', $patientid);
        $results = $this->db->single();
        return $results;
    }

    public function searchMedications($query)
    {
        $this->db->query("SELECT * FROM medicine_data WHERE Material_Description LIKE '%$query%'");
        $results = $this->db->resultSet();
        return $results;
    }

    public function searchTests($query)
    {
        $this->db->query("SELECT * FROM tests WHERE name LIKE '%$query%'");
        $results = $this->db->resultSet();
        return $results;
    }

    public function addMedication($patientId, $diagnosisId, $medicationId, $medication, $remark)
    {
        // Using placeholders in the query to prevent SQL injection
        $this->db->query('INSERT INTO patients_medications (patient_ID, prescription_ID, medication_ID, medication, remark) VALUES (:patient_id, :diagnosis_id, :medication_id, :medication, :remark)');

        // Binding parameters
        $this->db->bind(':patient_id', $patientId);
        $this->db->bind(':diagnosis_id', $diagnosisId);
        $this->db->bind(':medication', $medication);
        $this->db->bind(':remark', $remark);
        $this->db->bind(':medication_id',$medicationId);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getpatientAppointmentId($sessionId,$patientId){
        $this->db->query('SELECT * FROM appointments WHERE session_ID=:session_id AND patient_ID=:patient_id');
        $this->db->bind(':session_id',$sessionId);
        $this->db->bind(':patient_id',$patientId);
        $result = $this->db->single();
        return $result;
    }

    public function addDiagnosis($patientId, $diagnosis,$doctorId,$appointmentId)
    {
        $this->db->query('INSERT INTO prescriptions (doctor_ID, patient_ID, diagnosis, prescription_Date, appointment_ID) VALUES (:doctor_id, :patient_id, :diagnosis, CURDATE(), :appointment_id)');
        $this->db->bind(':patient_id', $patientId);
        $this->db->bind(':diagnosis', $diagnosis);
        $this->db->bind(':appointment_id',$appointmentId);
        $this->db->bind(':doctor_id',$doctorId);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addTest($patientId, $testId, $diagnosisId, $remark,$doctorId)
    {
        $this->db->query('INSERT INTO lab_reports (test_ID, patient_ID, prescription_ID, remarks, doctor_ID) VALUES (:test_id, :patient_id, :diagnosis_id, :remarks, :doctor_id)');
        $this->db->bind(':patient_id', $patientId);
        $this->db->bind(':test_id', $testId);
        $this->db->bind(':diagnosis_id', $diagnosisId);
        $this->db->bind(':remarks', $remark);
        $this->db->bind(':doctor_id',$doctorId);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getDiagnosisId($patientid)
    {
        $this->db->query('SELECT prescription_ID FROM prescriptions WHERE patient_ID=:id ORDER BY prescription_ID DESC LIMIT 1');
        $this->db->bind(':id', $patientid);
        $results = $this->db->single();
        return $results;
    }

    public function getMedicationId($medicationName){
        $this->db->query('SELECT * FROM  medicine_data WHERE Material_Description=:medicationName');
        $this->db->bind(':medicationName',$medicationName);
        $result = $this->db->single();
        return $result;
    }

    public function getTestId($testname){
        $this->db->query("SELECT * FROM tests WHERE name=:testname");
        $this->db->bind(':testname',$testname);
        $results = $this->db->single();
        return $results;
    }

    public function getProfileDetails($id)
    {
        $this->db->query('SELECT * FROM users WHERE user_ID=:id');
        $this->db->bind(':id', $id);
        $result = $this->db->single();
        return $result;
    }

    public function getPersonalInfo($id)
    {
        $this->db->query('SELECT * FROM doctors WHERE doctor_ID=:id');
        $this->db->bind(':id', $id);
        $result = $this->db->single();
        return $result;
    }


    public function doctorInfo()
    {
        $this->db->query('SELECT * FROM users WHERE user_ID = :userID');
        $this->db->bind(':userID', $_SESSION['USER_DATA']->user_ID);
        $result = $this->db->single();
        return $result;
    }

    public function doctorDetails()
    {
        $this->db->query('SELECT * FROM doctors WHERE doctor_ID = :doctorID');
        $this->db->bind(':doctorID', $_SESSION['USER_DATA']->user_ID);
        $result = $this->db->single();
        return $result;
    }

    public function updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $regno, $qual, $spec, $dep)
    {
        $this->db->query('UPDATE doctors SET first_Name = :fname, last_Name = :lname, display_Name = :dname, 
            home_Address = :haddress, NIC = :nic, contact_Number = :cno, registration_No = :regno, qualifications = :qual, 
            specialization = :spec, department = :dep
            WHERE doctor_ID = :doctorID');

        $this->db->bind(':fname', $fname);
        $this->db->bind(':lname', $lname);
        $this->db->bind(':dname', $dname);
        $this->db->bind(':haddress', $haddress);
        $this->db->bind(':nic', $nic);
        $this->db->bind(':cno', $cno);
        $this->db->bind(':regno', $regno);
        $this->db->bind(':qual', $qual);
        $this->db->bind(':spec', $spec);
        $this->db->bind(':dep', $dep);
        $this->db->bind(':doctorID', $_SESSION['USER_DATA']->user_ID);

        $this->db->execute();
    }

    public function updateAccInfo($username)
    {
        $this->db->query('UPDATE users SET username = :username 
        WHERE user_ID = :doctorID');
        $this->db->bind(':username', $username);
        $this->db->bind(':doctorID', $_SESSION['USER_DATA']->user_ID);

        $this->db->execute();
    }

    public function resetPassword($newpassword)
    {
        $this->db->query('UPDATE users SET password = :newpassword 
        WHERE user_ID = :doctorID');
        $this->db->bind(':newpassword', password_hash($newpassword, PASSWORD_BCRYPT));
        $this->db->bind(':doctorID', $_SESSION['USER_DATA']->user_ID);
        $this->db->execute();
    }

    public function updateProfilePicture($filename, $userID)
    {
        try {
            $this->db->query('UPDATE users SET profile_photo = :profile_picture WHERE user_ID = :user_id');
            $this->db->bind(':profile_picture', $filename);
            $this->db->bind(':user_id', $userID);
            $this->db->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    public function updateSign($filename, $userID)
    {
        try {
            $this->db->query('UPDATE doctors SET signature = :sign WHERE doctor_ID = :doctor_id');
            $this->db->bind(':sign', $filename);
            $this->db->bind(':doctor_id', $userID);
            $this->db->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
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