<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordCertification extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('MemberModel');
        $this->load->model('PatientSickModel');
        $this->load->model('PatientJobModel');
        
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
        $this->load->view('record_certification/index', $data);
        $this->load->view('template/footer');
    }

    public function getDataJob()
    {
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');

            $condition .= 'AND ( tbpatient_job.CREATE like "%'.$search.'%"';
            $condition .= ' OR BOOKINGID like "%'.$search.'%"';
            $condition .= ' OR Recommendation like "%'.$search.'%"';
            $condition .= ' OR Price like "%'.$search.'%")'; 
        }

        if (!empty($this->input->get('sortBy'))) {
            $sort .= 'ORDER BY '.$sortBy.' '.$sortType;
        }else{
            $sort .= 'ORDER BY tbpatient_job.CREATE DESC';
        }

        $recordJob = $this->PatientJobModel->getDataPerPage($this->input->get('memberId'), $condition, $sort, $page, $perPage);
        $total = $this->PatientJobModel->total($this->input->get('memberId'), $condition);
       
        header('Content-Type: application/json');

        if ($recordJob) {
            echo json_encode(['result'=> true, 'data' => $recordJob, 'total' => $total->NUM_OF_ROW]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getDataSick()
    {
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');

            $condition .= 'AND ( tbpatient_sick.CREATE like "%'.$search.'%"';
            $condition .= ' OR Dayoff like "%'.$search.'%"';
            $condition .= ' OR BOOKINGID like "%'.$search.'%"';
            $condition .= ' OR Recommendation like "%'.$search.'%"';
            $condition .= ' OR Price like "%'.$search.'%"';
            $condition .= ' OR Startdate like "%'.$search.'%"';
            $condition .= ' OR Enddate like "%'.$search.'%")'; 
        }

        if (!empty($this->input->get('sortBy'))) {
            $sort .= 'ORDER BY '.$sortBy.' '.$sortType;
        }else{
            $sort .= 'ORDER BY tbpatient_sick.CREATE DESC';
        }

        $recordSick = $this->PatientSickModel->getDataPerPage($this->input->get('memberId'), $condition, $sort, $page, $perPage);
        $total = $this->PatientSickModel->total($this->input->get('memberId'), $condition);
       
        header('Content-Type: application/json');

        if ($recordSick) {
            echo json_encode(['result'=> true, 'data' => $recordSick, 'total' => $total->NUM_OF_ROW]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function insertSick(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $data = [
            'SickID' => 'SK'.time(),
            'Dayoff' => $_POST['numOfSick'],
            'Startdate' => $_POST['startDate'],
            'Enddate' => $_POST["endDate"],
            'Recommendation' => $_POST["recommend"],
            'Price' => $_POST["price"],
            'MEMBERIDCARD' => $_POST["memberId"],
            'BOOKINGID' => $_POST["bookingId"],
            'CREATE' => date('Y-m-d'),
            'Status' =>1
        ];

        $result = $this->PatientSickModel->insert($data);
        
        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function updateSick(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        
        $data = [
            'Dayoff' => $_POST['numOfSick'],
            'Startdate' => $_POST['startDate'],
            'Enddate' => $_POST["endDate"],
            'Recommendation' => $_POST["recommend"],
            'Price' => $_POST["price"],
        ];

        $result = $this->PatientSickModel->update($data, $_POST["id"]);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function deleteSick(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        
        $result = $this->PatientSickModel->delete($id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function insertJob(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        
        $diseases = "ไม่มี";
        if(isset($_POST['diseases']) && $_POST['diseases']){
            $diseases = "มี";
        }

        $accident = "ไม่มี";
        if(isset($_POST['accident']) && $_POST['accident']){
            $accident = "มี";
        }

        $hospital = "ไม่มี";
        if(isset($_POST['hospital']) && $_POST['hospital']){
            $hospital = "มี";
        }

        $others = "ไม่มี";
        if(isset($_POST['others']) && $_POST['others']){
            $others = "มี";
        }

        $health = "ไม่มี";
        if(isset($_POST['health']) && $_POST['health']){
            $health = "มี";
        }
        
        $data = [
            'JobID' => 'JB'.time(),
            'Diseases' => $diseases,
            'DiseasesDetail' => (isset($_POST['diseasesDetail']) ? $_POST['diseasesDetail'] : '') ,
            'Accident' => $accident,
            'AccidentDetail' => (isset($_POST['accidentDetail']) ? $_POST['accidentDetail'] : '') ,
            'Hospital' => $hospital,
            'HospitalDetail' => (isset($_POST['hospitalDetail']) ? $_POST['hospitalDetail']: '') ,
            'Others' => $others,
            'OthersDetail' => (isset($_POST['othersDetail']) ? $_POST['othersDetail'] :  '') ,
            'BodyHealth' => $health,
            'BodyHealthDetail' => (isset($_POST['healthDetail']) ? $_POST['healthDetail'] :  ''),
            'OtherSymptoms' => (isset($_POST['otherSymptoms']) ? $_POST['otherSymptoms'] :  ''),
            'Recommendation' => (isset($_POST['recommend']) ? $_POST['recommend'] :  ''),
            'Price' => (isset($_POST['price']) ? $_POST['price'] :  ''),
            'MEMBERIDCARD' => $_POST["memberId"],
            'BOOKINGID' => $_POST["bookingId"],
            'CREATE' => date('Y-m-d'),
            'Status' => 1
        ];

        $result = $this->PatientJobModel->insert($data);
        
        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function updateJob(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $diseases = "ไม่มี";
        if(isset($_POST['diseases']) && $_POST['diseases']){
            $diseases = "มี";
        }

        $accident = "ไม่มี";
        if(isset($_POST['accident']) && $_POST['accident']){
            $accident = "มี";
        }

        $hospital = "ไม่มี";
        if(isset($_POST['hospital']) && $_POST['hospital']){
            $hospital = "มี";
        }

        $others = "ไม่มี";
        if(isset($_POST['others']) && $_POST['others']){
            $others = "มี";
        }

        $health = "ไม่มี";
        if(isset($_POST['health']) && $_POST['health']){
            $health = "มี";
        }

        $data = [
            'Diseases' => $diseases,
            'DiseasesDetail' => (isset($_POST['diseasesDetail']) ? $_POST['diseasesDetail'] : '') ,
            'Accident' => $accident,
            'AccidentDetail' => (isset($_POST['accidentDetail']) ? $_POST['accidentDetail'] : '') ,
            'Hospital' => $hospital,
            'HospitalDetail' => (isset($_POST['hospitalDetail']) ? $_POST['hospitalDetail']: '') ,
            'Others' => $others,
            'OthersDetail' => (isset($_POST['othersDetail']) ? $_POST['othersDetail'] :  '') ,
            'BodyHealth' => $health,
            'BodyHealthDetail' => (isset($_POST['healthDetail']) ? $_POST['healthDetail'] :  ''),
            'OtherSymptoms' => (isset($_POST['otherSymptoms']) ? $_POST['otherSymptoms'] :  ''),
            'Recommendation' => (isset($_POST['recommend']) ? $_POST['recommend'] :  ''),
            'Price' => (isset($_POST['price']) ? $_POST['price'] :  ''),
        ];

        $result = $this->PatientJobModel->update($data, $_POST["id"]);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function deleteJob(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        
        $result = $this->PatientJobModel->delete($id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }


}