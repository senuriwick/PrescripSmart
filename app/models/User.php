<?php
  class Users {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    //Register function

    public function signup($data)
    {
        $this->db->query('INSERT INTO admins (first_name, last_name, email_address, password_hash) VALUES(:first_name, last_name, email_address, password)');
        //Bind the above values
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email_address', $data['email_address']);
        $this->db->bind(':password_hash', $data['password']);

        //Execute
        if($this->db->execute())
        {
            return true;

        }else{
            return false;
        }
    }

    //Logging in user model
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM admins WHERE email = email_address');
        $this->db->bind(':email' ,$email);

        $row = $this->db->single();
        $hashed_password = $row->password;
        if(password_verify($password,$hashed_password))
        {
            return $row;
        }
        else{
            return false;
        }
        
    }


    //finding user by email
    public function finduserbyEmail($email)
    {
        $this->db->query('SELECT * FROM admin WHERE email = :email ');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        //checking row
        if($this->db->rowCount() > 0)
        {
            return true;
        }
        else{
            return false;
        }


    }
    
  }