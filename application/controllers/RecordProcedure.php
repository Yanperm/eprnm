<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordProcedure extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('MemberModel');
        $this->load->model('RecordProcedureModel');
        $this->load->model('ProductMainModel');
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
        $this->load->view('record_procedure/index', $data);
        $this->load->view('template/footer');
    }

	public function getData()
    {
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            $condition .= ' AND (PH2 like "%'.$search.'%"';
            $condition .= ' OR PH3 like "%'.$search.'%")';   
        }

        if (!empty($this->input->get('sortBy'))) {
            $sort .= 'ORDER BY "'.$sortBy.'" '.$sortType;
        }

        $recordProcedure = $this->RecordProcedureModel->getDataPerpage($this->input->get('memberId'), $condition, $sort, $page, $perPage);
        $total = $this->RecordProcedureModel->total($this->input->get('memberId'), $condition);
       
        header('Content-Type: application/json');

        if ($recordProcedure) {
            echo json_encode([
                'result'=> true,
                'data' => $recordProcedure,
                'total' => $total->NUM_OF_ROW
                ]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getProcedure()
    {
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            $condition .= ' AND (ProcedureIDs like "%'.$search.'%"';
            $condition .= ' OR ProcedureName like "%'.$search.'%")';   
        }

        if (!empty($this->input->get('sortBy'))) {
            $sort .= 'ORDER BY "'.$sortBy.'" '.$sortType;
        }

        $recordProcedure = $this->RecordProcedureModel->getDataProcedure($this->session->userdata('id'), $condition, $sort, $page, $perPage);
        $total = $this->RecordProcedureModel->totalProcedure($this->session->userdata('id'), $condition);
       
        header('Content-Type: application/json');

        if ($recordProcedure) {
            echo json_encode([
                'result'=> true,
                'data' => $recordProcedure,
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
        $dataProcedure = $_POST["data"];

        for ($i = 0;$i < sizeof($dataProcedure);$i++){

            $data = [
                'PROID' => 'PRO'.$i.time(),
                'MEMBERIDCARD' => $memberId,
                'PH1' => $dataProcedure[$i]['ProcedureID'],
                'PH2' => $dataProcedure[$i]['ProcedureName'],
                'PH3' => $dataProcedure[$i]['ProcedurePrice'],
                'Status' => 1,
                'BOOKINGID' => $bookingId,
                'CREATE' => date("Y-m-d H:i:s")
            ];

           $result = $this->RecordProcedureModel->insert($data);
        }

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function delete(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        
        $result = $this->RecordProcedureModel->delete($id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }
}
