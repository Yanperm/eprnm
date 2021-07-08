<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Favorite extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('FavoriteModel');
    }

    public function getAllData(){
        $favorite =$this->FavoriteModel->getAllData();

        header('Content-Type: application/json');

        if($favorite){
            echo json_encode(['result'=>true,'data'=>$favorite]);
        }else{
            echo json_encode(['result' => false]);
        }
    }

    public function getDataByID(){
        $id = $_GET["id"];

        if(!empty($id)){
            $favorite = $this->FavoriteModel->getDataByID($id);

            header('Content-Type: application/json');

            if($favorite){
                echo json_encode(['result' => true,'data' => $favorite]);
            }else{
                echo json_encode(['result' => false]);
            }
        }
    }

    public function insertData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $IDcard = $_POST["IDcard"];
        $MemberIDCard = $_POST["MemberIDCard"];
        $ClinicID = $_POST["ClinicID"];

        $data = [
            'FAVID' => '',
            'IDCARD' => $IDcard,
            'MEMBERIDCARD' => $MemberIDCard,
            'CLINICID' => $ClinicID,
        ];

        $result = $this->FavoriteModel->insert($data);

        if($result > 0){
            echo json_encode(['result'=>true]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }

    public function updateData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $id= $_POST["id"];
        $IDcard = $_POST["IDcard"];
        $MemberIDCard = $_POST["MemberIDCard"];
        $ClinicID = $_POST["ClinicID"];

        $data = [
            'IDCARD' => $IDcard,
            'MEMBERIDCARD' => $MemberIDCard,
            'CLINICID' => $ClinicID,
        ];

        $result = $this->FavoriteModel->update($data,$id);

        if($result){
            echo json_encode(['result'=>true]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }

    public function deleteData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $result = $this->FavoriteModel->delete($id);

        if($result){
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
    }
}

?>