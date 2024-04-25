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
        // public function getPatientsPaginated($itemsPerPage, $offset){
        //     $this->db->query('SELECT * FROM patients LIMIT :offset, :itemsPerPage');
        //     $this->db->bind(':offset',$offset,PDO::PARAM_INT);
        //     $this->db->bind(':itemsPerPage',$itemsPerPage,PDO::PARAM_INT);

        //     return $this->db->resultSet();
        // }

        public function getPatientsPaginated($itemsPerPage, $offset){
            $this->db->query('SELECT * FROM patients LIMIT :offset, :itemsPerPage');
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

        public function getMedicationsPaginated($itemsPerPage, $offset){
            $this->db->query('SELECT * FROM medication LIMIT :offset, :itemsPerPage');
            $this->db->bind(':offset', $offset, PDO::PARAM_INT);
            $this->db->bind(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
        
            return $this->db->resultSet();
        }

        public function getSearchedMedicationsPaginated($itemsPerPage, $offset,$medicineName){
            $this->db->query('SELECT * FROM medication WHERE medication.name = :medicineName LIMIT :offset, :itemsPerPage');
            $this->db->bind(':medicineName', $medicineName);
            $this->db->bind(':offset', $offset, PDO::PARAM_INT);
            $this->db->bind(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
        
            return $this->db->resultSet();
        }
        
        
        public function getTotalMedicationsCount(){
            $this->db->query('SELECT COUNT(*) AS total FROM medication');
            $result = $this->db->single();
            
            return $result->total;
        }
        

        public function insertMedication($data){
            $this->db->query('INSERT INTO medication (id, name, expiry_date, quantity, dosage, batch_number,status,`Generic Name`)
            VALUES
            (:id, :name, :expiry_date, :quantity, :dosage, :batch_number, :status, :GenericName)');

            $this->db->bind(':id', 310);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':expiry_date', $data['expiry_date']);
            $this->db->bind(':quantity', $data['quantity']);
            $this->db->bind(':dosage', $data['dosage']);
            $this->db->bind(':batch_number',$data['batch']);
            $this->db->bind(':status', $data['status']);
            $this->db->bind(':GenericName', 'Salbetamol');

            return $this->db->execute();
        }

        public function markMedicationOutOfStock($medicationId){
            $this->db->query('UPDATE medication SET status = :status WHERE id =:id');

            $this->db->bind(':status', 'Out of Stock');
            $this->db->bind(':id', $medicationId);

            return $this->db->execute();
        }

        public function searchPatient($patientName){
            $this->db->query('SELECT * FROM Patients WHERE name LIKE :patientName');
            $this->db->bind(':patientName', '%' . $patientName . '%'); // Use '%' for partial matches
        
            return $this->db->resultSet();
        }

        public function searchMedicine($medicineName){
            $this->db->query('SELECT * FROM medication WHERE name LIKE :medicineName');
            $this->db->bind(':medicineName', '%' . $medicineName . '%'); // Use '%' for partial matches
            return $this->db->resultSet();
        }

        public function updateMedicationQuantity($medicationId, $quantity){
            $this->db->query('UPDATE medication SET quantity = :quantity WHERE id = :id');
            $this->db->bind(':id', $medicationId);
            $this->db->bind(':quantity', $quantity);
            
            return $this->db->execute();
        }
    

        // public function getPharmacistProfileDetails($employeeId) {
        //     $this->db->query('SELECT * FROM pharmacist_profiles WHERE employee_id = :employeeId');
        //     $this->db->bind(':employeeId', $employeeId);
    
        //     return $this->db->single();
        // }

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

    }
?>

