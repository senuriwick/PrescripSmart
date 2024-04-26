<?php
class M_receptionist
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
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
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function findUserByEmail($email)
  {
    $this->db->query('SELECT * FROM receptionists WHERE email_address = :email_address');
    // Bind value
    $this->db->bind(':email_address', $email);

    $row = $this->db->single();

    // Check row
    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

    public function authenticate($email_address, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email_phone = :email_address AND active = 1');
        $this->db->bind(':email_address', $email_address);
        $result = $this->db->single();
        return $result;
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

      public function findUserByEmail($email)
      {
        $this->db->query('SELECT * FROM users WHERE email_address = :email_address');
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

      public function findUserByid($user_ID)
    {
        $this->db->query('SELECT * FROM users WHERE user_ID = :user_ID');
        $this->db->bind(':user_ID', $user_ID);
        $result = $this->db->single();
        return $result;
    }

      function deleteUserByid(int $id, int $active = 0)
    {
        $this->db->query('DELETE FROM users WHERE user_ID =:id and active=:active');

        $this->db->bind(':id', $id);
        $this->db->bind(':active', $active);
        $this->db->execute();
    }

    public function activate($email)
    {
        $this->db->query('UPDATE users SET active = 1, activated_at = CURRENT_TIMESTAMP WHERE email_phone = :email');
        $this->db->bind(':email', $email);
        $this->db->execute();
    }

      

      public function login($email, $password)
      {
          $this->db->query('SELECT * FROM users WHERE email_address = :email_address');
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

      public function receptionistRegistration($user_ID, $first_name, $last_name, $email_address)
    {
        $this->db->query('INSERT INTO receptionists (receptionist_ID, first_Name, last_Name, display_Name, email_address, signIn_Method, NIC) 
        VALUES (:id, :fName, :lName, :dName, :email, "email", :id)');
        $this->db->bind(':id', $user_ID);
        $this->db->bind(':fName', $first_name);
        $this->db->bind(':lName', $last_name);
        $this->db->bind(':dName', $first_name . ' ' . $last_name);
        $this->db->bind(':email', $email_address);

        $this->db->execute();
    }

    public function receptionistRegistration_02Phone($NIC, $DOB, $age, $address, $email, $id)
    {
        $this->db->query('UPDATE receptionists SET NIC = :nic, DOB = :dob, age = :age, home_Address = :address, email_address = :email WHERE receptionist_ID = :id');
        $this->db->bind(':nic', $NIC);
        $this->db->bind(':dob', $DOB);
        $this->db->bind(':age', $age);
        $this->db->bind(':address', $address);
        $this->db->bind(':email', $email);
        $this->db->bind(':id', $id);

        $this->db->execute();
    }

    public function receptionistInfo()
    {
        $this->db->query('SELECT * FROM users WHERE user_ID = :userID');
        $this->db->bind(':userID', $_SESSION['USER_DATA']->user_ID);
        $result = $this->db->single();
        return $result;
    }

      public function getPatients()
      {
          $this->db->query('SELECT * FROM patients');
          $result = $this->db->resultSet();
          return $result;
      }
    } else {
      return false;// Handle the case where the email address is not found 

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

  public function getdocSessions()
  {
    $sql = "SELECT sessions.*, doctors.*
              FROM sessions
              INNER JOIN doctors ON sessions.doctor_ID = doctors.doctor_ID";
                
      $this->db->query($sql);
      $rows = $this->db->resultSet(); 
      return $rows;
    }

    public function getSessionDetails($session_ID)
    {
        $this->db->query('SELECT * FROM sessions WHERE session_ID = :session_id');
        $this->db->bind(':session_id', $session_ID);
        $result = $this->db->single();
        return $result;
    }

    public function getDoctorDetails($doctor_ID)
    {
        $this->db->query('SELECT * FROM doctors WHERE doctor_ID = :doctor_id');
        $this->db->bind(':doctor_id', $doctor_ID);
        $result = $this->db->single();
        return $result;
    }
  }

  public function deleteProfileDoc($id)
  {
    $this->db->query('DELETE FROM doctors WHERE doctor_id = :id');
    $this->db->bind(':id', $id);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }


    public function getPatientDetails($patient_ID)
    {
        $this->db->query('SELECT * FROM patients WHERE patient_ID = :patient_ID');
        $this->db->bind(':patient_ID', $patient_ID);
        $result = $this->db->single();
        return $result;
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
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
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
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getAppointments()
  {
    $this->db->query('SELECT * FROM appointments');
    $results = $this->db->resultSet();
    return $results;

  }

    public function getuserbyID($id, $table)
    {
        $sql = "SELECT e.*, d.*
                FROM users e
                JOIN $table d ON e.user_ID = d.user_iD
                WHERE e.user_ID = :id";

    $this->db->query($sql);
    $this->db->bind(':id', $id);
    $row = $this->db->single();

    return $row;
  }

  public function confirm_appointment($data)
  {
    $this->db->query('INSERT INTO appointments (patient_id, doctor_id, date, time, amount) VALUES(:patient_id, :doctor_id, :app_date, :app_time, :amount)');
    $this->db->bind(':patient_id', $data['patient_id']);
    $this->db->bind(':doctor_id', $data['doctor_id']);
    $this->db->bind(':app_date', $data['app_date']);
    $this->db->bind(':app_time', $data['app_time']);
    $this->db->bind(':amount', $data['amount']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }


    public function confirm_appointment($data)
    {
      $this->db->query('INSERT INTO appointments (patient_ID,session_ID,doctor_ID, date, time, amount) VALUES(:patient_id,:session_id,:doctor_id, :app_date, :app_time, :amount)');
      $this->db->bind(':patient_id', $data['patient_id']);
      $this->db->bind(':session_id', $data['session_id']);
      $this->db->bind(':doctor_id', $data['doctor_id']);
      $this->db->bind(':app_date', $data['app_date']);
      $this->db->bind(':app_time', $data['app_time']);
      $this->db->bind(':amount', $data['amount']);

        if($this->db->execute())
        {
          return true;
        }
         else
        {
          return false;
        }

    }

    public function updateAccInfo($username, $userID)
    {
        $this->db->query('UPDATE users SET username = :username 
        WHERE user_ID = :userID');
        $this->db->bind(':username', $username);
        $this->db->bind(':userID', $userID);

        $this->db->execute();

    }
  }
}