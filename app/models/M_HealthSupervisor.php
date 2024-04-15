<?php
    class M_HealthSupervisor{
        private $db;

        public function __construct(){
            $this ->db = new Database();
        }

        public function getNewInquiries(){
            $this->db->query('SELECT * FROM inquiries WHERE status = :status');
            $this->db->bind(':status', 'Open');
            return $this->db->resultSet();
        }

        public function getInquiryDetailsById($inquiry_id){
            $this->db->query('SELECT * FROM inquiries WHERE inquiry_ID = :id');
            $this->db->bind(':id', $inquiry_id);
            return $this->db->single();

        }

        public function getReadInquiries(){
            $this->db->query('SELECT * FROM inquiries WHERE status = :status');
            $this->db->bind(':status', 'Closed');
            return $this->db->resultSet();
        }

        public function markAsRead($inquiry_id){
            $this->db->query('UPDATE inquiries SET status = :status WHERE inquiry_ID = :inquiry_id');
            $this->db->bind(':status', 'Closed');
            $this->db->bind(':inquiry_id', $inquiry_id);
            return $this->db->execute();
        }

        public function getNewInquiriesPaginated($itemsPerPage, $offset){
            $this->db->query('SELECT * FROM inquiries WHERE status= :status LIMIT :offset, :itemsPerPage');
            $this->db->bind(':status','Open');
            $this->db->bind(':offset', $offset, PDO::PARAM_INT);
            $this->db->bind(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
        
            return $this->db->resultSet();
        }

        
        public function getNewInquiriesCount(){
            $this->db->query('SELECT COUNT(*) as Count FROM inquiries WHERE status = :status');
            $this->db->bind(':status','Open');
            $result = $this->db->Single();
            return $result->Count;
            
        }

        public function getReadInquiriesPaginated($itemsPerPage,$offset){
            $this->db->query('SELECT * FROM inquiries WHERE status = :status LIMIT :offset, :itemsPerPage');
            $this->db->bind(':status','Closed');
            $this->db->bind(':offset', $offset, PDO::PARAM_INT);
            $this->db->bind(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);

            return $this->db->resultSet();

        }

        public function getReadInquiriesCount(){
            $this->db->query('SELECT COUNT(*) as Count FROM inquiries WHERE status = :status');
            $this->db->bind(':status','Closed');
            $result = $this->db->Single();
            return $result->Count;   
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
