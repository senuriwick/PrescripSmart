<?php

class M_Doctor {
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function getPatientsDetails(){
        $this->db->query('SELECT * FROM patients');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getPrescriptionDetails($patientid){
        $this->db->query('SELECT prescriptions.*, doctors.* FROM `prescriptions` LEFT JOIN `doctors` ON prescriptions.doctor_ID=doctors.doctor_ID WHERE patient_ID=:id');
        $this->db->bind(':id',$patientid);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getPrescriptionCount($patientid){
        $this->db->query('SELECT * FROM prescriptions WHERE patient_ID=:id');
        $this->db->bind(':id',$patientid);
        $this->db->resultSet();
        return $this->db->rowCount();
    }

    public function getDiagnosis($diagnosisId){
        $this->db->query('SELECT prescriptions.*, doctors.* ,patients.* FROM `prescriptions` LEFT JOIN `patients` ON patients.patient_ID=prescriptions.patient_ID LEFT JOIN `doctors` ON prescriptions.doctor_ID=doctors.doctor_ID WHERE prescription_ID=:id');
        $this->db->bind(':id',$diagnosisId);
        $results = $this->db->single();
        return $results;
    }

    public function getMedications($diagnosisId){
        $this->db->query('SELECT * FROM patients_medications WHERE prescription_ID=:id');
        $this->db->bind(':id',$diagnosisId);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getTests($diagnosisId){
        $this->db->query('SELECT lab_reports.*, tests.* FROM `lab_reports` LEFT JOIN `tests` ON lab_reports.test_ID=tests.test_ID WHERE prescription_ID=:id');
        $this->db->bind(':id',$diagnosisId);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getReportDetails($patientid){
        $this->db->query('SELECT lab_reports.* , doctors.*, tests.* FROM `lab_reports` LEFT JOIN `doctors` ON lab_reports.doctor_ID=doctors.doctor_ID LEFT JOIN `tests` ON lab_reports.test_ID=tests.test_ID WHERE lab_reports.patient_ID=:id');
        $this->db->bind(':id',$patientid);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getReportCount($patientid){
        $this->db->query('SELECT lab_reports.* , doctors.*, tests.* FROM `lab_reports` LEFT JOIN `doctors` ON lab_reports.doctor_ID=doctors.doctor_ID LEFT JOIN `tests` ON lab_reports.test_ID=tests.test_ID WHERE lab_reports.patient_ID=:id');
        $this->db->bind(':id',$patientid);
        $this->db->resultSet();
        return $this->db->rowCount();
    }

    public function getReport($reportid){
        $this->db->query('SELECT * FROM lab_reports WHERE report_ID=:id');
        $this->db->bind(':id',$reportid);
        $result = $this->db->single();
        return $result;
    }

    public function getSessionsDetails($userid){
        $this->db->query('SELECT * FROM sessions WHERE doctor_ID=:id');
        $this->db->bind(':id',$userid);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getonePatient($patientid){
        $this->db->query('SELECT * FROM patients WHERE patient_ID=:id');
        $this->db->bind(':id',$patientid);
        $results = $this->db->single();
        return $results;
    }

    public function searchMedications($query){
        $this->db->query("SELECT * FROM medicine_data WHERE Material_Description LIKE '%$query%'");
        $results  = $this->db->resultSet();
        return $results;
    }

    public function searchTests($query){
        $this->db->query("SELECT * FROM tests WHERE name LIKE '%$query%'");
        $results = $this->db->resultSet();
        return $results;
    }

    public function addMedication($patientId, $diagnosisId, $medication, $remark)
    {
        // Using placeholders in the query to prevent SQL injection
        $this->db->query('INSERT INTO patients_medications (patient_ID, prescription_ID, medication, remark) VALUES (:patient_id, :diagnosis_id, :medication, :remark)');

        // Binding parameters
        $this->db->bind(':patient_id', $patientId);
        $this->db->bind(':diagnosis_id',$diagnosisId);
        $this->db->bind(':medication', $medication);
        $this->db->bind(':remark', $remark);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addDiagnosis($patientId, $diagnosis)
    {
        $this->db->query('INSERT INTO prescriptions (patient_ID, diagnosis, prescription_Date) VALUES (:patient_id, :diagnosis, CURDATE())');
        $this->db->bind(':patient_id', $patientId);
        $this->db->bind(':diagnosis', $diagnosis);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addTest($patientId,$testId,$diagnosisId,$remark){
        $this->db->query('INSERT INTO lab_reports (test_ID, patient_ID, prescription_ID, remarks) VALUES (:test_id, :patient_id, :diagnosis_id, :remarks)');
        $this->db->bind(':patient_id',$patientId);
        $this->db->bind(':test_id',$testId);
        $this->db->bind(':diagnosis_id',$diagnosisId);
        $this->db->bind(':remarks',$remark);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getDiagnosisId($patientid){
        $this->db->query('SELECT prescription_ID FROM prescriptions WHERE patient_ID=:id ORDER BY prescription_ID DESC LIMIT 1');
        $this->db->bind(':id',$patientid);
        $results = $this->db->single();
        return $results;
    }

    // public function getTestId($testname){
    //     $this->db->query("SELECT * FROM tests WHERE name=:testname");
    //     $this->db->bind(':testname',$testname);
    //     $results = $this->db->single();
    //     return $results;
    // }

    public function getProfileDetails($id){
        $this->db->query('SELECT * FROM users WHERE user_ID=:id');
        $this->db->bind(':id',$id);
        $result = $this->db->single();
        return $result;
    }

    public function getPersonalInfo($id){
        $this->db->query('SELECT * FROM doctors WHERE doctor_ID=:id');
        $this->db->bind(':id',$id);
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