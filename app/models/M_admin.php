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
        $this->db->query('INSERT INTO users (first_Name, last_Name, email_phone, password) VALUES(:first_name, :last_name, :email_address, :password)');
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
        $this->db->query('SELECT * FROM users WHERE email_phone = :email_address');
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
        $this->db->query('SELECT * FROM users WHERE email_phone = :email_address');
        // Bind value
        $this->db->bind(':email_address', $email);
  
        $row = $this->db->single();
  
        // Check row
        if($this->db->rowCount() > 0){
          return $row;
        } 
        else
        {
          echo "User not found";
        }
      }


  // Find user by email
  public function filterPatients($searchQuery) {
    $searchQuery = '%' . $searchQuery . '%'; 
    $this->db->query('SELECT p .*, u.profile_photo FROM patients p INNER JOIN users u ON p.patient_ID = u.user_ID WHERE display_Name LIKE :searchQuery');
    $this->db->bind(':searchQuery', $searchQuery);
    $filteredPatients = $this->db->resultSet();

    foreach ($filteredPatients as &$patient) {
        $address = $patient->home_Address;
        $parts = explode(", ", $address);
        $patient->city = end($parts);
    }
    
    return $filteredPatients;
}

public function filterDoctors  ($searchQuery) {
  $searchQuery = '%' . $searchQuery . '%'; 
  $this->db->query('SELECT p .*, u.profile_photo FROM doctors p INNER JOIN users u ON p.doctor_ID = u.user_ID WHERE display_Name LIKE :searchQuery');
  $this->db->bind(':searchQuery', $searchQuery);
  $filteredPatients = $this->db->resultSet();

  foreach ($filteredPatients as &$patient) {
      $address = $patient->home_Address;
      $parts = explode(", ", $address);
      $patient->city = end($parts);
  }
  
  return $filteredPatients;
}

public function filterHealthsups($searchQuery) {
  $searchQuery = '%' . $searchQuery . '%'; 
  $this->db->query('SELECT p .*, u.profile_photo FROM healthsupervisors p INNER JOIN users u ON p.supervisor_ID = u.user_ID WHERE display_Name LIKE :searchQuery');
  $this->db->bind(':searchQuery', $searchQuery);

  $filteredPatients = $this->db->resultSet();

  foreach ($filteredPatients as &$patient) {
      $address = $patient->home_Address;
      $parts = explode(", ", $address);
      $patient->city = end($parts);
  }
  
  return $filteredPatients;
}

public function filterLabtechs($searchQuery) {
  $searchQuery = '%' . $searchQuery . '%'; 
  $this->db->query('SELECT p .*, u.profile_photo FROM labtechnicians p INNER JOIN users u ON p.labtech_ID = u.user_ID WHERE display_Name LIKE :searchQuery');
  $this->db->bind(':searchQuery', $searchQuery);
  $filteredPatients = $this->db->resultSet();

  foreach ($filteredPatients as &$patient) {
      $address = $patient->home_Address;
      $parts = explode(", ", $address);
      $patient->city = end($parts);
  }
  
  return $filteredPatients;
}

public function filterNurses($searchQuery) {
  $searchQuery = '%' . $searchQuery . '%'; 
  $this->db->query('SELECT p .*, u.profile_photo FROM nurses p INNER JOIN users u ON p.nurse_ID = u.user_ID WHERE display_Name LIKE :searchQuery');
  $this->db->bind(':searchQuery', $searchQuery);
  $filteredPatients = $this->db->resultSet();

  foreach ($filteredPatients as &$patient) {
      $address = $patient->home_Address;
      $parts = explode(", ", $address);
      $patient->city = end($parts);
  }
  
  return $filteredPatients;
}

public function filterPharmacists($searchQuery) {
  $searchQuery = '%' . $searchQuery . '%'; 
  $this->db->query('SELECT p .*, u.profile_photo FROM pharmacists p INNER JOIN users u ON p.pharmacist_ID = u.user_ID WHERE display_Name LIKE :searchQuery');
  $this->db->bind(':searchQuery', $searchQuery);
  $filteredPatients = $this->db->resultSet();

  foreach ($filteredPatients as &$patient) {
      $address = $patient->home_Address;
      $parts = explode(", ", $address);
      $patient->city = end($parts);
  }
  
  return $filteredPatients;
}

