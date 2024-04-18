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
            $this->db->query('INSERT INTO medication (name, expiry_date, quantity, dosage, batch_number,status)
            VALUES
            (:name, :expiry_date, :quantity, :dosage, :batch_number, :status)');

            $this->db->bind(':name', $data['name']);
            $this->db->bind(':expiry_date', $data['expiry_date']);
            $this->db->bind(':quantity', $data['quantity']);
            $this->db->bind(':dosage', $data['dosage']);
            $this->db->bind(':batch_number',$data['batch']);
            $this->db->bind(':status', $data['status']);

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
            WHERE user_id = 1');
            $this->db->bind(':username', $username);
            // $this->db->bind(':password', $newpassword);

            $this->db->execute();
        }

        public function resetPassword($newpassword)
        {
            $this->db->query('UPDATE users SET password = :newpassword 
            WHERE user_id = 3');
            $this->db->bind(':newpassword', password_hash($newpassword, PASSWORD_BCRYPT));
            $this->db->execute();
        }

        public function pharmacistInfo(){
            $this->db->query('SELECT * FROM pharmacists WHERE user_id = 1');
            $result = $this->db->single();
            return $result;
        }

        public function updateInfo($fname, $lname, $dname, $address, $nic, $contact, $regNo,$qualification)
        {
            $this->db->query('UPDATE pharmacists SET first_name = :fname, last_name = :lname, display_name = :dname, 
                home_address = :address, nic = :nic, contact_number = :contact,pharmacist_registrationNo = :regNo,qualifications = :qualification WHERE pharmacist_id = 1'); 
            $this->db->bind(':fname', $fname);
            $this->db->bind(':lname', $lname);
            $this->db->bind(':dname', $dname);
            $this->db->bind(':address', $address);
            $this->db->bind(':nic', $nic);
            $this->db->bind(':contact', $contact);
            $this->db->bind(':regNo',$regNo);
            $this->db->bind(':qualification',$qualification);
    
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

        public function getMedicationDetails($prescriptionId){
            $this->db->query('SELECT * FROM medications WHERE prescription_id = :id');
            $this->db->bind(':id', $prescriptionId);
            return $this->db->resultSet();
        }

        public function getLabDetails($prescriptionId){
            $this->db->query('SELECT * FROM lab_tests WHERE prescription_id = :id');
            $this->db->bind(':id', $prescriptionId);
            return $this->db->resultSet();
        }

    }
?>

