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
    $this->db->query('SELECT patients.*,users.*
    FROM patients
    INNER JOIN users ON users.user_ID = patients.patient_ID
    WHERE users.active = 1');
    $result = $this->db->resultSet();
    return $result;
  }

  public function getDoctors()
  {
    $this->db->query('SELECT doctors.*,users.*
    FROM doctors
    INNER JOIN users ON users.user_ID = doctors.doctor_ID
    WHERE users.active = 1');
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

    public function getNurses()
  {
    $this->db->query('SELECT nurses.*,users.*
    FROM nurses
    INNER JOIN users ON users.user_ID = nurses.nurse_ID
    WHERE users.active = 1');
    
    return $this->db->resultSet();

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
  }


    public function getPatientDetails($patient_ID)
    {
        $this->db->query('SELECT * FROM patients WHERE patient_ID = :patient_ID');
        $this->db->bind(':patient_ID', $patient_ID);
        $result = $this->db->single();
        return $result;
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
    public function confirmAppointment($patient_ID, $doctor_ID, $session_ID, $time, $date, $charge, $number)
    {
        try {
            $this->db->beginTransaction();

            $this->db->query('INSERT INTO appointments (patient_ID, session_ID, doctor_ID, time, date, status, amount, payment_status, token_No) 
                          VALUES (:patient_id, :session_id, :doctor_id, :sessionTime, :session_date, "active", :charge, "UNPAID", :current_appointment)');
            $this->db->bind(':patient_id', $patient_ID);
            $this->db->bind(':session_id', $session_ID);
            $this->db->bind(':doctor_id', $doctor_ID);
            $this->db->bind(':sessionTime', $time);
            $this->db->bind(':session_date', $date);
            $this->db->bind(':charge', $charge);
            $this->db->bind(':current_appointment', $number);
            $this->db->execute();

            // Get the last inserted ID
            $reference = $this->db->lastInsertId();

            $this->db->query('UPDATE sessions SET current_appointment = current_appointment + 1, current_appointment_time = ADDTIME(current_appointment_time, "00:10:00")
                          WHERE session_ID = :session_id');
            $this->db->bind(':session_id', $session_ID);
            $this->db->execute();

            $this->db->commit();

            return $reference;
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Error: " . $e->getMessage();
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

    public function addedSession($id,$Start_time, $End_time, $Total_app, $charge, $Room_no)
    {
      $this->db->query('INSERT INTO sessions ( doctor_ID, start_time, end_time,total_appointments,current_appointment, current_appointment_time, sessionCharge, room_no) 
                          VALUES (:doctor_id, :start_time, :end_time, :total_appointments, "0", :start_time, :sessionCharge, :room_no)');
            $this->db->bind(':doctor_id', $id);
            $this->db->bind(':start_time', $Start_time);
            $this->db->bind(':end_time', $End_time);
            $this->db->bind(':total_appointments', $Total_app);
            $this->db->bind(':sessionCharge', $charge);
            $this->db->bind(':room_no', $Room_no);

            $this->db->execute();
    }

  public function updateAccInfo2($username)
  {
    $this->db->query('UPDATE users SET username = :username 
        WHERE user_ID = :receptionistID');
    $this->db->bind(':username', $username);
    $this->db->bind(':receptionistID', $_SESSION['USER_DATA']->user_ID);

    $this->db->execute();
  }

  public function resetPassword($newpassword)
  {
    $this->db->query('UPDATE users SET password = :newpassword 
        WHERE user_ID = :receptionistID');
    $this->db->bind(':newpassword', password_hash($newpassword, PASSWORD_BCRYPT));
    $this->db->bind(':receptionistID', $_SESSION['USER_DATA']->user_ID);
    $this->db->execute();
  }

  public function receptionistDetails()
  {
    $this->db->query('SELECT * FROM receptionists WHERE receptionist_ID = :receptionistID');
    $this->db->bind(':receptionistID', $_SESSION['USER_DATA']->user_ID);
    $result = $this->db->single();
    return $result;
  }

  public function updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $dep, $qual)
  {
    $this->db->query('UPDATE receptionists SET first_Name = :fname, last_Name = :lname, display_Name = :dname, 
            home_Address = :haddress, NIC = :nic, contact_Number = :cno, department = :dep, qualifications = :qual
            WHERE receptionist_ID = :receptionistID');

    $this->db->bind(':fname', $fname);
    $this->db->bind(':lname', $lname);
    $this->db->bind(':dname', $dname);
    $this->db->bind(':haddress', $haddress);
    $this->db->bind(':nic', $nic);
    $this->db->bind(':cno', $cno);
    $this->db->bind(':dep', $dep);
    $this->db->bind(':qual', $qual);
    $this->db->bind(':receptionistID', $_SESSION['USER_DATA']->user_ID);

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
