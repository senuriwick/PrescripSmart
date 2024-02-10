<?php 
class M_admin
{
    private $db;

    public function __construct()
    {
        $this->db= new Database;
    }

    // Register user
    public function register($data)
    {
        $this->db->query('INSERT INTO admins (first_name, last_name, email_address, password) VALUES(:first_name, :last_name, :email_address, :password)');
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

    public function getPatients()
    {
        $this->db->query('SELECT * FROM patients');
        $result = $this->db->resultSet();
        return $result;
    }

    public function getDoctors()
    {
        $this->db->query('SELECT * FROM doctors');
        $result = $this->db->resultSet();
        return $result;
    }

    public function getHealthsups()
    {
        $this->db->query('SELECT * FROM healthsupervisors');
        $result = $this->db->resultSet();
        return $result;
    }

    public function getLabtechs()
    {
        $this->db->query('SELECT * FROM labtechnicians');
        $result = $this->db->resultSet();
        return $result;
    }

    public function getNurses()
    {
        $this->db->query('SELECT * FROM nurses');
        $result = $this->db->resultSet();
        return $result;
    }

    public function getPharmacists()
    {
        $this->db->query('SELECT * FROM pharmacists');
        $result = $this->db->resultSet();
        return $result;
    }

    public function getReceptionists()
    {
        $this->db->query('SELECT * FROM receptionists');
        $result = $this->db->resultSet();
        return $result;
    }

    public function regDoctor($data)
    {
        $this->db->query('INSERT INTO doctors (first_name, last_name, email_address, phone_number, password) VALUES(:first_name, :last_name, :email_address, :phone_number, :password)');
        // Bind values
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email_address', $data['email']);
        $this->db->bind(':phone_number', $data['phone_number']);
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

      public function regHealthsup($data)
    {
        $this->db->query('INSERT INTO healthsupervisors (first_name, last_name, email_address, phone_number, password) VALUES(:first_name, :last_name, :email_address, :phone_number, :password)');
        // Bind values
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email_address', $data['email']);
        $this->db->bind(':phone_number', $data['phone_number']);
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

      public function regLabtech($data)
    {
        $this->db->query('INSERT INTO labtechnicians (first_name, last_name, email_address, phone_number, password) VALUES(:first_name, :last_name, :email_address, :phone_number, :password)');
        // Bind values
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email_address', $data['email']);
        $this->db->bind(':phone_number', $data['phone_number']);
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

      public function regNurse($data)
    {
        $this->db->query('INSERT INTO nurses (first_name, last_name, email_address, phone_number, password) VALUES(:first_name, :last_name, :email_address, :phone_number, :password)');
        // Bind values
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email_address', $data['email']);
        $this->db->bind(':phone_number', $data['phone_number']);
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

      public function regPatient($data)
    {
        $this->db->query('INSERT INTO patients (first_name, last_name, email_address, phone_number, password) VALUES(:first_name, :last_name, :email_address, :phone_number, :password)');
        // Bind values
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email_address', $data['email']);
        $this->db->bind(':phone_number', $data['phone_number']);
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

      public function regPharmacist($data)
    {
        $this->db->query('INSERT INTO pharmacists (first_name, last_name, email_address, phone_number, password) VALUES(:first_name, :last_name, :email_address, :phone_number, :password)');
        // Bind values
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email_address', $data['email']);
        $this->db->bind(':phone_number', $data['phone_number']);
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

      public function regReceptionist($data)
    {
        $this->db->query('INSERT INTO receptionists (first_name, last_name, email_address, phone_number, password) VALUES(:first_name, :last_name, :email_address, :phone_number, :password)');
        // Bind values
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email_address', $data['email']);
        $this->db->bind(':phone_number', $data['phone_number']);
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
    
}