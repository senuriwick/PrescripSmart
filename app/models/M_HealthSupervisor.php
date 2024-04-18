<?php
    class M_HealthSupervisor{
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
            WHERE user_id = 1');
            $this->db->bind(':newpassword', password_hash($newpassword, PASSWORD_BCRYPT));
            $this->db->execute();
        }

        public function getUserDetails($userId) {
            $this->db->query('SELECT * FROM users WHERE user_id = :userId');
            $this->db->bind(':userId', $userId);
        
            return $this->db->single();
        }

        public function updateInfo($fname, $lname, $dname, $address, $nic, $contact, $regNo,$qualification)
        {
            $this->db->query('UPDATE healthSupervisors SET first_name = :fname, last_name = :lname, display_name = :dname, 
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

        public function healthSupervisorInfo(){
            $this->db->query('SELECT * FROM healthSupervisors WHERE user_id = 3');
            $result = $this->db->single();
            return $result;
        }




    }
?>
