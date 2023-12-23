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

    }
?>