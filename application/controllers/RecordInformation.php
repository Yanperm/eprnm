<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordInformation extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('MemberModel');
        $this->load->model('PatientsModel');
        $this->load->model('RecordHealthModel');
        
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
            'member' => $member,
            'bookingId' => $this->input->get('booking_id')
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

    public function getRecordHealth(){
    
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = intval($this->input->get('page')) - 1;
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');

            $condition .= 'AND ( Wieght like "%'.$search.'%"';
            $condition .= ' OR Height like "%'.$search.'%"';
            $condition .= ' OR BMI like "%'.$search.'%"';
            $condition .= ' OR BodyTemp like "%'.$search.'%"';
            $condition .= ' OR HR like "%'.$search.'%"';
            $condition .= ' OR BP like "%'.$search.'%"';
            $condition .= ' OR FBS like "%'.$search.'%"';
            $condition .= ' OR BOOKINGID like "%'.$search.'%")'; 
        }

        if (!empty($this->input->get('sortBy'))) {
            $sort .= 'ORDER BY '.$sortBy.' '.$sortType;
        }

        $recordHealth = $this->RecordHealthModel->getDataPerPage($this->input->get('memberId'), $this->session->userdata('id'), $condition, $sort, $page, $perPage);
        $total = $this->RecordHealthModel->total($this->input->get('memberId'), $this->session->userdata('id'), $condition);
       
        header('Content-Type: application/json');

        if ($recordHealth) {
            echo json_encode(['result'=> true, 'data' => $recordHealth, 'total' => $total->NUM_OF_ROW]);
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

    public function addHealth(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        
        $data = [
            'PHID' => 'P'.time(),
            'DATE_CREATE' => date('Y-m-d'),
            'Wieght' => $_POST["weight"],
            'Height' => $_POST["height"],
            'BMI' => $_POST["bmi"],
            'BodyTemp' => $_POST["bodyTemp"],
            'BP' => $_POST["bp"],
            'HR' => $_POST["hr"],
            'FBS' => $_POST["fbs"],
            'MEMBERIDCARD' => $_POST["memberId"],
            'BOOKINGID' => $_POST["bookingId"],
            'CLINICID' => $this->session->userdata('id')
        ];

        $recordHealth = $this->RecordHealthModel->insert($data);

        if($recordHealth){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }
}
