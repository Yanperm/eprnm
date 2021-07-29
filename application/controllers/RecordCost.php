<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordCost extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('MemberModel');
        $this->load->model('ClinicModel');
        $this->load->model('RecordLabModel');
        $this->load->model('PatientHistoryModel');
        $this->load->model('RecordMedicalModel');
        $this->load->model('RecordLabModel');
        $this->load->model('RecordProcedureModel');
        $this->load->model('PatientJobModel');
        $this->load->model('PatientSickModel');
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
        $clinic = $this->ClinicModel->detailById($this->session->userdata('id'));
        $diagnose = $this->PatientHistoryModel->getDataById($bookingId);
        $medical = $this->RecordMedicalModel->getDataByBookingId($bookingId);
        $lab = $this->RecordLabModel->getDataByBookingId($bookingId);
        $procedure = $this->RecordProcedureModel->getDataByBookingId($bookingId);
        $certificateJob = $this->PatientJobModel->getDataByBookingId($bookingId);
        $certificateSick = $this->PatientSickModel->getDataByBookingId($bookingId);
        
        $data = [
            'member' => $member,
            'bookingId' => $bookingId,
            'clinic' => $clinic,
            'diagnose' => $diagnose,
            'medical' => $medical,
            'lab' => $lab,
            'procedure' => $procedure,
            'certificateJob' => $certificateJob,
            'certificateSick' => $certificateSick
        ];

        $this->load->view('template/header');
        $this->load->view('template/record', $data);
        $this->load->view('record_cost/index', $data);
        $this->load->view('template/footer');
    }
}