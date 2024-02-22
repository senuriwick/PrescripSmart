<?php
class M_General
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function employee_authentication($email_address, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email_phone = :email_address OR username = :email_address');
        $this->db->bind(':email_address', $email_address);
        $result = $this->db->single();
        return $result;
    }
}