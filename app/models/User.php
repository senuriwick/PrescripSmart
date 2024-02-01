<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Regsiter user
    public function register($data){
      $this->db->query('INSERT INTO admins (first_name, last_name, email_address, password) VALUES(:first_name, :last_name, :email_address, :password)');
      // Bind values
      $this->db->bind(':first_name', $data['first_name']);
      $this->db->bind(':last_name', $data['last_name']);
      $this->db->bind(':email_address', $data['email_address']);
      $this->db->bind(':password', $data['password']);


      // Execute
      if($this->db->execute()){
        return true;
      }
       else
      {
        return false;
      }
    }

    // Login User
    
    public function login($email, $password)
  {
      $this->db->query('SELECT * FROM admins WHERE email_address = :email_address');
      $this->db->bind(':email_address', $email);
  
      $row = $this->db->single();
  
      if ($row) 
      {
          $hashed_password = $row->password;
          if (password_verify($password, $hashed_password))
          {
              return $row;
          }
           else 
          {
              // echo" Wrong password";
              return false;
          }
      } 
      else
      {
          // Handle the case where the email address is not found
          
          return false;
      }
  }
  

    // Find user by email
    public function findUserByEmail($email)
    {
      $this->db->query('SELECT * FROM admins WHERE email_address = :email_address');
      // Bind value
      $this->db->bind(':email_address', $email);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } 
      else
      {
        return false;
      }
    }
  }