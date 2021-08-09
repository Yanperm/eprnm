<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Time extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('TimeModel');
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
           base_url() . 'assets/app/time_clinic/time_clinic.css?v=' . time(),
        ];

        $js = [
            base_url() . 'assets/app/time_clinic/time_clinic.js?v=' . time(),
        ];

        

        $this->load->view('template/header', ['css' => $css]);
        $this->load->view('time_clinic/index');
        $this->load->view('template/footer', ['js' => $js]);
    }

    public function getDay(){
        $day = $this->TimeModel->getDay($this->session->userdata('id'));
       
        header('Content-Type: application/json');

        if ($day) {
            echo json_encode([
                'result'=> true,
                'day' => $day,
                ]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getDateClinic()
    {
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        // if (!empty($this->input->get('search'))) {
        //     $search = $this->input->get('search');
        //     $condition .= ' AND tbclinic.SEO_TITLE like "%'.$search.'%"';
            
        // }

        // if (!empty($this->input->get('sortBy'))) {
        //     $sort .= 'ORDER BY "tbclinic.'.$sortBy.'" '.$sortType;
        // }

        $date = $this->TimeModel->getDataPerpage($this->session->userdata('id'), $condition, $sort, $page, $perPage);
        $total = $this->TimeModel->total($this->session->userdata('id'), $condition);
       
        header('Content-Type: application/json');

        if ($date) {
            echo json_encode([
                'result'=> true,
                'date' => $date,
                'total' => $total->NUM_OF_ROW
                ]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function update(){
        $_POST = json_decode(file_get_contents("php://input"),true);
      
        $openSunday = $_POST["openSunday"];
        $closeSunday = $_POST["closeSunday"];
        $openMon = $_POST["openMon"];
        $closeMon = $_POST["closeMon"];
        $openTue = $_POST["openTue"];
        $closeTue = $_POST["closeTue"];
        $openWed = $_POST["openWed"];
        $closeWed = $_POST["closeWed"];
        $openThu = $_POST["openThu"];
        $closeThu = $_POST["closeThu"];
        $openFri = $_POST["openFri"];
        $closeFri = $_POST["closeFri"];
        $openSat = $_POST["openSat"];
        $closeSat = $_POST["closeSat"];
      
        $data = [
            'TIME_OPEN' => $openSunday,
            'TIME_CLOSE' => $closeSunday,
            'TIME1' => $openMon,
            'CLOSE1' => $closeMon ,
            'TIME2' => $openTue ,
            'CLOSE2' => $closeTue,
            'TIME3' => $openWed,
            'CLOSE3' => $closeWed,
            'TIME4' => $openThu,
            'CLOSE4' => $closeThu,
            'TIME5' => $openFri,
            'CLOSE5' => $closeFri,
            'TIME6' => $openSat,
            'CLOSE6' => $closeSat,
        ];

        $result = $this->TimeModel->update($data, $this->session->userdata('id'));

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }


    public function insert(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $open = $_POST["open"];
        $close = $_POST["close"];
        $date = $_POST["date"];
        
      
        $data = [
            'id' => time(),
            'time_open' => $open,
            'time_close' =>$close,
            'CLINICID' => $this->session->userdata('id'),
            'date' => $date,
        ];

        $result = $this->TimeModel->insert($data);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function delete(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $ID = $_POST["ID"];
        
        $result = $this->TimeModel->delete($ID);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }


}
