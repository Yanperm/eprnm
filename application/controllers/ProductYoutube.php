<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductYoutube extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('ProductYoutubeModel');
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
            base_url() . 'assets/app/Product_Youtube/Product_Youtube.css?v=' . time(),
        ];

        $js = [
            base_url() . 'assets/app/Product_Youtube/Product_Youtube.js?v=' . time(),
        ];

        $this->load->view('template/header', ['css' => $css]);
        $this->load->view('Product_Youtube/index');
        $this->load->view('template/footer', ['js' => $js]);
    }

	public function getProductYoutube()
    {
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            $condition .= ' AND tbvideolink.LINK like "%'.$search.'%"';
            
        }

        if (!empty($this->input->get('sortBy'))) {
            $sort .= 'ORDER BY "tbvideolink.'.$sortBy.'" '.$sortType;
        }

        $productyoutube = $this->ProductYoutubeModel->getDataPerpage($this->session->userdata('id'), $condition, $sort, $page, $perPage);
        $total = $this->ProductYoutubeModel->total($this->session->userdata('id'), $condition);
       
        header('Content-Type: application/json');

        if ($productyoutube) {
            echo json_encode([
                'result'=> true,
                'main' => $productyoutube,
                'total' => $total->NUM_OF_ROW
                ]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }


    public function insert(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $link = $_POST["link"];
        
      
        $data = [
            'VDOID' => 'VDO'.time(),
            'LINK' => $link,
            'CLINICID' => $this->session->userdata('id'),
        ];

        $result = $this->ProductYoutubeModel->insert($data);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function update(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $link = $_POST["link"];
       
        $data = [
            'LINK' => $link
        ];

        $result = $this->ProductYoutubeModel->update($data, $id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function delete(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        
        $result = $this->ProductYoutubeModel->delete($id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }
}
