<?php 

class Advertise extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdvertiseModel');
    }

    public function getDataAll(){
        $advertise = $this->AdvertiseModel->getDataAll();

        header('Content-Type: application/json');

        if($advertise){
            echo json_encode(['result'=>true,'data'=>$advertise]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }

    public function getDataByID(){
        $id = $_GET["id"];

        if(!empty($id)){
            $result = $this->AdvertiseModel->getDataByID($id);

            header('Content-Type: application/json');

            if($result){
                echo json_encode(['result'=>true,'data'=>$result]);
            }else{
                echo json_encode(['result'=> false]);
            }
        }
    }

    public function insertData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $AdvertiseSubject = $_POST["AdvertiseSubject"];
        $AdvertiseDetail = $_POST["AdvertiseDetail"];
        $AdvertiseImage = $_POST["AdvertiseImage"];
        $AdvertiseLink = $_POST["AdvertiseLink"];

        $data = [
            'ADVERTISEID' => time(),
            'ADVERTISESUBJECT' => $AdvertiseSubject,
            'ADVERTISEDETAIL' => $AdvertiseDetail,
            'ADVERTISEIMAGE' => $AdvertiseImage,
            'ADVERTISELINK' => $AdvertiseLink,
        ];

        $result = $this->AdvertiseModel->insert($data);

        if($result > 0){
            echo json_encode(['result'=>true]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }

    public function updateData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $AdvertiseSubject = $_POST["AdvertiseSubject"];
        $AdvertiseDetail = $_POST["AdvertiseDetail"];
        $AdvertiseImage = $_POST["AdvertiseImage"];
        $AdvertiseLink = $_POST["AdvertiseLink"];

        $data = [
            'ADVERTISESUBJECT' => $AdvertiseSubject,
            'ADVERTISEDETAIL' => $AdvertiseDetail,
            'ADVERTISEIMAGE' => $AdvertiseImage,
            'ADVERTISELINK' => $AdvertiseLink,
        ];

        $result = $this->AdvertiseModel->update($data,$id);

        if($result){
            echo json_encode(['result'=>true]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }

    public function deleteData(){
        //$_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $result = $this->AdvertiseModel->delete($id);

        if($result){
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
    }
}
?>