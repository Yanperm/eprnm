<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clinic extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();
        $this->load->model('ClinicModel');
        $this->load->library('S3_upload');
        $this->load->library('S3');
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
        $this->load->view('clinic/index');
        $this->load->view('template/footer');
	}

    public function data()
    {
        $clinic = $this->ClinicModel->getDetail($this->session->userdata('id'));
        header('Content-Type: application/json');
        echo json_encode($clinic);
    }

    public function update()
    {
        $image = '';
        if (!empty($_FILES["avatar"])) {
            $dir = dirname($_FILES["avatar"]["tmp_name"]);
            $destination = $dir . DIRECTORY_SEPARATOR . $_FILES["avatar"]["name"];
            rename($_FILES["avatar"]["tmp_name"], $destination);
            $image = $this->s3_upload->upload_file($destination);
            $this->session->set_userdata('image', $image);

            //remove old image S3
            if ($this->input->post('old_image') != '') {
                $this->s3_upload->deleteFile(basename($this->input->post('old_image')));
            }
        }

        $name = $this->input->post('name');
        $line = $this->input->post('line');
        $phone = $this->input->post('phone');
        $address = $this->input->post('address');
        $email = $this->input->post('email');
        $province = $this->input->post('province');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $doctorName = $this->input->post('doctor_name');
        $proficient = $this->input->post('PROFICIENT');
        $diploma = $this->input->post('DIPLOMA');
        $services = $this->input->post('services');
        $degree = $this->input->post('degree');


        $data = [
            'CLINICNAME' => $name,
            'LINE' => $line,
            'PHONE' => $phone,
            'USERNAME' => $email,
            'PROVINCE' => $province,
            'LAT' => $latitude,
            'LONG' => $longitude,
            'DOCTORNAME' => $doctorName,
            'PROFICIENT' => $proficient,
            'DIPLOMA' => $diploma,
            'SERVICE' => $services,
            'DEGREE' => $degree,
            'image' => $image
        ];

        $result =  $this->ClinicModel->update($data, $this->session->userdata('id'));

        if($result){
            echo json_encode(['result'=> true,'image_path' => $image]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }
}
