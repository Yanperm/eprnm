<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clinic extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();
        $this->load->model('ClinicModel');
//        $this->load->model('MembersModel');
//        $this->load->model('BookingModel');
//        $this->load->library('pagination');
//        $this->load->library('S3_upload');
//        $this->load->library('S3');
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
        $this->load->view('clinic/index');
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
        $name = $this->input->post('name');
        $line = $this->input->post('line');
        $phone = $this->input->post('phone');
        $address = $this->input->post('address');
        $email = $this->input->post('email');
        $province = $this->input->post('province');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');

        $data = [
            'CLINICNAME' => $name,
            'LINE' => $line,
            'PHONE' => $phone,
            'USERNAME' => $email,
            'PROVINCE' => $province,
            'LAT' => $latitude,
            'LONG' => $longitude
        ];

        $result =  $this->ClinicModel->update($data, $this->session->userdata('id'));

        if($result){
            return true;
        }else{
            return false;
        }


    }
}
