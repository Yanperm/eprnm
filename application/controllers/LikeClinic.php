<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class LikeClinic extends CI_Controller{

    public function __construct()
    {
        parent:: __construct();
        $this->logged_in();

        $this->load->model('LikeClinicModel');
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
           //base_url() . 'assets/app/time_clinic/time_clinic.css?v=' . time(),
        ];

        $js = [
            base_url() . 'assets/app/like_clinic/like_clinic.js?v=' . time(),
        ];

        $this->load->view('template/header', ['css' => $css]);
        $this->load->view('like_clinic/index');
        $this->load->view('template/footer', ['js' => $js]);
    }

    public function getLike(){

        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            $condition .= ' AND tbmembers.CUSTOMERNAME like "%'.$search.'%"';
            
        }

        if (!empty($this->input->get('sortBy'))) {
            $sort .= 'ORDER BY "tbmembers.'.$sortBy.'" '.$sortType;
        }
    
        $like = $this->LikeClinicModel->getLike($this->session->userdata('id'), $condition, $sort, $page, $perPage);
        $total = $this->LikeClinicModel->total($this->session->userdata('id'), $condition);

             
        header('Content-Type: application/json');
    
        if ($like) {
            echo json_encode(['result'=> true,'like' => $like, 'total' => $total->NUM_OF_ROW]);
        } else {
                echo json_encode(['result'=> false]);
        }
    }

    
}


?>