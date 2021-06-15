<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procedure extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('ProcedureModel');
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
            base_url() . 'assets/app/procedure/procedure.css?v=' . time(),
        ];

        $js = [
            base_url() . 'assets/app/procedure/procedure.js?v=' . time(),
        ];

        $this->load->view('template/header', ['css' => $css]);
        $this->load->view('procedure/index');
        $this->load->view('template/footer', ['js' => $js]);
    }

	public function getProcedure()
    {
        $condition = '';
        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            if ($this->input->get('type') == '1') {
                $condition .= ' AND ProcedureIDs like "%'.$search.'%"';
            }
            if ($this->input->get('type') == '2') {
                $condition .= ' AND ProcedureName like "%'.$search.'%"';
            }
        }

        $queue = $this->ProcedureModel->getDataPerpage($this->session->userdata('id'), $condition);
        header('Content-Type: application/json');

        if ($queue) {
            echo json_encode(['result'=> true,'data' => $queue]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getProcedureById(){
        $id = $_GET["id"];
        
        if(!empty($id)){
            $labCompany = $this->ProcedureModel->getDataById($id);
            header('Content-Type: application/json');

            if ($labCompany) {
                echo json_encode(['result'=> true, 'data' => $labCompany]);
            } else {
                echo json_encode(['result'=> false]);
            }
        }
    }

    public function getMaxId(){
        $maxId = $this->ProcedureModel->getMaxId($this->session->userdata('id'));
        $max = intval(substr($maxId->max_id , 1));

        header('Content-Type: application/json');

        echo json_encode(['result'=> true, 'maxId' => $max]);
    }

    public function insert(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $code = $_POST["code"];
        $name = $_POST["name"];
        $price = $_POST["price"];
      
        $data = [
            'ProcedureID' => 'PRO'.time(),
            'ProcedureIDs' => $code,
            'ProcedureName' => $name,
            'ProcedurePrice' => $price,
            'CLINICID' => $this->session->userdata('id')
        ];

        $result = $this->ProcedureModel->insert($data);

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
        $price = $_POST["price"];

        $data = [
            'ProcedureIDs' => $code,
            'ProcedureName' => $name,
            'ProcedurePrice' => $price,
        ];
      
        $result = $this->ProcedureModel->update($data, $id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function delete(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        
        $result = $this->ProcedureModel->delete($id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }
}