public function filterReceptionists($searchQuery) {
  $searchQuery = '%' . $searchQuery . '%'; 
  $this->db->query('SELECT p .*, u.profile_photo FROM receptionists p INNER JOIN users u ON p.receptionist_ID = u.user_ID WHERE display_Name LIKE :searchQuery');
  $this->db->bind(':searchQuery', $searchQuery);
  $filteredPatients = $this->db->resultSet();

  foreach ($filteredPatients as &$patient) {
      $address = $patient->home_Address;
      $parts = explode(", ", $address);
      $patient->city = end($parts);
  }
  
  return $filteredPatients;
}
  

  public function getPatient_set()
  {
    $this->db->query('SELECT patients.*,users.*
    FROM patients
    INNER JOIN users ON users.user_ID = patients.patient_ID
    WHERE users.active = 1');
    

    return $this->db->resultSet();

  }

  public function getPatients()
  {
    $this->db->query('SELECT COUNT(*) as total FROM patients');
    $row = $this->db->single();
    return $row->total;
  }

  public function getDoctor_set($page = 1, $perPage = 2)
  {
    $offset = ($page - 1) * $perPage;
    $this->db->query('SELECT * FROM doctors LIMIT :offset, :perPage');
    $this->db->bind(':offset', $offset, PDO::PARAM_INT);
    $this->db->bind(':perPage', $perPage, PDO::PARAM_INT);

    return $this->db->resultSet();

  }

  public function getalldoctors()
  {
    $this->db->query('SELECT doctors.*,users.*
    FROM doctors
    INNER JOIN users ON users.user_ID = doctors.doctor_ID
    WHERE users.active = 1');
    $results = $this->db->resultSet();
    return $results;

  }


  public function getDoctors()
  {
    $this->db->query('SELECT COUNT(*) as total FROM doctors');
    $row = $this->db->single();
    return $row->total;
  }


  public function getHealthsup_set()
  {
    $this->db->query('SELECT healthsupervisors.*,users.*
    FROM healthsupervisors
    INNER JOIN users ON users.user_ID = healthsupervisors.supervisor_ID
    WHERE users.active = 1');
    

    return $this->db->resultSet();

  }

  public function getHealthsups()
  {
    $this->db->query('SELECT COUNT(*) as total FROM healthsupervisors');
    $row = $this->db->single();
    return $row->total;
  }

  public function getLabtech_set()
  {
    $this->db->query('SELECT labtechnicians.*,users.*
    FROM labtechnicians
    INNER JOIN users ON users.user_ID = labtechnicians.labtech_ID
    WHERE users.active = 1');
   

    return $this->db->resultSet();

  }

  public function getLabtechs()
  {
    $this->db->query('SELECT COUNT(*) as total FROM labtechnicians');
    $row = $this->db->single();
    return $row->total;
  }

  public function getNurse_set()
  {
    $this->db->query('SELECT nurses.*,users.*
    FROM nurses
    INNER JOIN users ON users.user_ID = nurses.nurse_ID
    WHERE users.active = 1');
    
    return $this->db->resultSet();

  }

  public function getNurses()
  {
    $this->db->query('SELECT COUNT(*) as total FROM nurses');
    $row = $this->db->single();
    return $row->total;
  }

  public function getPharmacist_set()
  {
    
    $this->db->query('SELECT pharmacists.*,users.*
    FROM pharmacists
    INNER JOIN users ON users.user_ID = pharmacists.pharmacist_ID
    WHERE users.active = 1');
    

    return $this->db->resultSet();

  }

  public function getPharmacists()
  {
    $this->db->query('SELECT COUNT(*) as total FROM pharmacists');
    $row = $this->db->single();
    return $row->total;
  }

  public function getReceptionist_set()
  {
    
    $this->db->query('SELECT receptionists.*,users.*
    FROM receptionists
    INNER JOIN users ON users.user_ID = receptionists.receptionist_ID
    WHERE users.active = 1');
    

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
        $this->db->query('INSERT INTO users (first_Name, last_Name, email_phone, password,role) VALUES(:first_name, :last_name, :email_address, :password , "Doctor")');
            $this->db->bind(':first_name', $data['first_name']);
            $this->db->bind(':last_name', $data['last_name']);
            $this->db->bind(':email_address', $data['email']);
            $this->db->bind(':password', $data['password']);

    
          $employeeInserted = $this->db->execute();

         $user_id = $this->db->lastInsertId();
         $this->db->query('INSERT INTO doctors (doctor_ID,first_Name, last_Name, email, contact_Number, password) VALUES(:doctor_id, :first_name, :last_name, :email_address, :phone_number, :password)');
            $this->db->bind(':doctor_id', $user_id);
            $this->db->bind(':first_name', $data['first_name']);
            $this->db->bind(':last_name', $data['last_name']);
            $this->db->bind(':email_address', $data['email']);
            $this->db->bind(':phone_number', $data['phone_number']);

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
        $this->db->query('INSERT INTO users (first_Name, last_Name, email_phone, password,role) VALUES(:first_name, :last_name, :email_address, :phone_number, :password, "Health Supervisor")');
              $this->db->bind(':first_name', $data['first_name']);
              $this->db->bind(':last_name', $data['last_name']);
              $this->db->bind(':email_address', $data['email']);
              $this->db->bind(':password', $data['password']);
          
          $employeeInserted = $this->db->execute();

          $user_id = $this->db->lastInsertId();

          $this->db->query('INSERT INTO healthsupervisors (supervisor_ID,first_Name, last_Name, email, contact_Number) VALUES(:supervisor_ID,:first_name, :last_name, :email_address, :phone_number)');
          // Bind values
          $this->db->bind(':supervisor_ID', $user_id);
          $this->db->bind(':first_name', $data['first_name']);
          $this->db->bind(':last_name', $data['last_name']);
          $this->db->bind(':email_address', $data['email']);
          $this->db->bind(':phone_number', $data['phone_number']);
    
    
          $healthsupInserted = $this->db->execute();


          
          
  
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

        $this->db->query('INSERT INTO users (first_name, last_name, email_phone, password, role) VALUES(:first_name, :last_name, :email_address, :password, "Lab technician")');
              $this->db->bind(':first_name', $data['first_name']);
              $this->db->bind(':last_name', $data['last_name']);
              $this->db->bind(':email_address', $data['email']);
              $this->db->bind(':password', $data['password']);

          
          $employeeInserted = $this->db->execute();
          $user_id = $this->db->lastInsertId();

          $this->db->query('INSERT INTO labtechnicians (labtech_ID,first_Name, last_Name, email, contact_Number) VALUES(:labtech_ID,:first_name, :last_name, :email_address, :phone_number)');
          // Bind values
          $this->db->bind(':labtech_ID', $user_id);
          $this->db->bind(':first_name', $data['first_name']);
          $this->db->bind(':last_name', $data['last_name']);
          $this->db->bind(':email_address', $data['email']);
          $this->db->bind(':phone_number', $data['phone_number']);
    
    
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

        $this->db->query('INSERT INTO users (first_name, last_name, email_phone, password, role) VALUES(:first_name, :last_name, :email_address, :password, "Nurse")');             
              $this->db->bind(':first_name', $data['first_name']);
              $this->db->bind(':last_name', $data['last_name']);
              $this->db->bind(':email_address', $data['email']);
              $this->db->bind(':password', $data['password']);
          
          $employeeInserted = $this->db->execute();

          $user_id = $this->db->lastInsertId();

          $this->db->query('INSERT INTO nurses (nurse_ID,first_name, last_name, email, contact_Number) VALUES(:user_id,:first_name, :last_name, :email_address, :phone_number)');
          // Bind values
          $this->db->bind(':user_id', $user_id);
          $this->db->bind(':first_name', $data['first_name']);
          $this->db->bind(':last_name', $data['last_name']);
          $this->db->bind(':email_address', $data['email']);
          $this->db->bind(':phone_number', $data['phone_number']);
       
          $nurseInserted = $this->db->execute();

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

        $this->db->query('INSERT INTO users (first_Name, last_Name, email_phone, password, role) VALUES(:first_name, :last_name, :email_address, :password, "Patient")');             
              $this->db->bind(':first_name', $data['first_name']);
              $this->db->bind(':last_name', $data['last_name']);
              $this->db->bind(':email_address', $data['email']);
              $this->db->bind(':password', $data['password']);
          
          $employeeInserted = $this->db->execute();

          $user_id = $this->db->lastInsertId();
          $this->db->query('INSERT INTO patients (patient_ID,first_Name, last_Name, email_address, contact_Number) VALUES(:user_id, :first_name, :last_name, :email_address, :phone_number)');
          // Bind values
          $this->db->bind(':user_id', $user_id);
          $this->db->bind(':first_name', $data['first_name']);
          $this->db->bind(':last_name', $data['last_name']);
          $this->db->bind(':email_address', $data['email']);
          $this->db->bind(':phone_number', $data['phone_number']);

          $patientInserted = $this->db->execute();

    
          // Execute
          if($employeeInserted && $patientInserted )
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

        $this->db->query('INSERT INTO users (first_Name, last_Name, email_phone, password, role) VALUES(:first_name, :last_name, :email_address, :password, "Pharmacist")');
              $this->db->bind(':first_name', $data['first_name']);
              $this->db->bind(':last_name', $data['last_name']);
              $this->db->bind(':email_address', $data['email']);
              $this->db->bind(':phone_number', $data['phone_number']);
          
          $employeeInserted = $this->db->execute();

          $user_id = $this->db->lastInsertId();

          $this->db->query('INSERT INTO pharmacists (pharmacist_ID, first_Name, last_Name, email, contact_Number) VALUES(:first_name, :last_name, :email_address, :phone_number)');
          // Bind values
          $this->db->bind(':user_id', $user_id);
          $this->db->bind(':first_name', $data['first_name']);
          $this->db->bind(':last_name', $data['last_name']);
          $this->db->bind(':email_address', $data['email']);
          $this->db->bind(':phone_number', $data['phone_number']);
    
    
          $pharmacistInserted = $this->db->execute();

          
          
          
  
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

        $this->db->query('INSERT INTO users (first_Name, last_Name, email_phone, password, role) VALUES(:first_name, :last_name, :email_address, :password, "Receptionist")');
                $this->db->bind(':first_name', $data['first_name']);
                $this->db->bind(':last_name', $data['last_name']);
                $this->db->bind(':email_address', $data['email']);
                $this->db->bind(':password', $data['password']);
            
            $employeeInserted = $this->db->execute();

            $user_id = $this->db->lastInsertId();
            $this->db->query('INSERT INTO receptionists (receptionist_ID, first_name, last_name, email_address, phone_number) VALUES(:receptionist_ID, :first_name, :last_name, :email_address, :phone_number)');
            // Bind values
            $this->db->bind(':receptionist_ID', $user_id);
            $this->db->bind(':first_name', $data['first_name']);
            $this->db->bind(':last_name', $data['last_name']);
            $this->db->bind(':email_address', $data['email']);
            $this->db->bind(':phone_number', $data['phone_number']);
            
            $receptionistInserted = $this->db->execute();
  
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
        $this->db->query('UPDATE users
        SET active = 0
        WHERE user_ID = :id');
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
        $this->db->query('UPDATE users
        SET active = 0
        WHERE user_ID = :id');
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
        $this->db->query('UPDATE users
        SET active = 0
        WHERE user_ID = :id');
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
        $this->db->query('UPDATE users
        SET active = 0
        WHERE user_ID = :id');
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
        $this->db->query('UPDATE users
        SET active = 0
        WHERE user_ID = :id');
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
        $this->db->query('UPDATE users
        SET active = 0
        WHERE user_ID = :id');
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
        $this->db->query('UPDATE users
        SET active = 0
        WHERE user_ID = :id');
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
      
      
       
      public function getPatientbyID($id)
      {
        $sql = "SELECT users.*, patients.*
        FROM users 
        INNER JOIN patients ON users.user_ID = patients.patient_ID
        WHERE users.user_ID = :id";

        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
      }
      public function getNursebyID($id)
      {
        $sql = "SELECT users.*, nurses.*
        FROM users 
        JOIN nurses ON users.user_ID = nurses.nurse_ID
        WHERE users.user_ID = :id";

        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
      }
      public function getLabtechbyID($id)
      {
        $sql = "SELECT users.*, labtechnicians.*
        FROM users 
        JOIN labtechnicians ON users.user_ID = labtechnicians.labtech_ID
        WHERE users.user_ID = :id";

        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
      }
      public function getSupervisorbyID($id)
      {
        $sql = "SELECT users.*, healthsupervisors.*
        FROM users 
        INNER JOIN healthsupervisors ON users.user_ID = healthsupervisors.supervisor_ID
        WHERE users.user_ID = :id";

        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
      }
      
      
      public function getDoctorbyID($id)
      {
        $sql = "SELECT users.*, doctors.*
        FROM users 
        JOIN doctors ON users.user_ID = doctors.doctor_ID
        WHERE users.user_ID = :id";

        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
      }
      public function getReceptionistbyID($id)
      {
        $sql = "SELECT users.*, receptionists.*
        FROM users 
        JOIN receptionists ON users.user_ID = receptionists.receptionist_ID
        WHERE users.user_ID = :id";

        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
      }
      public function getPharmacistbyID($id)
      {
        $sql = "SELECT users.*, pharmacists.*
        FROM users 
        JOIN pharmacists ON users.user_ID = pharmacists.pharmacist_ID
        WHERE users.user_ID = :id";

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
        $this->db->bind(':first_Name', $data['title']);
        $this->db->bind(':last_Name', $data['body']);
        
        //Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
      } 

    
  public function adminInfo()
  {
    $this->db->query('SELECT * FROM users WHERE user_ID = :adminID');
    $this->db->bind(':adminID', $_SESSION['USER_DATA']->user_ID);
    $result = $this->db->single();
    return $result;
  }

  public function updateAccInfo($username)
  {
    $this->db->query('UPDATE users SET username = :username 
        WHERE user_ID = :adminID');
    $this->db->bind(':username', $username);
    $this->db->bind(':adminID', $_SESSION['USER_DATA']->user_ID);

    $this->db->execute();
  }

  public function resetPassword($newpassword)
  {
    $this->db->query('UPDATE users SET password = :newpassword 
        WHERE user_ID = :adminID');
    $this->db->bind(':newpassword', password_hash($newpassword, PASSWORD_BCRYPT));
    $this->db->bind(':adminID', $_SESSION['USER_DATA']->user_ID);
    $this->db->execute();
  }

  public function adminDetails()
  {
    $this->db->query('SELECT * FROM admins WHERE admin_ID = :adminID');
    $this->db->bind(':adminID', $_SESSION['USER_DATA']->user_ID);
    $result = $this->db->single();
    return $result;
  }

  public function updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $dep)
  {
    $this->db->query('UPDATE admins SET first_Name = :fname, last_Name = :lname, display_Name = :dname, 
            home_Address = :haddress, NIC = :nic, contact_Number = :cno, department = :dep
            WHERE admin_ID = :adminID');

    $this->db->bind(':fname', $fname);
    $this->db->bind(':lname', $lname);
    $this->db->bind(':dname', $dname);
    $this->db->bind(':haddress', $haddress);
    $this->db->bind(':nic', $nic);
    $this->db->bind(':cno', $cno);
    $this->db->bind(':dep', $dep);
    $this->db->bind(':adminID', $_SESSION['USER_DATA']->user_ID);

    $this->db->execute();
  }

  public function find_user_by_id($user_ID)
  {
    $this->db->query('SELECT * FROM users WHERE user_ID = :user_ID');
    $this->db->bind(':user_ID', $user_ID);
    $result = $this->db->single();
    return $result;
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

}