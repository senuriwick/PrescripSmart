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

    public function updateCode($code, $user)
    {
        $this->db->query('UPDATE users SET otp_code = :code WHERE email_phone = :user OR user_ID = :user');
        $this->db->bind(':code', password_hash($code, PASSWORD_BCRYPT));
        $this->db->bind(':user', $user);
        $this->db->execute();
    }

    public function find_user_by_email($email_address)
    {
        $this->db->query('SELECT * FROM users WHERE email_phone = :email_address');
        $this->db->bind(':email_address', $email_address);
        $result = $this->db->single();
        return $result;
    }

    public function reset_password($password, $user)
    {
        $this->db->query('UPDATE users SET password = :password WHERE email_phone = :user');
        $this->db->bind(':password', password_hash($password, PASSWORD_BCRYPT));
        $this->db->bind(':user', $user);
        $this->db->execute();
    }
}