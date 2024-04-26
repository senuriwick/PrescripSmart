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
            $this->db->bind(':status', 'awaiting reply');
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
            $this->db->bind(':status','awaiting reply');
            $this->db->bind(':offset', $offset, PDO::PARAM_INT);
            $this->db->bind(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
        
            return $this->db->resultSet();
        }

        
        public function getNewInquiriesCount(){
            $this->db->query('SELECT COUNT(*) as Count FROM inquiries WHERE status = :status');
            $this->db->bind(':status','awaiting reply');
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

        public function storeReply($inquiry_id, $message_content){
            $this->db->query('Update inquiries SET reply = :reply WHERE inquiry_ID = :inquiry_ID');
            $this->db->bind(':reply', $message_content);
            $this->db->bind(':inquiry_ID', $inquiry_id);
            $this->db->execute();
        }

        public function updateAccInfo($username)
        {
            $this->db->query('UPDATE users SET username = :username 
            WHERE user_ID = :healthSupervisorID');
            $this->db->bind(':username', $username);
            $this->db->bind(':healthSupervisorID', $_SESSION['USER_DATA']->user_ID);
    
            $this->db->execute();
        }

        public function resetPassword($newpassword)
        {
            $this->db->query('UPDATE users SET password = :newpassword 
            WHERE user_ID = :healthSupervisorID');
            $this->db->bind(':newpassword', password_hash($newpassword, PASSWORD_BCRYPT));
            $this->db->bind(':healthSupervisorID', $_SESSION['USER_DATA']->user_ID);
            $this->db->execute();
        }

        public function passwordReset()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newpassword = $_POST["newpassword"];
            $this->healthSupervisorModel->resetPassword($newpassword);

            redirect('/healthSupervisor/profile');
            exit();
        }
    }

        public function getUserDetails($userId) {
            $this->db->query('SELECT * FROM users WHERE user_id = :userId');
            $this->db->bind(':userId', $userId);
        
            return $this->db->single();
        }

    public function updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $regno, $qual, $spec, $dep)
    {
        $this->db->query('UPDATE healthsupervisors SET first_Name = :fname, last_Name = :lname, display_Name = :dname, 
            home_Address = :haddress, NIC = :nic, contact_Number = :cno, registration_No = :regno, qualifications = :qual, 
            specialization = :spec, department = :dep
            WHERE supervisor_ID = :supervisorID');

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
        $this->db->bind(':supervisorID', $_SESSION['USER_DATA']->user_ID);

        $this->db->execute();
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

    public function healthSupervisorInfo()
    {
        $this->db->query('SELECT * FROM users WHERE user_ID = :healthSupervisorID');
        $this->db->bind(':healthSupervisorID', $_SESSION['USER_DATA']->user_ID);
        $result = $this->db->single();
        return $result;
    }

    public function healthSupervisorDetails()
    {
        $this->db->query('SELECT * FROM healthsupervisors WHERE supervisor_ID = :supervisorID');
        $this->db->bind(':supervisorID', $_SESSION['USER_DATA']->user_ID);
        $result = $this->db->single();
        return $result;
    }




    }
?>
