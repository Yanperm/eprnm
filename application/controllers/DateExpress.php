<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DateExpress extends CI_Controller{

    public function __construct()
    {
        parent :: __construct();
        $this->logged_in();

        $this->load->model('DateExpressModel');
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
           base_url() . 'assets/app/date_express/date_express.js?v=' . time(),
        ];

        

        $this->load->view('template/header', ['css' => $css]);
        $this->load->view('date_express/index');
        $this->load->view('template/footer', ['js' => $js]);
    }

    public function getDateExpress()
    {
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        $date = $this->DateExpressModel->getDateExpress($this->session->userdata('id'), $condition, $sort, $page, $perPage);
        $total = $this->DateExpressModel->total($this->session->userdata('id'), $condition);
       
        header('Content-Type: application/json');

        if ($date) {
            echo json_encode([
                'result'=> true,
                'date' => $date,
                'total' => $total->NUM_OF_ROW
                ]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function insert(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $open = $_POST["open"];
        $close = $_POST["close"];
        $date = $_POST["date"];

        $result = false;
        
        for($i = 0; $i < count($open); $i++){
            $data = [
                'id' => time().$i,
                'time_open' => $open[$i],
                'time_close' =>$close[$i],
                'CLINICID' => $this->session->userdata('id'),
                'date' => $date[$i],
            ];
    
            $result = $this->DateExpressModel->insert($data);
        }
       

        if($result){
            echo json_encode(['result'=> true,'data' => $data]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function delete(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        
        $result = $this->DateExpressModel->delete($id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

}
?>