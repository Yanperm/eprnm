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

    // public function getTimeClinic()
    // {
    //     $sortBy = $this->input->get('sortBy');
    //     $sortType = $this->input->get('sortType');
    //     $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
    //     $perPage = $this->input->get('perPage');

    //     $condition = '';
    //     $sort = '';

    //     // if (!empty($this->input->get('search'))) {
    //     //     $search = $this->input->get('search');
    //     //     $condition .= ' AND tbclinic.SEO_TITLE like "%'.$search.'%"';
            
    //     // }

    //     // if (!empty($this->input->get('sortBy'))) {
    //     //     $sort .= 'ORDER BY "tbclinic.'.$sortBy.'" '.$sortType;
    //     // }

    //     $timeclinic = $this->TimeModel->getDataPerpage($this->session->userdata('id'), $condition, $sort, $page, $perPage);
    //     $total = $this->TimeModel->total($this->session->userdata('id'), $condition);
       
    //     header('Content-Type: application/json');

    //     if ($timeclinic) {
    //         echo json_encode([
    //             'result'=> true,
    //             'main' => $timeclinic,
    //             'total' => $total->NUM_OF_ROW
    //             ]);
    //     } else {
    //         echo json_encode(['result'=> false]);
    //     }
    // }

    public function update(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $openSunday = $_POST["openSunday"];
        //$timeclose = $_POST["timeclose"];
        // $time1 = $_POST["time1"];
        // $close1 = $_POST["close1"];
        // $time2 = $_POST["time2"];
        // $close2 = $_POST["close2"];
        // $time3 = $_POST["time3"];
        // $close3 = $_POST["close3"];
        // $time4 = $_POST["time4"];
        // $close4 = $_POST["close4"];
        // $time5 = $_POST["time5"];
        // $close5 = $_POST["close5"];
        // $time6 = $_POST["time6"];
        // $close6 = $_POST["close6"];
      
        $data = [
            'TIME_OPEN' => $openSunday,
            // 'TIME_CLOSE' => $timeclose,
            // 'TIME1' => $time1,
            // 'CLOSE1' => $close1 ,
            // 'TIME2' => $time2 ,
            // 'CLOSE2' => $close2,
            // 'TIME3' => $time3,
            // 'CLOSE3' => $close3,
            // 'TIME4' => $time4,
            // 'CLOSE4' => $close4,
            // 'TIME5' => $time5,
            // 'CLOSE5' => $close5,
            // 'TIME6' => $time6,
            // 'CLOSE6' => $close6,
        ];

        $result = $this->TimeModel->update($data, $id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }




}
