<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procedure extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('ProcedureModel');
    }
    private function logged_in()
    {
        if (!$this->session->userdata('authenticated')) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        $this->load->view('template/header');
        $this->load->view('procedure/index');
        $this->load->view('template/footer');
    }

	public function getProductMain()
    {
        $condition = '';
        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            if ($this->input->get('type') == '1') {
                $condition .= ' AND CategoryIDs like "%'.$search.'%"';
            }
            if ($this->input->get('type') == '2') {
                $condition .= ' AND CategoryName like "%'.$search.'%"';
            }
        }

        $queue = $this->ProductMainModel->getDataPerpage($this->session->userdata('id'), $condition);
        header('Content-Type: application/json');

        if ($queue) {
            echo json_encode(['result'=> true,'data' => $queue]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }
}
