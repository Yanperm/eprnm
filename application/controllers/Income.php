<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Income extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model('IncomeModel');
    }

    public function getDataAll(){
        $income = $this->IncomeModel->getAllData();
        header('Content-Type: application/json');

        if ($income) {
            echo json_encode(['result'=> true, 'data' => $income]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getDataById(){
        $id = $_GET["id"];
        
        if(!empty($id)){
            $income = $this->IncomeModel->getDataById($id);
            
            header('Content-Type: application/json');

            if ($income) {
                echo json_encode(['result'=> true, 'data' => $income]);
            } else {
                echo json_encode(['result'=> false]);
            }
        }
    }

    public function insert(){
       // $_POST = json_decode(file_get_contents("php://input"),true);
        $ciqueue = $_POST["ciqueue"];
        $ciorder = $_POST["ciorder"];
        $cidate = $_POST["cidate"];
        $cinameprefix = $_POST["cinameprefix"];
        $ciname = $_POST["ciname"];
        $cicheck = $_POST["cicheck"];
        $cidrug = $_POST["cidrug"];
        $cilab = $_POST["cilab"];
        $ciprocedure = $_POST["ciprocedure"];
        $cicertificate = $_POST["cicertificate"];
        $IDCARD = $_POST["IDCARD"];
    
      
        $data = [
            'ci_id' => "CI".time(),
            'ci_queue' => $ciqueue,
            'ci_order' => $ciorder,
            'ci_date' => $cidate,
            'ci_nameprefix' => $cinameprefix,
            'ci_name' => $ciname,
            'ci_check' => $cicheck,
            'ci_drug' => $cidrug,
            'ci_lab' => $cilab,
            'ci_procedure' => $ciprocedure,
            'ci_certificate' => $cicertificate,
            'IDCARD' => $IDCARD,
            'CLINICID' => $this->session->userdata('id')
        ];

        $result = $this->IncomeModel->insert($data);

        if($result > 0){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }
    //true
    public function update(){
     
       // $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $ciqueue = $_POST["ciqueue"];
        $ciorder = $_POST["ciorder"];
        $cidate = $_POST["cidate"];
        $cinameprefix = $_POST["cinameprefix"];
        $ciname = $_POST["ciname"];
        $cicheck = $_POST["cicheck"];
        $cidrug = $_POST["cidrug"];
        $cilab = $_POST["cilab"];
        $ciprocedure = $_POST["ciprocedure"];
        $cicertificate = $_POST["cicertificate"];
        $IDCARD = $_POST["IDCARD"];
        

        $data = [
            'ci_queue' => $ciqueue,
            'ci_order' => $ciorder,
            'ci_date' => $cidate,
            'ci_nameprefix' => $cinameprefix,
            'ci_name' => $ciname,
            'ci_check' => $cicheck,
            'ci_drug' => $cidrug,
            'ci_lab' => $cilab,
            'ci_procedure' => $ciprocedure,
            'ci_certificate' => $cicertificate,
            'IDCARD' => $IDCARD,
            'CLINICID' => $this->session->userdata('id')
        ];
      
        $result = $this->IncomeModel->update($data, $id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }

    }
    //true
    public function delete(){

        //$_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        
        $result = $this->IncomeModel->delete($id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

}