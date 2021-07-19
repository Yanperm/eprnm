<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QueueClode extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('QueueClodeModel');
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
            base_url() . 'assets/app/queue_clode/queue_clode.css?v=' . time(),
        ];

        $js = [
            base_url() . 'assets/app/queue_clode/queue_clode.js?v=' . time(),
        ];

        $this->load->view('template/header', ['css' => $css]);
        $this->load->view('queue_clode/index');
        $this->load->view('template/footer', ['js' => $js]);
    }

	public function getQueueClode()
    {
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        //ค้นหา
        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            $condition .= ' AND tbqueueclode.CLOSEDATE like "%'.$search.'%"';
            
        }

        if (!empty($this->input->get('sortBy'))) {
            $sort .= 'ORDER BY "tbqueueclode.'.$sortBy.'" '.$sortType;
        }

        $queueclode = $this->QueueClodeModel->getDataPerpage($this->session->userdata('id'), $condition, $sort, $page, $perPage);
        $total = $this->QueueClodeModel->total($this->session->userdata('id'), $condition);
       
        header('Content-Type: application/json');

        if ($queueclode) {
            echo json_encode([
                'result'=> true,
                'main' => $queueclode,
                'total' => $total->NUM_OF_ROW
                ]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }


    public function insert(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $CloseDate = $_POST["CloseDate"];
        
      
        $data = [
            'colseid' => time(),
            'CLOSEDATE' => $CloseDate,
            'CLINICID' => $this->session->userdata('id'),
        ];

        $result = $this->QueueClodeModel->insert($data);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }


    public function delete(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        
        $result = $this->QueueClodeModel->delete($id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }
}
