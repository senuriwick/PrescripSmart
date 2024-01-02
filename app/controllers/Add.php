<?php
class Add extends Controller{
    // public function __construct(){
    //     $this->dpModel = $this->model('M_Doctor');
    // }

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function index(){
        // $this->view('doctor/patients');

    }

    public function appointments()
    {
        var_dump($_POST);

        $this->db->query('INSERT INTO appointments (patient_ID, session_ID, doctor_ID, time, date) VALUES (:patient_id, :session_id, :doctor_id, :sessionTime, :session_date)');
        $this->db->bind(':patient_id', $_POST['patient_ID']);
        $this->db->bind(':session_id', $_POST['session_ID']);
        $this->db->bind(':doctor_id', $_POST['doctor_ID']);
        $this->db->bind(':sessionTime', $_POST['time']);
        $this->db->bind(':session_date', $_POST['date']);
        $this->db->execute();

        // header("Location: /prescripsmart/patient/appointments_dashboard");

    }
}