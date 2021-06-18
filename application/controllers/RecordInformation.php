<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordInformation extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('MemberModel');
        $this->load->model('PatientsModel');
        
    }
    private function logged_in()
    {
        if (!$this->session->userdata('authenticated')) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {       
        $member = $this->MemberModel->getDataById($_GET['id']);

        $data = [
            'member' => $member
        ];

        $this->load->view('template/header');
        $this->load->view('template/record', $data);
        $this->load->view('record_information/index', $data);
        $this->load->view('template/footer');
    }

    public function getData(){
        $id = $_GET["id"];
        $patient = $this->PatientsModel->getDataById($id);

        header('Content-Type: application/json');

        if (!empty($patient)) {
            echo json_encode(
                [
                    'result'=> true,
                    'patient' => $patient
                ]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function update(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        
        $data = [
            'IDCARD' => $_POST["idCard"],
            'MEMBERIDCARD' => $_POST["id"],
            'PATIEN_NAMEPREFIX' => $_POST["prefixName"],
            'PATIEN_NAME' => $_POST["name"],
            'PATIEN_EMAIL' => $_POST["email"],
            'PATIEN_PHONE' => $_POST["phone"],
            'PATIEN_LINEID' => $_POST["line"],
            'PATIEN_ADDRESS' => $_POST["address"],
            'PATIEN_DISEASE' => $_POST["disease"],
            'PATIEN_EMERGENCY_CONTACT' => $_POST["emergencyContact"],
            'PATIEN_EMERGENCY_PHONE' => $_POST["emergencyPhone"],
            'PATIEN_DRUG_ALLERGY' => $_POST["drugAllergy"],
            'PATIEN_DRUG_ALLERGY_DETAIL' => $_POST["drugAllergyDetail"],
            'PATIEN_NOTE' => $_POST["note"],
            'CLINICID' => $this->session->userdata('id')
        ];

        $patient = $this->PatientsModel->getDataById($_POST["id"]);

        if(!empty($patient) > 0){
              $result = $this->PatientsModel->update($data, $patient->PATIENT_ID);
        }else{
            $data["PATIENT_ID"] = 'PA'.time();
            $result = $this->PatientsModel->insert($data);
        }

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }
}
