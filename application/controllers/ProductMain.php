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
        $css = [
            base_url() . 'assets/app/product_main/product_main.css?v=' . time(),
        ];

        $js = [
            base_url() . 'assets/app/product_main/product_main.js?v=' . time(),
        ];

        $this->load->view('template/header', ['css' => $css]);
        $this->load->view('product_main/index');
        $this->load->view('template/footer', ['js' => $js]);
    }

	public function getProductMain()
    {
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = intval($this->input->get('page')) - 1;
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            if ($this->input->get('type') == '1') {
                $condition .= ' AND tbproductcategory.CategoryIDs like "%'.$search.'%"';
            }
            if ($this->input->get('type') == '2') {
                $condition .= ' AND tbproductcategory.CategoryName like "%'.$search.'%"';
            }
        }

        if (!empty($this->input->get('sortBy'))) {
            $sort .= 'ORDER BY "tbproductcategory.'.$sortBy.'" '.$sortType;
        }

        $queue = $this->ProductMainModel->getDataPerpage($this->session->userdata('id'), $condition, $sort, $page, $perPage);
        header('Content-Type: application/json');

        if ($queue) {
            echo json_encode(['result'=> true, 'data' => $queue]);
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
                echo json_encode(['result'=> true, 'data' => $productMain]);
            } else {
                echo json_encode(['result'=> false]);
            }
        }
    }

    public function getMaxId(){
        $maxId = $this->ProductMainModel->getMaxId($this->session->userdata('id'));
        $max = intval(substr($maxId->max_id , 1));

        header('Content-Type: application/json');

        echo json_encode(['result'=> true, 'maxId' => $max]);
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
