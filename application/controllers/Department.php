<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('DepartmentModel');
        $this->load->model('LabCompanyModel');
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
            base_url() . 'assets/app/department/department.css?v=' . time(),
        ];

        $js = [
            base_url() . 'assets/app/department/department.js?v=' . time(),
        ];

        $this->load->view('template/header', ['css' => $css]);
        $this->load->view('department/index');
        $this->load->view('template/footer', ['js' => $js]);
    }

	public function getDepartment()
    {

        // $sortBy = $this->input->get('sortBy');
        // $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            if ($this->input->get('type') == '1') {
                $condition .= ' AND DID like "%'.$search.'%"';
            }
            if ($this->input->get('type') == '2') {
                $condition .= ' AND DepName like "%'.$search.'%"';
            }

            if ($this->input->get('type') == '3') {
                $condition .= ' AND company.LabCName like "%'.$search.'%"';
            }
        }


        $queue = $this->DepartmentModel->getDataPerpage($this->session->userdata('id'), $condition,$sort, $page, $perPage);
        $total = $this->DepartmentModel->total($this->session->userdata('id'), $condition);
        
        header('Content-Type: application/json');

        if ($queue) {
            echo json_encode([
                'result'=> true,
                'data' => $queue,
                'total' => $total->NUM_OF_ROW
            ]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getDepartmentById(){
        $id = $_GET["id"];
        
        if(!empty($id)){
            $department = $this->DepartmentModel->getDataById($id);
            header('Content-Type: application/json');

            if ($department) {
                echo json_encode(['result'=> true, 'data' => $department]);
            } else {
                echo json_encode(['result'=> false]);
            }
        }
    }

    public function getLabCompany(){
      
        $department = $this->LabCompanyModel->getDataByClinic($this->session->userdata('id'));
        header('Content-Type: application/json');

        if ($department) {
            echo json_encode(['result'=> true, 'data' => $department]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getMaxId(){
        $maxId = $this->DepartmentModel->getMaxId($this->session->userdata('id'));
        $max = intval(substr($maxId->max_id , 1));

        header('Content-Type: application/json');

        echo json_encode(['result'=> true, 'maxId' => $max]);
    }

    public function insert(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $code = $_POST["code"];
        $name = $_POST["name"];
        $mainId = $_POST["mainId"];
      
        $data = [
            'DepID' => time(),
            'DID' => $code,
            'DepName' => $name,
            'LabCID' => $mainId,
            'CLINICID' => $this->session->userdata('id'),
        ];

        $result = $this->DepartmentModel->insert($data);

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
      
        $data = [
            'DID' => $code,
            'DepName' => $name,
            'LabCID' => $mainId,
        ];

        $result = $this->DepartmentModel->update($data, $id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function delete(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        
        $result = $this->DepartmentModel->delete($id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }
}
