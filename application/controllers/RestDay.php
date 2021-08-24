<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RestDay extends CI_Controller{

    public function __construct()
    {
        parent:: __construct();
        $this->logged_in();
        $this->load->model('RestDayModel');

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
        $this->load->view('rest_day/index');
        $this->load->view('template/footer');
    }

    public function getDataRest(){
        
        $restday =$this->RestDayModel->getDataRest($this->session->userdata('id'));

        header('Content-Type: application/json');

    
        $data = [];
        for($i = 0; $i < count($restday); $i++){
            $data[$i] = $restday[$i]->CLOSEDATE;

        }
         
        if($restday){
            echo json_encode([
            'result'=>true,
            'data'=>$data
        ]);
        }else{
            echo json_encode(['result' => false]);
        }
    
}





}
?>