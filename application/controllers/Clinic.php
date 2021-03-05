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
}
