<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

//        $this->load->model('MembersModel');
        $this->load->model('BookingModel');
        $this->load->model('LikeModel');
        $this->load->model('StatModel');
        $this->load->model('ClinicModel');
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
        $allBooking = $this->BookingModel->getDataAllByClinic($this->session->userdata('id'));
        $todayBooking = $this->BookingModel->getDataTodayByClinic($this->session->userdata('id'));
        $like = $this->LikeModel->getCount($this->session->userdata('id'));
        $clinic = $this->ClinicModel->detailById($this->session->userdata('id'));
        $stat = $this->StatModel->stat($this->session->userdata('id'));
        $listToDay = $this->BookingModel->getDataListNew($this->session->userdata('id'), 10, 1);

        $data = [
                    'allBooking' => $allBooking[0]->ALLBOOKING,
                    'todayBooking' => $todayBooking[0]->TODAYBOOKING,
                    'like' => $like,
                    'clinic' => $clinic,
                    'listToDay' => $listToDay
                    //'statData' => $statData
                ];


        $js = [
            base_url() . 'assets/js/app-dashboard.js?v=' . time(),
        ];

        $this->load->view('template/header');
        $this->load->view('dashboard/index', $data);
        $this->load->view('template/footer', ['js' => $js]);
    }
}
