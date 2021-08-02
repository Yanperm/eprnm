<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Fregquency extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('FregquencyModel');
    }

    public function getAllData(){
        $fregquency = $this->FregquencyModel->getAllData();

        header('Content-Type: application/json');

        if($fregquency){
            echo json_encode(['result'=>true,'data'=>$fregquency]);
        }else{
            echo json_encode(['result'=>false]);
        }

    }

    public function getDataByID(){
        $id = $_GET['id'];

        if(!empty($id)){
            header('Content-Type: application/json');

            $fregquency = $this->FregquencyModel->getDataByID($id);

            if($fregquency){
                echo json_encode(['result'=>true,'data'=>$fregquency]);
            }else{
                echo json_encode(['result'=>false]);
            }
        }
    }

    public function insertData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $detail = $_POST['detail'];

        $data = [
            'id' => time(),
            'detail' => $detail
        ];

        $result = $this->FregquencyModel->insert($data);

        if($result>0){
            echo json_encode(['result'=>true]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }

    public function updateData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $id =$_POST['id'];
        $detail = $_POST['detail'];

        $data = [
            'detail' => $detail
        ];

        $result = $this->FregquencyModel->update($data,$id);

        if($result){
            echo json_encode(['result'=>true]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }

    public function deleteData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST['id'];

        $result = $this->FregquencyModel->delete($id);

        if($result){
            echo json_encode(['result'=>true]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }
}


?>