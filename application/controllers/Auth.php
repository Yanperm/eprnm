<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
//        $this->load->library('S3_upload');
//        $this->load->library('S3');
        // $this->load->model('MembersModel');
        $this->load->model('ClinicModel');
        //$this->load->model('AdminModel');

    }


    public function login()
    {

        $this->form_validation->set_rules('email', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'required');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');


        if ($this->form_validation->run() == false) {

            $this->load->view('auth/login');
        } else {
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->security->xss_clean($this->input->post('password'));

            $user = false;

            $user = $this->ClinicModel->login($email, $password);


            if ($user) {

                $userdata = array();

                $userdata = array(
                    'id' => $user->IDCLINIC,
                    'name' => $user->CLINICNAME,
                    'authenticated' => TRUE,
                    'activate' => $user->ACTIVATE,
                    'email' => $user->USERNAME,
                    'type' => 'clinic',
                    'image' => $user->image
                );
                $this->session->set_userdata($userdata);

                redirect(base_url('dashboard'));
            } else {
                $this->session->set_flashdata('message', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
                redirect(base_url('login'));
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }


}
