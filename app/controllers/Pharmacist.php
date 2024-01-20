<?php
    class Pharmacist extends Controller{
        public function __construct(){
            $this->pharmacistModel = $this->model('M_Pharmacist');
        }

        public function index(){

        }

        public function dashboard(){
            $patients = $this->pharmacistModel->getPatients();
            $data = [
                'patients' => $patients
            ];
            $this->view('pharmacist/pharmacist_dashboard', $data);
        }

        public function medications(){
            $medications = $this->pharmacistModel->getMedications();
            $data = [
                'medications' => $medications
            ];
            $this->view('pharmacist/pharmacist_allMedications', $data);
        }

        public function profile(){
            $this->view('pharmacist/pharmacist_profile');
        }

        public function personal(){
            $this->view('pharmacist/pharmacist_personalInfo');
        }

        public function security(){
            $this->view('pharmacist/pharmacist_2factor');
        }

        public function pharmacistMedication(){
            $this->view('pharmacist/pharmacist_medication');
        }

        public function addNewMed(){
            $this->view('pharmacist/pharmacist_addNewMed');
        }

        public function oneMedDetails(){
            $this->view('pharmacist/pharmacist_oneMedDetails');
        }

        public function enterNewMed(){
            $this->view('pharmacist/pharmacist_newMed');
        }

        public function allPrescriptions(){
            $this->view('pharmacist/pharmacist_prescription');
        }

        public function insertNewMedication(){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $medicationData = [
                    'name' => $_POST['name'],
                    'expiry_date' => $_POST['expiry'],
                    'quantity' => $_POST['quantity'],
                    'dosage' => $_POST['dosage'],
                    'batch' => $_POST['batch'],
                    'status' => $_POST['status']
                ];
            $result = $this->pharmacistModel->insertMedication($medicationData);

            if($result){
                redirect("/Pharmacist/medications");
            }
            else{
                echo "Error: Medication could not be added. please try again";
            }
            }
        }

        public function markOutOfStock(){
            if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])){
                $medication_id = $_GET['id'];

                $result = $this->pharmacistModel->markMedicationOutOfStock($medication_id);

                if($result){
                    redirect("/Pharmacist/medications");
                }else{
                    echo "Error:Medication could not be marked as out of stock";
                }
            }else{
                echo "Invalid request or missing parameters";
            }
        }
    }
?>
