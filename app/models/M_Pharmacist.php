<?php
    class M_Pharmacist
    {
        private $db;

        public function __construct(){
            $this ->db = new Database();
        }

        public function getUserByUsername($username)
        {
            $this->db->query("SELECT * FROM users WHERE username = :username");
            $this->db->bind(':username', $username);
            return $this->db->single(PDO::FETCH_OBJ); 
           
        }

        public function getPatients(){
            $this->db->query('SELECT * FROM Patients');
            return $this->db->resultSet();
        }

        public function getMedications(){
            $this->db->query('SELECT * FROM medication');
            return $this->db->resultSet();
        }

        public function getPatientsPaginated($itemsPerPage, $offset){
            $this->db->query('SELECT p.patient_ID, p.display_Name, p.age, p.weight, p.height, p.gender, p.home_Address, u.profile_photo FROM patients p INNER JOIN users u ON p.patient_ID = u.user_ID LIMIT :offset, :itemsPerPage');
            $this->db->bind(':offset', $offset, PDO::PARAM_INT);
            $this->db->bind(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
            return $this->db->resultSet();
        }

        public function getSearchedPatientsPaginated($itemsPerPage, $offset,$patientName){
            $this->db->query('SELECT * FROM patients WHERE patients.name = :patientName LIMIT :offset, :itemsPerPage');
            $this->db->bind(':patientName', $patientName);
            $this->db->bind(':offset', $offset, PDO::PARAM_INT);
            $this->db->bind(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
        
            return $this->db->resultSet();
        }
        
        

        public function getTotalPatientsCount(){
            $this->db->query('SELECT COUNT(*) AS total FROM patients');
            $result = $this->db->single();

            return $result->total;
        }

      
        public function searchPatient($patientName){
            $this->db->query('SELECT * FROM Patients WHERE first_Name LIKE :patientName');
            $this->db->bind(':patientName', '%' . $patientName . '%'); // Use '%' for partial matches
        
            return $this->db->resultSet();
        }

        public function getUserDetails($userId) {
            $this->db->query('SELECT * FROM users WHERE user_id = :userId');
            $this->db->bind(':userId', $userId);
        
            return $this->db->single();
        }

        public function updateAccInfo($username)
    {
        $this->db->query('UPDATE users SET username = :username 
        WHERE user_ID = :pharmacistID');
        $this->db->bind(':username', $username);
        $this->db->bind(':pharmacistID', $_SESSION['USER_DATA']->user_ID);

        $this->db->execute();
    }

        public function resetPassword($newpassword)
        {
            $this->db->query('UPDATE users SET password = :newpassword 
            WHERE user_ID = :pharmacistID');
            $this->db->bind(':newpassword', password_hash($newpassword, PASSWORD_BCRYPT));
            $this->db->bind(':pharmacistID', $_SESSION['USER_DATA']->user_ID);
            $this->db->execute();
        }

        public function pharmacistInfo($user_id){
            $this->db->query('SELECT * FROM pharmacists WHERE pharmacist_ID = :user_id');
            $this->db->bind(':user_id', $user_id);
            $result = $this->db->single();
            return $result;
        }

        public function manage2FA($toggleState, $userID)
    {
        $this->db->query('UPDATE users SET two_factor_auth = :TFA WHERE user_id = :userID');
        $this->db->bind(':TFA', $toggleState);
        $this->db->bind(':userID', $userID);
        $this->db->execute();
    }

    public function updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $regno, $qual, $spec, $dep)
    {
        $this->db->query('UPDATE pharmacists SET first_Name = :fname, last_Name = :lname, display_Name = :dname, 
            home_Address = :haddress, NIC = :nic, contact_Number = :cno, registration_No = :regno, qualifications = :qual, 
            specialization = :spec, department = :dep
            WHERE pharmacist_ID = :pharmacistID');

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
        $this->db->bind(':pharmacistID', $_SESSION['USER_DATA']->user_ID);

        $this->db->execute();
    }

        public function getAllPrescriptions($patientId) {
            $this->db->query('SELECT * FROM prescriptions WHERE patient_id = :id');
            $this->db->bind(':id', $patientId);
            return $this->db->resultSet();
        }

        public function getPrescriptionCount($patientId) {
            $this->db->query('SELECT COUNT(*) AS count FROM prescriptions WHERE patient_id = :id');
            $this->db->bind(':id', $patientId);
            $result = $this->db->single();
            return $result->count;
        }

        public function getPatientDetails($prescriptionId){
            $this->db->query('SELECT * FROM prescriptions WHERE id = :id');
            $this->db->bind(':id', $prescriptionId);
            $result = $this->db->single();
            return $result;
        }
        

        public function getDiagnosisDetails($prescriptionId){
            $this->db->query('SELECT * FROM diagnosis WHERE prescription_id = :id');
            $this->db->bind(':id', $prescriptionId);
            return $this->db->resultSet();
        }

        public function getMedicationDetails($prescriptionId)
        {
            $this->db->query('SELECT * FROM patients_medications WHERE prescription_ID = :prescriptionID');
            $this->db->bind(':prescriptionID', $prescriptionId);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getLabDetails($prescriptionId){
            $this->db->query('SELECT * FROM lab_tests WHERE prescription_id = :id');
            $this->db->bind(':id', $prescriptionId);
            return $this->db->resultSet();
        }

        public function prescriptionMedicines($prescription_ID)
    {
        $this->db->query('SELECT * FROM patients_medications WHERE prescription_ID = :prescriptionID');
        $this->db->bind(':prescriptionID', $prescription_ID);
        $result = $this->db->resultSet();
        return $result;
    }

    public function prescriptions($userID)
    {
        $this->db->query('SELECT p. *, d.first_Name, d.last_Name FROM prescriptions p 
        INNER JOIN doctors d ON p.doctor_ID = d.doctor_ID 
        WHERE p.patient_ID = :userID
        ORDER BY p.prescription_Date ASC');
        $this->db->bind(':userID', $userID);

        $result = $this->db->resultSet();
        return $result;
    }

    public function allPrescriptions()
    {
        $this->db->query('SELECT p. *, d.first_Name, d.last_Name FROM prescriptions p 
        JOIN doctors d ON p.doctor_ID = d.doctor_ID 
        ORDER BY p.prescription_Date ASC');

        $result = $this->db->resultSet();
        return $result;
    }

    public function markMedicationStatus($status, $id)
    {
        $this->db->query('UPDATE patients_medications SET status = :status WHERE id = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function filterPrescriptions($searchQuery) {
        $searchQuery = '%' . $searchQuery . '%'; 

        $this->db->query('SELECT p.*, d.first_Name, d.last_Name 
                      FROM prescriptions p 
                      JOIN doctors d ON p.doctor_ID = d.doctor_ID 
                      WHERE p.prescription_ID LIKE :searchQuery 
                      ORDER BY p.prescription_Date ASC');

        $this->db->bind(':searchQuery', $searchQuery);
        $filteredPrescriptions = $this->db->resultSet();

        return $filteredPrescriptions;
    }

    public function fetchCommonlyPrescribedMedications(){
        // Execute SQL query to retrieve most commonly prescribed medications
        $query = "SELECT medication, COUNT(*) AS usage_count 
                  FROM patients_medications 
                  GROUP BY medication 
                  ORDER BY usage_count DESC 
                  LIMIT 4"; // Assuming you want to display top 5 medications
    
        $this->db->query($query);
        $results = $this->db->resultSet();
    
        return $results;
    }

    public function fetchMonthlyData($month){
        // Execute SQL query to retrieve most commonly prescribed medications for a specific month
        $query = "SELECT pm.medication, COUNT(*) AS usage_count 
                  FROM patients_medications pm
                  INNER JOIN prescriptions p ON pm.prescription_id = p.prescription_id
                  WHERE MONTH(p.prescription_date) = :month
                  GROUP BY pm.medication 
                  ORDER BY usage_count DESC 
                  LIMIT 4"; // Assuming you want to display top 5 medications
        
        $this->db->query($query);
        $this->db->bind(':month', $month);
        $results = $this->db->resultSet();
        
        return $results;
    }
    

    


    }
?>

