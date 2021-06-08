<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductMain extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

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
        $this->load->view('template/header');
        $this->load->view('product_main/index');
        $this->load->view('template/footer');
    }

	public function getProductMain()
    {
        $condition = '';
        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            if ($this->input->get('type') == '1') {
                $condition .= ' AND CategoryIDs like "%'.$search.'%"';
            }
            if ($this->input->get('type') == '2') {
                $condition .= ' AND CategoryName like "%'.$search.'%"';
            }
        }

        $queue = $this->ProductMainModel->getDataPerpage($this->session->userdata('id'), $condition);
        header('Content-Type: application/json');

        if ($queue) {
            echo json_encode(['result'=> true,'data' => $queue]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getProductMainById(){
        $id = $_GET["id"];
        
        if(!empty($id)){
            $productMain = $this->ProductMainModel->getDataById($id);
            header('Content-Type: application/json');

            if ($productMain) {
                echo json_encode(['result'=> true,'data' => $productMain]);
            } else {
                echo json_encode(['result'=> false]);
            }
        }
    }

    public function insert(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $code = $_POST["code"];
        $name = $_POST["name"];
      
        $data = [
            'CategoryID' => 'C'.time(),
            'CategoryIDs' => $code,
            'CategoryName' => $name,
            'CLINICID' => $this->session->userdata('id'),
            'Create' => date("Y-m-d H:i:s")
        ];

        $result = $this->ProductMainModel->insert($data);

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
      
        $data = [
            'CategoryIDs' => $code,
            'CategoryName' => $name,
        ];

        $result = $this->ProductMainModel->update($data, $id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function delete(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        
        $result = $this->ProductMainModel->delete($id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }
}
