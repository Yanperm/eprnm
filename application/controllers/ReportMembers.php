<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportMembers extends CI_Controller{

    public function __construct()
    {
        parent:: __construct();
        $this->logged_in();

        $this->load->model('ReportMembersModel');
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
           // base_url() . 'assets/app/report_sell/report_sell.js?v=' . time(),
        ];

        $this->load->view('template/header', ['css' => $css]);
        $this->load->view('report_members/index');
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
            $condition .= ' AND tbmembers.CUSTOMERNAME like "%'.$search.'%"  ';
        }

        
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        if ($startDate != "") {
           $condition .= " AND tbbooking.BOOKDATE >= '".$startDate."' AND tbbooking.BOOKDATE <='".$endDate."' ";

        }

        if (!empty($this->input->get('sortBy'))) {
            $sort .= 'ORDER BY "tbbooking.'.$sortBy.'" '.$sortType;
        }


        $getreport = $this->ReportMembersModel->getReport($this->session->userdata('id'), $condition, $sort, $page, $perPage);
        $total = $this->ReportMembersModel->total($this->session->userdata('id'), $condition);
       
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

    public function getChart(){
        
            $getchart =$this->ReportMembersModel->getChart($this->session->userdata('id'));
    
            header('Content-Type: application/json');
    
            if($getchart){
                echo json_encode(['result'=>true,'data'=>$getchart]);
            }else{
                echo json_encode(['result' => false]);
            }
        
    }

    
}
?>