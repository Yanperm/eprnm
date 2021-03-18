<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Time extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
      //  $this->logged_in();
        $this->load->model('ClinicModel');
        $this->load->model('CloseModel');
        $this->load->library('S3_upload');
        $this->load->library('S3');
    }
    private function logged_in()
    {
        if (!$this->session->userdata('authenticated')) {
            redirect(base_url('login'));
        }
    }

    public function close()
    {
        $clinic = $this->ClinicModel->getDetail($this->session->userdata('id'));

        $data = [
            'clinic' => $clinic
        ];

        $this->load->view('template/header');
        $this->load->view('time/close', $data);
        $this->load->view('template/footer');
    }

	public function restDay()
	{
        $this->load->view('template/header');
        $this->load->view('time/rest_day');
        $this->load->view('template/footer');
	}

    public function data()
    {
        $clicnic = $this->ClinicModel->getDetail($this->session->userdata('id'));
        header('Content-Type: application/json');
        echo json_encode($clicnic);
    }

    public function update()
    {
        $timeOpen = $this->input->post('time_open');
        $timeClose = $this->input->post('time_close');
        $time1 = $this->input->post('time1');
        $close1 = $this->input->post('close1');
        $time2 = $this->input->post('time2');
        $close2 = $this->input->post('close2');
        $time3 = $this->input->post('time3');
        $close3 = $this->input->post('close3');
        $time4 = $this->input->post('time4');
        $close4 = $this->input->post('close4');
        $time5 = $this->input->post('time5');
        $close5 = $this->input->post('close5');
        $time6 = $this->input->post('time6');
        $close6 = $this->input->post('close6');
        $w1 = $this->input->post('w1');
        $w2 = $this->input->post('w2');
        $w3 = $this->input->post('w3');
        $w4 = $this->input->post('w4');
        $w5 = $this->input->post('w5');
        $w6 = $this->input->post('w6');
        $w7 = $this->input->post('w7');


        $dayOff = 7;

        if($w1 == ''){
            $dayOff = 0;
        }else if($w2 == ''){
            $dayOff = 1;
        }else if($w3 == ''){
            $dayOff = 2;
        }else if($w4 == ''){
            $dayOff = 3;
        }else if($w5 == ''){
            $dayOff = 4;
        }else if($w6 == ''){
            $dayOff = 5;
        }else if($w7 == ''){
            $dayOff = 6;
        }


        $data = [
            'TIME_OPEN' => $timeOpen,
            'TIME_CLOSE' => $timeClose,
            'TIME1' => $time1,
            'CLOSE1' => $close1,
            'TIME2' => $time2,
            'CLOSE2' => $close2,
            'TIME3' => $time3,
            'CLOSE3' => $close3,
            'TIME4' => $time4,
            'CLOSE4' => $close4,
            'TIME5' => $time5,
            'CLOSE5' => $close5,
            'TIME6' => $time6,
            'CLOSE6' => $close6,
            'DAYOFF' => $dayOff
        ];

        $result =  $this->ClinicModel->update($data, $this->session->userdata('id'));

        if($result){
            echo json_encode(['result'=> true, 'dayOff' => $dayOff]);
        }else{
            echo json_encode(['result'=> false]);
        }

    }

}
