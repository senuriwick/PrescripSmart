<?php 
class M_receptionist
{
    private $db;

    public function __construct()
    {
        $this->db= new Database;
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO receptionists (first_name, last_name, email_address, password) VALUES(:first_name, :last_name, :email_address, :password)');
        // Bind values
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email_address', $data['email_address']);
        $this->db->bind(':password', $data['password']);
  
  
        // Execute
        if($this->db->execute())
        {
          return true;
        }
         else
        {
          return false;
        }
      }

      public function login($email, $password)
      {
          $this->db->query('SELECT * FROM receptionists WHERE email_address = :email_address');
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
                  return false;
                  // echo" Wrong password";

              }
          } 
          else
          {
              return false;// Handle the case where the email address is not found 

          }
      }
}