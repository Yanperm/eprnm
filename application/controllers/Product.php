<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('ProductModel');
        $this->load->model('ProductMainModel');
        $this->load->model('ProductSubModel');
        $this->load->model('CountUnitModel');
        $this->load->model('CallingUnitsModel');
        $this->load->model('FregquencyModel');
        $this->load->model('MealModel');
        $this->load->model('SuggestionModel');
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

    public function create()
    {
        $maxId = $this->ProductModel->getMaxId($this->session->userdata('id'));

        $data = [
            'id' => $maxId->max_id + 1
        ];

        $this->load->view('template/header');
        $this->load->view('product/create', $data);
        $this->load->view('template/footer');
    }

    public function getProductMain(){
        $productMain = $this->ProductMainModel->getList($this->session->userdata('id'));
        
        header('Content-Type: application/json');

        if ($productMain) {
            echo json_encode(['result'=> true,'data' => $productMain]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getProductSub(){
        $productSub = $this->ProductSubModel->getList($_GET['mainId'], $this->session->userdata('id'));
        
        header('Content-Type: application/json');

        if ($productSub) {
            echo json_encode(['result'=> true,'data' => $productSub]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getOptions(){
        $countUnit = $this->CountUnitModel->getAllData();
        $callingUnit = $this->CallingUnitsModel->getDataAll();
        $frequency = $this->FregquencyModel->getAllData();
        $meal = $this->MealModel->getAllData();
        $suggestion = $this->SuggestionModel->getAllData();
        
        $data = [
            'countUnit' => $countUnit,
            'callingUnit' => $callingUnit,
            'frequency' => $frequency,
            'meal' => $meal,
            'suggestion' => $suggestion
        ];
        
        header('Content-Type: application/json');

        if ($data != '') {
            echo json_encode(['result'=> true,'data' => $data]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    

	public function getProduct()
    {
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

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

        $queue = $this->ProductModel->getDataPerpage($this->session->userdata('id'), $condition,$sort, $page, $perPage);
        $total = $this->ProductModel->total($this->session->userdata('id'), $condition);

        header('Content-Type: application/json');

        if ($queue) {
            echo json_encode(['result'=> true,'data' => $queue, 'total' => $total->NUM_OF_ROW]);
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
       
        $data = [
            'ProductID' => time(),
            'ProID' => $_POST["id"],
            'CommonName' => $_POST["nameCommon"],
            'Barcode' => $_POST['barcode'],
            'CategoryID' => $_POST['productMain'],
            'SubID' => $_POST['productSub'],
            'PregCat' => $_POST['pregCat'],
            'PriceBuy' => $_POST['cost'],
            'PriceSale' => $_POST['price'],
            'Digit' => $_POST['numOfUnit'],
            'Unit' =>$_POST['unit'],
            'BrandName' => $_POST['brandName'],
            'Indication' => $_POST['indication'],
            'CountUnit' => $_POST['countUnit'],
            'CallingUnit' => $_POST['callingUnit'],
            'Frequency' => $_POST['frequency'],
            'Meal' => $_POST['meal'],
            'Suggestion' => $_POST['suggestion'],
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
        $id = $_POST["productId"];
       
        $data = [
            'CommonName' => $_POST["nameCommon"],
            'Barcode' => $_POST['barcode'],
            'CategoryID' => $_POST['productMain'],
            'SubID' => $_POST['productSub'],
            'PregCat' => $_POST['pregCat'],
            'PriceBuy' => $_POST['cost'],
            'PriceSale' => $_POST['price'],
            'Digit' => $_POST['numOfUnit'],
            'Unit' =>$_POST['unit'],
            'BrandName' => $_POST['brandName'],
            'Indication' => $_POST['indication'],
            'CountUnit' => $_POST['countUnit'],
            'CallingUnit' => $_POST['callingUnit'],
            'Frequency' => $_POST['frequency'],
            'Meal' => $_POST['meal'],
            'Suggestion' => $_POST['suggestion'],
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