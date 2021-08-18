<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ShowUser extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('ShowUserModel');
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
            //base_url() . 'assets/app/queue_clode/queue_clode.css?v=' . time(),
        ];

        $js = [
            base_url() . 'assets/app/show_user/show_user.js?v=' . time(),
        ];

        $this->load->view('template/header', ['css' => $css]);
        $this->load->view('show_user/index');
        $this->load->view('template/footer', ['js' => $js]);
    }

	public function getShowUser()
    {
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        //ค้นหา
        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            $condition .= ' where tbuser.UserName like "%'.$search.'%"';
            
        }

        if (!empty($this->input->get('sortBy'))) {
            $sort .= 'ORDER BY "tbuser.'.$sortBy.'" '.$sortType;
        }

        $showuser = $this->ShowUserModel->getDataPerpage($this->session->userdata('id'), $condition, $sort, $page, $perPage);
        $total = $this->ShowUserModel->total($this->session->userdata('id'), $condition);
       
        header('Content-Type: application/json');

        if ($showuser) {
            echo json_encode([
                'result'=> true,
                'main' => $showuser,
                'total' => $total->NUM_OF_ROW
                ]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }
}
?>