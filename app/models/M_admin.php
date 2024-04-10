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

      public function getPatient_set($page = 1,$perPage = 4)
    {
      $offset = ($page-1)*$perPage;
      $this->db->query('SELECT * FROM patients LIMIT :offset, :perPage');
      $this->db->bind(':offset', $offset, PDO::PARAM_INT);
      $this->db->bind(':perPage', $perPage, PDO::PARAM_INT);

      return $this->db->resultSet();

    }

    public function getPatients()
    {
        $this->db->query('SELECT COUNT(*) as total FROM patients');
        $row = $this->db->single();
        return $row->total;
    }

    public function getDoctor_set($page = 1,$perPage = 2)
    {
      $offset = ($page-1)*$perPage;
      $this->db->query('SELECT * FROM doctors LIMIT :offset, :perPage');
      $this->db->bind(':offset', $offset, PDO::PARAM_INT);
      $this->db->bind(':perPage', $perPage, PDO::PARAM_INT);

      return $this->db->resultSet();

    }

    public function getalldoctors()
    {
      $this->db->query('SELECT * FROM doctors');
      $results = $this->db->resultSet();
      return $results;

    }
    

    public function getDoctors()
    {
      $this->db->query('SELECT COUNT(*) as total FROM doctors');
      $row = $this->db->single();
      return $row->total;
    }
    

    public function getHealthsup_set($page = 1,$perPage = 4)
    {
      $offset = ($page-1)*$perPage;
      $this->db->query('SELECT * FROM healthsupervisors LIMIT :offset, :perPage');
      $this->db->bind(':offset', $offset, PDO::PARAM_INT);
      $this->db->bind(':perPage', $perPage, PDO::PARAM_INT);

      return $this->db->resultSet();

    }

    public function getHealthsups()
    {
        $this->db->query('SELECT COUNT(*) as total FROM healthsupervisors');
        $row = $this->db->single();
        return $row->total;
    }

    public function getLabtech_set($page = 1,$perPage = 4)
    {
      $offset = ($page-1)*$perPage;
      $this->db->query('SELECT * FROM labtechnicians LIMIT :offset, :perPage');
      $this->db->bind(':offset', $offset, PDO::PARAM_INT);
      $this->db->bind(':perPage', $perPage, PDO::PARAM_INT);

      return $this->db->resultSet();

    }

    public function getLabtechs()
    {
        $this->db->query('SELECT COUNT(*) as total FROM labtechnicians');
        $row = $this->db->single();
        return $row->total;
    }

    public function getNurse_set($page = 1,$perPage = 4)
    {
      $offset = ($page-1)*$perPage;
      $this->db->query('SELECT * FROM nurses LIMIT :offset, :perPage');
      $this->db->bind(':offset', $offset, PDO::PARAM_INT);
      $this->db->bind(':perPage', $perPage, PDO::PARAM_INT);

      return $this->db->resultSet();

    }

    public function getNurses()
    {
        $this->db->query('SELECT COUNT(*) as total FROM nurses');
        $row = $this->db->single();
        return $row->total;
    }

    public function getPharmacist_set($page = 1,$perPage = 4)
    {
      $offset = ($page-1)*$perPage;
      $this->db->query('SELECT * FROM pharmacists LIMIT :offset, :perPage');
      $this->db->bind(':offset', $offset, PDO::PARAM_INT);
      $this->db->bind(':perPage', $perPage, PDO::PARAM_INT);

      return $this->db->resultSet();

    }

    public function getPharmacists()
    {
        $this->db->query('SELECT COUNT(*) as total FROM pharmacists');
        $row = $this->db->single();
        return $row->total;
    }

    public function getReceptionist_set($page = 1,$perPage = 4)
    {
      $offset = ($page-1)*$perPage;
      $this->db->query('SELECT * FROM receptionists LIMIT :offset, :perPage');
      $this->db->bind(':offset', $offset, PDO::PARAM_INT);
      $this->db->bind(':perPage', $perPage, PDO::PARAM_INT);

      return $this->db->resultSet();

    }

    public function getReceptionists()
    {
        $this->db->query('SELECT COUNT(*) as total FROM receptionists');
        $row = $this->db->single();
        return $row->total;
    }

    public function regDoctor($data)
      {
        $this->db->query('INSERT INTO employees (first_name, last_name, email_address, phone_number) VALUES(:first_name, :last_name, :email_address, :phone_number)');
            $this->db->bind(':first_name', $data['first_name']);
            $this->db->bind(':last_name', $data['last_name']);
            $this->db->bind(':email_address', $data['email']);
            $this->db->bind(':phone_number', $data['phone_number']);
    
          $employeeInserted = $this->db->execute();

         $this->db->query('INSERT INTO doctors (first_name, last_name, email_address, phone_number, password) VALUES(:first_name, :last_name, :email_address, :phone_number, :password)');
            $this->db->bind(':first_name', $data['first_name']);
            $this->db->bind(':last_name', $data['last_name']);
            $this->db->bind(':email_address', $data['email']);
            $this->db->bind(':phone_number', $data['phone_number']);
            $this->db->bind(':password', $data['password']);

          $doctorInserted = $this->db->execute();

          
          
  
          // Execute
          if($employeeInserted && $doctorInserted )
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
    
    
          $healthsupInserted = $this->db->execute();

          $this->db->query('INSERT INTO employees (first_name, last_name, email_address, phone_number) VALUES(:first_name, :last_name, :email_address, :phone_number)');
              $this->db->bind(':first_name', $data['first_name']);
              $this->db->bind(':last_name', $data['last_name']);
              $this->db->bind(':email_address', $data['email']);
              $this->db->bind(':phone_number', $data['phone_number']);
          
          $employeeInserted = $this->db->execute();
          
  
          // Execute
          if($employeeInserted && $healthsupInserted )
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

        $this->db->query('INSERT INTO employees (first_name, last_name, email_address, phone_number) VALUES(:first_name, :last_name, :email_address, :phone_number)');
              $this->db->bind(':first_name', $data['first_name']);
              $this->db->bind(':last_name', $data['last_name']);
              $this->db->bind(':email_address', $data['email']);
              $this->db->bind(':phone_number', $data['phone_number']);
          
          $employeeInserted = $this->db->execute();
          
          $this->db->query('INSERT INTO labtechnicians (first_name, last_name, email_address, phone_number, password) VALUES(:first_name, :last_name, :email_address, :phone_number, :password)');
          // Bind values
          $this->db->bind(':first_name', $data['first_name']);
          $this->db->bind(':last_name', $data['last_name']);
          $this->db->bind(':email_address', $data['email']);
          $this->db->bind(':phone_number', $data['phone_number']);
          $this->db->bind(':password', $data['password']);
    
    
          $labtechInserted = $this->db->execute();

          // Execute
          if($employeeInserted && $labtechInserted )
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
    
    
          $nurseInserted = $this->db->execute();

          $this->db->query('INSERT INTO employees (first_name, last_name, email_address, phone_number) VALUES(:first_name, :last_name, :email_address, :phone_number)');
              $this->db->bind(':first_name', $data['first_name']);
              $this->db->bind(':last_name', $data['last_name']);
              $this->db->bind(':email_address', $data['email']);
              $this->db->bind(':phone_number', $data['phone_number']);
          
          $employeeInserted = $this->db->execute();
          
  
          // Execute
          if($employeeInserted && $nurseInserted )
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
    
    
          $pharmacistInserted = $this->db->execute();

          $this->db->query('INSERT INTO employees (first_name, last_name, email_address, phone_number) VALUES(:first_name, :last_name, :email_address, :phone_number)');
              $this->db->bind(':first_name', $data['first_name']);
              $this->db->bind(':last_name', $data['last_name']);
              $this->db->bind(':email_address', $data['email']);
              $this->db->bind(':phone_number', $data['phone_number']);
          
          $employeeInserted = $this->db->execute();
          
  
          // Execute
          if($employeeInserted && $pharmacistInserted )
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
      
      
            $receptionistInserted = $this->db->execute();

            $this->db->query('INSERT INTO employees (first_name, last_name, email_address, phone_number) VALUES(:first_name, :last_name, :email_address, :phone_number)');
                $this->db->bind(':first_name', $data['first_name']);
                $this->db->bind(':last_name', $data['last_name']);
                $this->db->bind(':email_address', $data['email']);
                $this->db->bind(':phone_number', $data['phone_number']);
            
            $employeeInserted = $this->db->execute();
            
    
            // Execute
            if($employeeInserted && $receptionistInserted )
            {
              return true;
            }
            else
            {
              return false;
            }
      }

      public function deleteProfileDoc($id)
      {
        $this->db->query('DELETE FROM doctors WHERE doctor_id = :id');
        $this->db->bind(':id',$id);

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


      public function deleteProfileHealthsup($id)
      {
        $this->db->query('DELETE FROM healthsupervisors WHERE healthsp_id = :id');
        $this->db->bind(':id',$id);

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

      public function deleteProfileLabtech($id)
      {
        $this->db->query('DELETE FROM labtechnicians WHERE labtech_id = :id');
        $this->db->bind(':id',$id);

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

      public function deleteProfileNurse($id)
      {
        $this->db->query('DELETE FROM nurses WHERE nurse_id = :id');
        $this->db->bind(':id',$id);

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

      public function deleteProfilePatient($id)
      {
        $this->db->query('DELETE FROM patients WHERE patient_id = :id');
        $this->db->bind(':id',$id);

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

      public function deleteProfilePharmacist($id)
      {
        $this->db->query('DELETE FROM pharmacists WHERE pharmacist_id = :id');
        $this->db->bind(':id',$id);

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

      public function deleteProfileReceptionist($id)
      {
        $this->db->query('DELETE FROM receptionists WHERE receptionist_id = :id');
        $this->db->bind(':id',$id);

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
      
      
        public function getuserbyID($id, $table)
      {
        $sql = "SELECT e.*, d.*
                FROM employees e
                JOIN $table d ON e.emp_id = d.emp_id
                WHERE e.emp_id = :id";

        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
      }

      public function updatePost($data)
      {
        // Prepare Query
        $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id'); 
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':first_name', $data['title']);
        $this->db->bind(':last_name', $data['body']);
        
        //Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
      }


       
      



    
}