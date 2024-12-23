<?php
class Nurse extends Controller
{
    private $nurseModel;
    public function __construct()
    {
        $this->nurseModel = $this->model('M_Nurse');
    }

    public function index()
    {

    }

    public static function logged_in()
    {
        if (!empty($_SESSION['USER_DATA'])) {
            return true;
        }
        return false;
    }

    public function patients_dashboard($page = 1)
    {
        if ($this->logged_in()) {
            $allPatients = $this->nurseModel->getAllPatients();
            $recordsPerPage = 10;
            $totalPatients = count($allPatients);
            $totalPages = ceil($totalPatients / $recordsPerPage);

            $offset = ($page - 1) * $recordsPerPage;
            $patients = array_slice($allPatients, $offset, $recordsPerPage);

            $data = [
                'patients' => $patients,
                'allPatients' => $allPatients,
                'currentPage' => $page,
                'totalPages' => $totalPages
            ];

            $this->view('nurse/patients_dashboard', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function filterPatients()
    {
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
        $filteredPatients = $this->nurseModel->filterPatients($searchQuery);
        echo json_encode($filteredPatients);
    }

    public function patient_profile()
    {
        if ($this->logged_in()) {
            $patientID = $_GET['patientId'];
            $patient = $this->nurseModel->patientdetails($patientID);
            $data = [
                'patient' => $patient
            ];
            $this->view('nurse/patient_profile', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function appointments()
    {
        if ($this->logged_in()) {
            $currentSession = $this->nurseModel->currentSession();

            if ($currentSession) {
                $currentSessionID = $currentSession->session_ID;
                $doctorID = $currentSession->doctor_ID;
                $doctorDetails = $this->nurseModel->doctors($doctorID);
                $appointments = $this->nurseModel->appointments($currentSessionID);

                $data = [
                    'appointments' => $appointments,
                    'session' => $currentSession,
                    'doctor' => $doctorDetails
                ];
                $this->view('nurse/appointments', $data);
            } else {
                $this->view('nurse/appointments');
            }
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function appointment_view()
    {
        if ($this->logged_in()) {
            $appointmentID = $_GET['reference'];
            $appointment = $this->nurseModel->filter_appointment_by_ID($appointmentID);

            $doctorID = $appointment->doctor_ID;
            $patientID = $appointment->patient_ID;
            $doctorDetails = $this->nurseModel->doctors($doctorID);
            $patientDetails = $this->nurseModel->patientdetails($patientID);

            $data = [
                'appointment' => $appointment,
                'doctor' => $doctorDetails,
                'patient' => $patientDetails
            ];
            $this->view('nurse/appointment_view', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function appointment_complete()
    {
        if (isset($_POST['appointmentID']) && isset($_POST['status'])) {
            $appointmentID = $_POST['appointmentID'];
            $status = $_POST['status'];
            $success = $this->nurseModel->markAppointmentComplete($appointmentID, $status);

            if ($success) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Failed to update appointment status'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Appointment ID or status not provided'));
        }
    }

    public function ongoing_session()
    {
        if ($this->logged_in()) {
            $currentSession = $this->nurseModel->currentSession();

            if ($currentSession) {
                $currentSessionID = $currentSession->session_ID;
                $doctorID = $currentSession->doctor_ID;
                $doctorDetails = $this->nurseModel->doctors($doctorID);
                $appointments = $this->nurseModel->appointments($currentSessionID);

                $data = [
                    'appointments' => $appointments,
                    'session' => $currentSession,
                    'doctor' => $doctorDetails
                ];
                $this->view('nurse/ongoing_session', $data);
            } else {
                $this->view('nurse/ongoing_session');
            }
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function sessions()
    {
        if ($this->logged_in()) {
            $groupedSessions = $this->nurseModel->sessions();
            $data = [
                'groupedSessions' => $groupedSessions
            ];
            $this->view('nurse/sessions', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }


    public function account_information()
    {
        if ($this->logged_in()) {
            $nurse = $this->nurseModel->nurseInfo();
            $data = [
                'nurse' => $nurse
            ];
            $this->view('nurse/account_information', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function accountInfoUpdate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $this->nurseModel->updateAccInfo($username);

            header("Location: /prescripsmart/nurse/account_information");
            exit();
        }
    }

    public function checkPassword()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $enteredPassword = $_POST["password"];
            $databasePasswordHash = $_SESSION['USER_DATA']->password;

            if (password_verify($enteredPassword, $databasePasswordHash)) {
                echo json_encode(array("match" => true));
            } else {
                echo json_encode(array("match" => false));
            }
        }
    }
    public function passwordReset()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newpassword = $_POST["newpassword"];
            $_SESSION['USER_DATA']->password = password_hash($newpassword, PASSWORD_BCRYPT);
            $this->nurseModel->resetPassword($newpassword);

            header("Location: /prescripsmart/nurse/account_information");
            exit();
        }
    }

    public function personal_information()
    {
        if ($this->logged_in()) {
            $nurse = $this->nurseModel->nurseDetails();
            $user = $this->nurseModel->nurseInfo();
            $data = [
                'nurse' => $nurse,
                'user' => $user
            ];
            $this->view('nurse/personal_information', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function personalInfoUpdate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $dname = $_POST["dname"];
            $haddress = $_POST["haddress"];
            $nic = $_POST["nic"];
            $cno = $_POST["cno"];
            $regno = $_POST["regno"];
            $qual = $_POST["qual"];
            $spec = $_POST["spec"];
            $dep = $_POST["dep"];

            $this->nurseModel->updateInfo($fname, $lname, $dname, $haddress, $nic, $cno, $regno, $qual, $spec, $dep);

            header("Location: /prescripsmart/nurse/personal_information");
            exit();
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function security()
    {
        if ($this->logged_in()) {
            $userID = $_SESSION['USER_DATA']->user_ID;
            $user = $this->nurseModel->find_user_by_id($userID);
            $data = [
                'user' => $user
            ];
            $this->view('nurse/security', $data);
        } else {
            header("Location: /prescripsmart/general/error_page");
        }
    }

    public function toggle2FA()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['toggle_state'])) {
                $toggleState = $_POST['toggle_state'];
                $userID = $_POST['userID'];

                if ($toggleState == 'on') {
                    $this->nurseModel->manage2FA($toggleState, $userID);
                } else if ($toggleState == 'off') {
                    $this->nurseModel->manage2FA($toggleState, $userID);
                }
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Toggle state not provided']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }

    }

    public function updateProfilePicture()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
            $target_dir = "C:/xampp/htdocs/PrescripSmart/public/uploads/profile_images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


            // Check file size
            // if ($_FILES["image"]["size"] > 500000) {
            //     echo "Sorry, your file is too large.";
            //     $uploadOk = 0;
            // }

            //Allow only certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }


            if ($uploadOk == 0) {
                // echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";

                    $image = basename($_FILES["image"]["name"]);

                    $userID = $_SESSION['USER_DATA']->user_ID;
                    $result = $this->nurseModel->updateProfilePicture($image, $userID);
                    $_SESSION['USER_DATA']->profile_photo = $image;

                    if ($result) {
                        echo json_encode(array("success" => true));
                    } else {
                        echo json_encode(array("success" => false, "message" => "Failed to update profile picture in database"));
                    }
                } else {
                    header("Location: /prescripsmart/general/error_page");
                }
            }
        }
    }

}