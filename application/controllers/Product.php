<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('ProductModel');
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
            base_url() . 'assets/app/product/product.css?v=' . time(),
        ];

        $js = [
            base_url() . 'assets/app/product/product.js?v=' . time(),
        ];

        $this->load->view('template/header', ['css' => $css]);
        $this->load->view('product/index');
        $this->load->view('template/footer', ['js' => $js]);
    }

	public function getProduct()
    {
        $condition = '';
        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            if ($this->input->get('type') == '1') {
                $condition .= ' AND ProID like "%'.$search.'%"';
            }
            if ($this->input->get('type') == '2') {
                $condition .= ' AND BrandName like "%'.$search.'%"';
            }

            if ($this->input->get('type') == '3') {
                $condition .= ' AND CommonName like "%'.$search.'%"';
            }

            if ($this->input->get('type') == '4') {
                $condition .= ' AND Barcode like "%'.$search.'%"';
            }
            
        }

        $queue = $this->ProductModel->getDataPerpage($this->session->userdata('id'), $condition);
        header('Content-Type: application/json');

        if ($queue) {
            echo json_encode(['result'=> true,'data' => $queue]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getLabCompanyById(){
        $id = $_GET["id"];
        
        if(!empty($id)){
            $labCompany = $this->ProductModel->getDataById($id);
            header('Content-Type: application/json');

            if ($labCompany) {
                echo json_encode(['result'=> true, 'data' => $labCompany]);
            } else {
                echo json_encode(['result'=> false]);
            }
        }
    }

    public function getMaxId(){
        $maxId = $this->ProductModel->getMaxId($this->session->userdata('id'));
        $max = intval(substr($maxId->max_id , 2));

        header('Content-Type: application/json');

        echo json_encode(['result'=> true, 'maxId' => $max]);
    }

    public function insert(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $code = $_POST["code"];
        $name = $_POST["name"];
      
        $data = [
            'LabCID' => time(),
            'LCID' => $code,
            'LabCName' => $name,
            'CLINICID' => $this->session->userdata('id')
        ];

        $result = $this->ProductModel->insert($data);

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
            'LCID' => $code,
            'LabCName' => $name,
        ];
      
        $result = $this->ProductModel->update($data, $id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function delete(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        
        $result = $this->ProductModel->delete($id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }
}
