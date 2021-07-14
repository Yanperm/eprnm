<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Province extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('ProvinceModel');
    }

    public function getDataAll(){
        $province = $this->ProvinceModel->getDataAll() ;

        header('Content-Type: application/json');

        if ($province) {
            echo json_encode(['result'=> true, 'data' => $province]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getDataByID(){
        $id = $_GET["id"];

        if (!empty($id)) {
            $province = $this->ProvinceModel->getDataByID($id);

            header('Content-Type: application/json');

            if ($province) {
                echo json_encode(['result'=>true,'data'=>$province]);
            }else{
                echo json_encode(['result'=>false]);
            }
        }
    }

    public function insertData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $Provincecode = $_POST["Provincecode"];
        $Provincename = $_POST["Provincename"];
        $GEO_ID = $_POST["GEO_ID"];

        $data = [
            'PROVINCE_ID' => '',
            'PROVINCE_CODE' => $Provincecode,
            'PROVINCE_NAME' => $Provincename,
            'GEO_ID' => $GEO_ID,
        ];

        $result = $this->ProvinceModel->insert($data);

        if($result > 0){
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
    }

    public function updateData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $Provincecode = $_POST["Provincecode"];
        $Provincename = $_POST["Provincename"];
        $GEO_ID = $_POST["GEO_ID"];

        $data = [
            'PROVINCE_CODE' => $Provincecode,
            'PROVINCE_NAME' => $Provincename,
            'GEO_ID' => $GEO_ID,
        ];

        $result = $this->ProvinceModel->update($data,$id);

        if($result){
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
    }

    public function deleteData(){
        //$_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $result = $this->ProvinceModel->delete($id);

        if ($result) {
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
    }

    public function joinProvinceAndAmphur (){
        $result = $this->ProvinceModel->joinProvinceAndAmphur();
        header('Content-Type: application/json');

        if($result){
            echo json_encode(['result' => true,'data' => $result]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }
}


?>