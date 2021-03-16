<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Time extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
      //  $this->logged_in();
        $this->load->model('ClinicModel');
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
        $this->load->view('template/header');
        $this->load->view('time/close');
        $this->load->view('template/footer');
    }

	public function restDay()
	{
        $this->load->view('template/header');
        $this->load->view('time/rest_day');
        $this->load->view('template/footer');
	}
}
