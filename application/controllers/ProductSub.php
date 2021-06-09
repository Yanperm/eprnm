<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductSub extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('ProductMainModel');
        $this->load->model('ProductSubModel');
        
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
            base_url() . 'assets/app/product_sub/product_sub.css?v=' . time(),
        ];

        $js = [
            base_url() . 'assets/app/product_sub/product_sub.js?v=' . time(),
        ];

        $this->load->view('template/header', ['css' => $css]);
        $this->load->view('product_sub/index');
        $this->load->view('template/footer', ['js' => $js]);
    }

	public function getProductSub()
    {
        $condition = '';
        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            if ($this->input->get('type') == '1') {
                $condition .= ' AND sub.SubIDs like "%'.$search.'%"';
            }
            if ($this->input->get('type') == '2') {
                $condition .= ' AND sub.SubName like "%'.$search.'%"';
            }

            if ($this->input->get('type') == '3') {
                $condition .= ' AND main.CategoryName like "%'.$search.'%"';
            }
        }

        $queue = $this->ProductSubModel->getDataPerpage($this->session->userdata('id'), $condition);
        header('Content-Type: application/json');

        if ($queue) {
            echo json_encode(['result'=> true,'data' => $queue]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getProductSubById(){
        $id = $_GET["id"];
        
        if(!empty($id)){
            $productSub = $this->ProductSubModel->getDataById($id);
            header('Content-Type: application/json');

            if ($productSub) {
                echo json_encode(['result'=> true, 'data' => $productSub]);
            } else {
                echo json_encode(['result'=> false]);
            }
        }
    }

    public function getProductMain(){
      
        $productMain = $this->ProductMainModel->getDataByClinic($this->session->userdata('id'));
        header('Content-Type: application/json');

        if ($productMain) {
            echo json_encode(['result'=> true, 'data' => $productMain]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getMaxId(){
        $maxId = $this->ProductSubModel->getMaxId($this->session->userdata('id'));
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
            'SubID' => time(),
            'SubIDs' => $code,
            'SubName' => $name,
            'CategoryID' => $mainId,
            'CLINICID' => $this->session->userdata('id'),
        ];

        $result = $this->ProductSubModel->insert($data);

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
            'SubIDs' => $code,
            'SubName' => $name,
            'CategoryID' => $mainId
        ];

        $result = $this->ProductSubModel->update($data, $id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function delete(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        
        $result = $this->ProductSubModel->delete($id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }
}
