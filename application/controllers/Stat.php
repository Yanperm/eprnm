<?php
defined('BASEPATH') or exit('No direct script access allowed');

 class Stat extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('StatModel');
    }

    public function getAllData(){
        $stat = $this->StatModel->getAllData();

        header('Content-Type: application/json');

        if($stat){
            echo json_encode(['result' => true, 'data'=>$stat]);
        }else{
            echo json_encode(['result' => false]);
        }
    }

    public function getDataByID(){
         $id = $_GET["id"];

        if(!empty($id))
        $stat = $this->StatModel->getDataByID($id);

        header('Content-Type: application/json');

        if($stat){
            echo json_encode(['result'=>true,'data'=>$stat]);
        }else{
            echo json_encode(['result' =>false]);
        }
    }

    public function insertData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        date_default_timezone_set('Asia/Bangkok');
       // $IDCLINIC = $_POST["IDCLINIC"];
        $IP = $_POST["IP"];
       // $CREATEDATE = $_POST["CREATEDATE"];

        $data = [
            'id'=> '',
            'IDCLINIC'=> $this->session->userdata('id'),
            'IP'=> $IP,
            'CREATEDATE'=> date("Y-m-d h:i:sa"),
        ];

        $result = $this->StatModel->insert($data);

        if($result > 0 ){
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
    }

    public function updateData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        date_default_timezone_set('Asia/Bangkok');

        $id = $_POST["id"];
       // $IDCLINIC = $_POST["IDCLINIC"];
        $IP = $_POST["IP"];
       // $CREATEDATE = $_POST["CREATEDATE"];

        $data = [
            'IDCLINIC'=> $this->session->userdata('id'),
            'IP'=> $IP,
            'CREATEDATE'=> date("Y-m-d h:i:sa"),
        ];

        $result = $this->StatModel->update($data,$id);

        if($result){
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
    }

    public function deleteData(){
        //$_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $result = $this->StatModel->delete($id);

        if($result){
            echo json_encode(['result'=>true]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }
 }


?>