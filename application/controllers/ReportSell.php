<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportSell extends CI_Controller{

    public function __construct()
    {
        parent:: __construct();
        $this->logged_in();

        $this->load->model('ReportSellModel');
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
           // base_url() . 'assets/app/Product_Youtube/Product_Youtube.css?v=' . time(),
        ];

        $js = [
            base_url() . 'assets/app/report_sell/report_sell.js?v=' . time(),
        ];

        $this->load->view('template/header', ['css' => $css]);
        $this->load->view('report_sell/index');
        $this->load->view('template/footer', ['js' => $js]);
    }


    public function getReport(){

        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            $condition .= ' AND tbincome.ci_name like "%'.$search.'%"';
           // $condition .= ' AND tbincome.ci_date like "%'.$search.'%"';
        }

        if (!empty($this->input->get('sortBy'))) {
            $sort .= 'ORDER BY "tbincome.'.$sortBy.'" '.$sortType;
        }

        $getreport = $this->ReportSellModel->getReport($this->session->userdata('id'), $condition, $sort, $page, $perPage);
        $total = $this->ReportSellModel->total($this->session->userdata('id'), $condition);
       
        header('Content-Type: application/json');

        if ($getreport) {
            echo json_encode([
                'result'=> true,
                'report' => $getreport,
                'total' => $total->NUM_OF_ROW
                ]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    
}
?>