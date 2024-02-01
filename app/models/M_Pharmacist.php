<?php
    class M_Pharmacist{
        private $db;

        public function __construct(){
            $this ->db = new Database();
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

        public function getPharmacistProfileDetails($employeeId) {
            $this->db->query('SELECT * FROM pharmacist_profiles WHERE employee_id = :employeeId');
            $this->db->bind(':employeeId', $employeeId);
    
            return $this->db->single();
        }
        

    }
?>
