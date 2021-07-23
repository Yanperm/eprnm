<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordCertification extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('MemberModel');
        $this->load->model('RecordLabModel');
        
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

    public function getData()
    {
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = intval($this->input->get('page')) - 1;
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');

            $condition .= 'AND ( PH1 like "%'.$search.'%"';
            $condition .= ' OR PH2 like "%'.$search.'%"';
            $condition .= ' OR PH3 like "%'.$search.'%"';
            $condition .= ' OR PH4 like "%'.$search.'%"';
            $condition .= ' OR BOOKINGID like "%'.$search.'%")'; 
        }

        if (!empty($this->input->get('sortBy'))) {
            $sort .= 'ORDER BY '.$sortBy.' '.$sortType;
        }

        $recordHealth = $this->RecordLabModel->getDataPerPage($this->input->get('memberId'), $condition, $sort, $page, $perPage);
        $total = $this->RecordLabModel->total($this->input->get('memberId'), $condition);
       
        header('Content-Type: application/json');

        if ($recordHealth) {
            echo json_encode(['result'=> true, 'data' => $recordHealth, 'total' => $total->NUM_OF_ROW]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getLab()
    {
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            $condition .= '  (tbsenddepartment.STESTNAME like "%'.$search.'%"';
            $condition .= ' OR tbsenddepartment.PriceSale like "%'.$search.'%"';
            $condition .= ' OR tbdepartment.DepName like "%'.$search.'%"';
            $condition .= ' OR tblabscompany.LabCName like "%'.$search.'%")';
        }

        $recordLab = $this->RecordLabModel->getDataLab($this->session->userdata('id'), $condition, $sortBy, $sortType, $page, $perPage);
        $total = $this->RecordLabModel->totalLab($this->session->userdata('id'), $condition);

        header('Content-Type: application/json');

        if ($recordLab) {
            echo json_encode([
                'result'=> true,
                'data' => $recordLab,
                'total' => $total->NUM_OF_ROW
            ]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function insert(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $memberId = $_POST["member_id"];
        $bookingId = $_POST["booking_id"];
        $dataLab = $_POST["data"];

        for ($i = 0;$i < sizeof($dataLab);$i++) {
            $data = [
                'LBID' => 'LB'.$i.time(),
                'MEMBERIDCARD' => $memberId,
                'PH1' => $dataLab[$i]['STESTNAME'],
                'PH2' => $dataLab[$i]['DepName'],
                'PH3' => $dataLab[$i]['LabCName'],
                'PH4' => $dataLab[$i]['Price'],
                'BOOKINGID' => $bookingId,
                'CREATE' => date('Y-m-d H:i:s'),
            ];

            $result = $this->RecordLabModel->insert($data);
        }

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function update(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        
        $data = [
            'PH1' => $_POST["ph1"],
            'PH2' => $_POST["ph2"],
            'PH3' => $_POST["ph3"],
            'PH4' => $_POST["ph4"],
        ];

        $result = $this->RecordLabModel->update($data, $_POST["id"]);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function delete(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        
        $result = $this->RecordLabModel->delete($id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }
}