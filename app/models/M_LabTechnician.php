<?php

class M_LabTechnician {
    private $db;

    public function __construct(){
        $this->db = new DataBase;
    }

    public function repotsToUploadList(){
        $this->db->query('SELECT lab_reports.* , patients.* FROM `lab_reports` LEFT JOIN `patients` 
        ON lab_reports.patient_ID=patients.patient_ID WHERE lab_reports.report="" OR lab_reports.date_of_conduct="" GROUP BY patients.patient_ID');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getPatient($patientID){
        $this->db->query('SELECT * FROM patients WHERE patient_ID=:id');
        $this->db->bind(':id',$patientID);
        $results = $this->db->single();
        return $results;
    }

    public function getTests($patientID){
        $this->db->query('SELECT lab_reports.* , doctors.*, tests.* FROM `lab_reports` LEFT JOIN `doctors` 
        ON lab_reports.doctor_ID=doctors.doctor_ID LEFT JOIN `tests`ON tests.test_ID=lab_reports.test_ID WHERE lab_reports.patient_ID=:id AND date_of_conduct IS NULL');
        $this->db->bind(':id',$patientID);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getTestCount($patientID){
        $this->db->query('SELECT * FROM lab_reports WHERE patient_ID=:id AND date_of_conduct IS NULL');
        $this->db->bind(':id',$patientID);
        $results=$this->db->resultSet();
        return $this->db->rowCount();
    }

    public function markedTest($testNo){
        $this->db->query('UPDATE lab_reports SET date_of_conduct=NOW() WHERE report_ID=:num');
        $this->db->bind(':num',$testNo);
        $this->db->execute();
    }


    public function uploadReport($testid,$reportname,$filesize){
        $this->db->query('UPDATE lab_reports SET report=:reportname, size=:filesize, date_of_report=NOW() WHERE report_ID=:testid');
        $this->db->bind(':testid',$testid);
        $this->db->bind(':filesize',$filesize);
        $this->db->bind(':reportname',$reportname);
        $this->db->execute();
    }

    public function deleteReport($reportid){
        $this->db->query('UPDATE lab_reports SET report="",date_of_report=NULL WHERE report_ID=:reportid');
        $this->db->bind(':reportid',$reportid);
        $this->db->execute();
    }

    public function checkReport($testid){
        $this->db->query('SELECT * FROM lab_reports WHERE report_ID=:testid');
        $this->db->bind(':testid',$testid);
        $results = $this->db->single();
        return $results;
    }

    public function techInfo()
    {
        $this->db->query('SELECT * FROM users WHERE user_ID = :techID');
        $this->db->bind(':techID', $_SESSION['USER_DATA']->user_ID);
        $result = $this->db->single();
        return $result;
    }

    public function updateAccInfo($username)
    {
        $this->db->query('UPDATE users SET username = :username 
        WHERE user_ID = :techID');
        $this->db->bind(':username', $username);
        $this->db->bind(':techID', $_SESSION['USER_DATA']->user_ID);

        $this->db->execute();
    }

    public function resetPassword($newpassword)
    {
        $this->db->query('UPDATE users SET password = :newpassword 
        WHERE user_ID = :techID');
        $this->db->bind(':newpassword', password_hash($newpassword, PASSWORD_BCRYPT));
        $this->db->bind(':techID', $_SESSION['USER_DATA']->user_ID);
        $this->db->execute();
    }

    public function techDetails()
    {
        $this->db->query('SELECT * FROM labtechnicians WHERE labtech_ID = :techID');
        $this->db->bind(':techID', $_SESSION['USER_DATA']->user_ID);
        $result = $this->db->single();
        return $result;
    }

    public function updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $regno, $qual, $spec, $dep)
    {
        $this->db->query('UPDATE labtechnicians SET first_Name = :fname, last_Name = :lname, display_Name = :dname, 
            home_Address = :haddress, NIC = :nic, contact_Number = :cno, registration_No = :regno, qualifications = :qual, 
            specialization = :spec, department = :dep
            WHERE labtech_ID = :techID');

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
        $this->db->bind(':techID', $_SESSION['USER_DATA']->user_ID);

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
}