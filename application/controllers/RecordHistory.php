<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordHistory extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('MemberModel');
    }
    private function logged_in()
    {
        if (!$this->session->userdata('authenticated')) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {       
        $member = $this->MemberModel->getDataById($_GET['id']);
        $bookingId = $_GET['booking_id'];

        $data = [
            'member' => $member,
            'bookingId' => $bookingId
        ];

        $this->load->view('template/header');
        $this->load->view('template/record', $data);
        $this->load->view('record_history/index', $data);
        $this->load->view('template/footer');
    }
}