<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SeoClinic extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('SeoClinicModel');
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
            base_url() . 'assets/app/Seo_Clinic/Seo_Clinic.css?v=' . time(),
        ];

        $js = [
            base_url() . 'assets/app/Seo_Clinic/Seo_Clinic.js?v=' . time(),
        ];

        $this->load->view('template/header', ['css' => $css]);
        $this->load->view('Seo_Clinic/index');
        $this->load->view('template/footer', ['js' => $js]);
    }

    public function getSeoClinic()
    {
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        // if (!empty($this->input->get('search'))) {
        //     $search = $this->input->get('search');
        //     $condition .= ' AND tbclinic.SEO_TITLE like "%'.$search.'%"';
            
        // }

        // if (!empty($this->input->get('sortBy'))) {
        //     $sort .= 'ORDER BY "tbclinic.'.$sortBy.'" '.$sortType;
        // }

        $seoclinic = $this->SeoClinicModel->getDataPerpage($this->session->userdata('id'), $condition, $sort, $page, $perPage);
        $total = $this->SeoClinicModel->total($this->session->userdata('id'), $condition);
       
        header('Content-Type: application/json');

        if ($seoclinic) {
            echo json_encode([
                'result'=> true,
                'main' => $seoclinic,
                'total' => $total->NUM_OF_ROW
                ]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }


    public function update(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $seotitle = $_POST["seotitle"];
        $seometa = $_POST["seometa"];
      
        $data = [
            'SEO_TITLE' => $seotitle,
            'SEO_META' => $seometa,
        ];

        $result = $this->SeoClinicModel->update($data, $id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }
}



?>