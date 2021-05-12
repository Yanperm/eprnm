<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Patient extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //  $this->logged_in();
        $this->load->model('BookingModel');
        $this->load->library('S3_upload');
        $this->load->library('S3');
    }
    private function logged_in()
    {
        if (!$this->session->userdata('authenticated')) {
            redirect(base_url('login'));
        }
    }

    public function listData()
    {
        $this->load->view('template/header');
        $this->load->view('patient/list_data');
        $this->load->view('template/footer');
    }

    public function manageQueue()
    {
        $this->load->view('template/header');
        $this->load->view('patient/manage_queue');
        $this->load->view('template/footer');
    }

    public function getQueue()
    {
        $date = date('Y-m-d');
        $condition = '';
        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            if ($this->input->get('type') == '1') {
                $condition .= ' AND member.CUSTOMERNAME like "%'.$search.'%"';
            }
            if ($this->input->get('type') == '2') {
                $condition .= ' AND member.IDCARD like "%'.$search.'%"';
            }
            if ($this->input->get('type') == '3') {
                $condition .= ' AND member.PHONE like "%'.$search.'%"';
            }
        }

        if (!empty($this->input->get('date'))) {
            $form = $this->input->get('date')[0];
            $to = $this->input->get('date')[1];
            $condition .= ' AND (booking.BOOKDATE BETWEEN '.$form.' AND '.$to.' )';
        } else {
            $condition .= ' AND booking.BOOKDATE = "'.date('Y-m-d').'"';
        }

        if ($this->input->get('typeSearch2') == 'true') {
            $condition .= ' AND booking.CHECKIN = 1 ';
        }

        $queue = $this->BookingModel->getDataPerpage($this->session->userdata('id'), '', $condition);
        header('Content-Type: application/json');

        if ($queue) {
            echo json_encode(['result'=> true,'data' => $queue]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function queue()
    {
        $queue = $this->BookingModel->getDataList($this->session->userdata('id'), 1000, 0);
        $currentQues = $this->BookingModel->getCurrentQues($this->session->userdata('id'));


        $data = [
          'queue' => $queue,
          'currentQues' => $currentQues
        ];

        $this->load->view('template/header');
        $this->load->view('patient/queue_today', $data);
        $this->load->view('template/footer');
    }
}
