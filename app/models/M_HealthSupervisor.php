<?php
    class M_HealthSupervisor{
        private $db;

        public function __construct(){
            $this ->db = new Database();
        }

        public function getInquiries(){
            $this->db->query('SELECT * FROM inquiries');
            return $this->db->resultSet();
        }

        public function getInquiryDetailsById($inquiry_id){
            $this->db->query('SELECT * FROM inquiries WHERE inquiry_ID = :id');
            $this->db->bind(':id', $inquiry_id);
            return $this->db->single();

        }

        

        // public function getMedications(){
        //     $this->db->query('SELECT * FROM Medication');
        //     return $this->db->resultSet();
        // }

        // public function insertMedication($data){
        //     $this->db->query('INSERT INTO Medication (name, expiry_date, quantity, dosage, batch_number,status)
        //     VALUES
        //     (:name, :expiry_date, :quantity, :dosage, :batch_number, :status)');

        //     $this->db->bind(':name', $data['name']);
        //     $this->db->bind(':expiry_date', $data['expiry_date']);
        //     $this->db->bind(':quantity', $data['quantity']);
        //     $this->db->bind(':dosage', $data['dosage']);
        //     $this->db->bind(':batch_number',$data['batch']);
        //     $this->db->bind(':status', $data['status']);

        //     return $this->db->execute();
        // }

        // public function markMedicationOutOfStock($medicationId){
        //     $this->db->query('UPDATE Medication SET status = :status WHERE id =:id');

        //     $this->db->bind(':status', 'Out of Stock');
        //     $this->db->bind(':id', $medicationId);

        //     return $this->db->execute();
        // }

    }
?>
