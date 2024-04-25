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



  public function login($email, $password)
  {
    $this->db->query('SELECT * FROM receptionists WHERE email_address = :email_address');
    $this->db->bind(':email_address', $email);

    $row = $this->db->single();

    if ($row) {
      $hashed_password = $row->password;
      if (password_verify($password, $hashed_password)) {
        return $row;
      } else {
        return false;
        // echo" Wrong password";

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
              INNER JOIN doctors ON sessions.doctor_id = doctors.doctor_id";

    $this->db->query($sql);
    $rows = $this->db->resultSet();
    return $rows;
  }

  public function getSessionDetails($session_ID)
  {
    $this->db->query('SELECT * FROM sessions WHERE session_id = :session_id');
    $this->db->bind(':session_id', $session_ID);
    $result = $this->db->single();
    return $result;
  }

  public function getDoctorDetails($doctor_ID)
  {
    $this->db->query('SELECT * FROM doctors WHERE doctor_id = :doctor_id');
    $this->db->bind(':doctor_id', $doctor_ID);
    $result = $this->db->single();
    return $result;
  }

  public function getNurses()
  {
    $this->db->query('SELECT * FROM nurses');
    $result = $this->db->resultSet();
    return $result;
  }

  public function getPatientDetails($patient_ID)
  {
    $this->db->query('SELECT * FROM patients WHERE patient_id = :patient_ID');
    $this->db->bind(':patient_ID', $patient_ID);
    $result = $this->db->single();
    return $result;
  }

  public function deleteProfilePatient($id)
  {
    $this->db->query('DELETE FROM patients WHERE patient_id = :id');
    $this->db->bind(':id', $id);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteProfileNurse($id)
  {
    $this->db->query('DELETE FROM nurses WHERE nurse_id = :id');
    $this->db->bind(':id', $id);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
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
    if ($this->db->execute()) {
      return true;
    } else {
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
                FROM employees e
                JOIN $table d ON e.emp_id = d.emp_id
                WHERE e.emp_id = :id";

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
  }

  public function receptionistInfo()
  {
    $this->db->query('SELECT * FROM users WHERE user_ID = :receptionistID');
    $this->db->bind(':receptionistID', $_SESSION['USER_DATA']->user_ID);
    $result = $this->db->single();
    return $result;
  }

  public function updateAccInfo($username)
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

  public function updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $regno, $qual, $spec, $dep)
  {
    $this->db->query('UPDATE receptionists SET first_Name = :fname, last_Name = :lname, display_Name = :dname, 
            home_Address = :haddress, NIC = :nic, contact_Number = :cno, registration_No = :regno, qualifications = :qual, 
            specialization = :spec, department = :dep
            WHERE receptionist_ID = :receptionistID');

    $this->db->bind(':fname', $fname);
    $this->db->bind(':lname', $lname);
    $this->db->bind(':dname', $dname);
    $this->db->bind(':haddress', $haddress);
    $this->db->bind(':nic', $nic);
    $this->db->bind(':cno', $cno);
    $this->db->bind(':regno', $regno);
    $this->db->bind(':qual', $qual);
    $this->db->bind(':spec', $spec);
    $this->db->bind(':dep', $dep);
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