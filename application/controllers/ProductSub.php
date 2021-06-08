<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductSub extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('ProductSubModel');
        
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
        $this->load->view('product_sub/index');
        $this->load->view('template/footer');
    }

	public function getProductSub()
    {
        $condition = '';
        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            if ($this->input->get('type') == '1') {
                $condition .= ' AND sub.SubIDs like "%'.$search.'%"';
            }
            if ($this->input->get('type') == '2') {
                $condition .= ' AND sub.SubName like "%'.$search.'%"';
            }

            if ($this->input->get('type') == '3') {
                $condition .= ' AND main.CategoryName like "%'.$search.'%"';
            }
        }

        $queue = $this->ProductSubModel->getDataPerpage($this->session->userdata('id'), $condition);
        header('Content-Type: application/json');

        if ($queue) {
            echo json_encode(['result'=> true,'data' => $queue]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }
}
