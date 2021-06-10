<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckList extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('DepartmentModel');
        $this->load->model('LabCompanyModel');
        $this->load->model('CheckListModel');
    }
    private function logged_in()
    {
        if (!$this->session->userdata('authenticated')) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        $css = [
            base_url() . 'assets/app/check_list/check_list.css?v=' . time(),
        ];

        $js = [
            base_url() . 'assets/app/check_list/check_list.js?v=' . time(),
        ];

        $this->load->view('template/header', ['css' => $css]);
        $this->load->view('check_list/index');
        $this->load->view('template/footer', ['js' => $js]);
    }

	public function getCheckList()
    {
        $condition = '';
        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            if ($this->input->get('type') == '1') {
                $condition .= ' AND checklist.SPID like "%'.$search.'%"';
            }
            if ($this->input->get('type') == '2') {
                $condition .= ' AND checklist.STESTNAME like "%'.$search.'%"';
            }

            if ($this->input->get('type') == '3') {
                $condition .= ' AND company.LabCName like "%'.$search.'%"';
            }

            if ($this->input->get('type') == '4') {
                $condition .= ' AND department.DepName like "%'.$search.'%"';
            }
        }

        $queue = $this->CheckListModel->getDataPerpage($this->session->userdata('id'), $condition);
        header('Content-Type: application/json');

        if ($queue) {
            echo json_encode(['result'=> true,'data' => $queue]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getCheckListById(){
        $id = $_GET["id"];
        
        if(!empty($id)){
            $department = $this->CheckListModel->getDataById($id);
            header('Content-Type: application/json');

            if ($department) {
                echo json_encode(['result'=> true, 'data' => $department]);
            } else {
                echo json_encode(['result'=> false]);
            }
        }
    }

    public function getLabCompany(){
      
        $lab = $this->LabCompanyModel->getDataByClinic($this->session->userdata('id'));
        header('Content-Type: application/json');

        if ($lab) {
            echo json_encode(['result'=> true, 'data' => $lab]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getDepartmentByLab()
    {
        $labId = $_GET["lab_id"];
        $department = $this->DepartmentModel->getDataByClinicAndLab($this->session->userdata('id'), $labId);
        header('Content-Type: application/json');

        if ($department) {
            echo json_encode(['result'=> true, 'data' => $department]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getMaxId(){
        $maxId = $this->CheckListModel->getMaxId($this->session->userdata('id'));
        $max = intval(substr($maxId->max_id , 1));

        header('Content-Type: application/json');

        echo json_encode(['result'=> true, 'maxId' => $max]);
    }

    public function insert(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $code = $_POST["code"];
        $name = $_POST["name"];
        $mainId = $_POST["mainId"];
        $subId = $_POST["subId"];
        $cost = $_POST["cost"];
        $price = $_POST["price"];
      
        $data = [
            'SID' => time(),
            'SPID' => $code,
            'STESTNAME' => $name,
            'LabCID' => $mainId,
            'DepID' => $subId,
            'Price' => $cost,
            'PriceSale' => $price,
            'CLINICID' => $this->session->userdata('id'),
        ];

        $result = $this->CheckListModel->insert($data);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function update(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $code = $_POST["code"];
        $name = $_POST["name"];
        $mainId = $_POST["mainId"];
        $subId = $_POST["subId"];
        $cost = $_POST["cost"];
        $price = $_POST["price"];
      
        $data = [
            'SPID' => $code,
            'STESTNAME' => $name,
            'LabCID' => $mainId,
            'DepID' => $subId,
            'Price' => $cost,
            'PriceSale' => $price,
        ];

        $result = $this->CheckListModel->update($data, $id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function delete(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        
        $result = $this->CheckListModel->delete($id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }
}
