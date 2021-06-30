<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('BookingModel');
        $this->load->model('LikeModel');
        $this->load->model('StatModel');
        $this->load->model('ClinicModel');
        $this->load->model('IncomeModel');
        $this->load->model('ProductModel');
        
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
        $stat = $this->StatModel->pageVisit($this->session->userdata('id'));
       
        $data = [
                    'allBooking' => $allBooking[0]->ALLBOOKING,
                    'todayBooking' => $todayBooking[0]->TODAYBOOKING,
                    'like' => $like,
                    'clinic' => $clinic,
                    'pageVisit' => $stat,
                ];

        $js = [
            base_url() . 'assets/js/app-dashboard.js?v=' . time(),
        ];

        $this->load->view('template/header');
        $this->load->view('dashboard/index', $data);
        $this->load->view('template/footer', ['js' => $js]);
    }

    public function getDataBooking()
    {
        $recordBooking = $this->BookingModel->getDataListNewWaitAccept($this->session->userdata('id'), 5, 1);
        
        header('Content-Type: application/json');

        if ($recordBooking) {
            echo json_encode(['result'=> true, 'data' => $recordBooking]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getDataProduct()
    {
        $recordProduct = $this->ProductModel->getDataTop($this->session->userdata('id'), 5, 1);
        
        header('Content-Type: application/json');

        if ($recordProduct) {
            echo json_encode(['result'=> true, 'data' => $recordProduct]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getDataChart(){
        $conversationRate = [];
        $sale = [];
        $booking = [];

        if($this->input->get('chartType') == 'month'){
            $conversationRate = $this->StatModel->statByMonth($this->session->userdata('id'));
            //$sale = $this->IncomeModel->statByMonth($this->session->userdata('id'));
            $booking = $this->BookingModel->statByMonth($this->session->userdata('id'));
        }else if($this->input->get('chartType') == 'year'){
            $conversationRate = $this->StatModel->statByMonth($this->session->userdata('id'));
        }
        else{
            $conversationRate = $this->StatModel->statByMonth($this->session->userdata('id'));
        }

        $data = [
            'conversationRate' => $conversationRate,
            'sale' => $sale,
            'booking' => $booking
        ];

        echo json_encode(['result'=> true,'data' => $data]);
    }

    public function acceptBooking()
    {
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];

        $data = [
            'ACCEPT' => 1
        ];
        
        $result = $this->BookingModel->updateById($data, $id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        } 
    }
}
