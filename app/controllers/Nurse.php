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
        // $this->view('doctor/patients');
    }

    public function patients_dashboard()
    {
        $patients = $this->nurseModel->patients();
        $data = [
            'patients' => $patients
        ];
        $this->view('nurse/patients_dashboard', $data);
    }

    public function patient_profile()
    {
        $patientID = $_GET['patientId'];
        $patient = $this->nurseModel->patientdetails($patientID);
        $data = [
            'patient' => $patient
        ];
        $this->view('nurse/patient_profile', $data);
    }

    public function appointments()
    {
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
    }

    public function appointment_view()
    {
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
    }
}