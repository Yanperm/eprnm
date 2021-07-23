<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class District extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('DistrictModel');
    }

    public function getAllData(){
        $district = $this->DistrictModel->getAllData();
        header('Content-Type: application/json');

        if($district){
            echo json_encode(['result'=>true,'data'=>$district]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }

    public function getDataByID(){
        $id = $_GET["id"];

        if(!empty($id)){
        header('Content-Type: application/json');

        $district = $this->DistrictModel->getDataByID($id);

        if($district){
            echo json_encode(['result'=>true,'data'=>$district]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }
    }

    public function insertData(){
       // $_POST = json_decode(file_get_contents("php://input"),true);
        $DistrictCode = $_POST["DistrictCode"];
        $DistrictName = $_POST["DistrictName"];
        $AmphurID = $_POST["AmphurID"];
        $ProvinceID = $_POST["ProvinceID"];
        $GEOID = $_POST["GEOID"];

        $data = [
            'DISTRICT_ID' => '',
            'DISTRICT_CODE' => $DistrictCode,
            'DISTRICT_NAME' => $DistrictName,
            'AMPHUR_ID' => $AmphurID,
            'PROVINCE_ID' => $ProvinceID ,
            'GEO_ID' => $GEOID,
        ];

        $result = $this->DistrictModel->insert($data);

        if($result > 0){
            echo json_encode(["result"=>true]);
        }else{
            echo json_encode(["result"=>false]);
        }
    }

    public function updateData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $id =$_POST["id"];
         $DistrictCode = $_POST["DistrictCode"];
         $DistrictName = $_POST["DistrictName"];
         $AmphurID = $_POST["AmphurID"];
         $ProvinceID = $_POST["ProvinceID"];
         $GEOID = $_POST["GEOID"];
 
         $data = [
             'DISTRICT_CODE' => $DistrictCode,
             'DISTRICT_NAME' => $DistrictName,
             'AMPHUR_ID' => $AmphurID,
             'PROVINCE_ID' => $ProvinceID ,
             'GEO_ID' => $GEOID,
         ];
 
         $result = $this->DistrictModel->update($data,$id);
 
         if($result){
             echo json_encode(["result"=>true]);
         }else{
             echo json_encode(["result"=>false]);
         }
     }

     public function deleteData(){
        //$_POST = json_decode(file_get_contents("php://input"),true);
        $id=$_POST["id"];

        $result = $this->DistrictModel->delete($id);

        if($result){
            echo json_encode(['result'=>true]);
        }else{
            echo json_encode(['result'=>false]);
        }
     }
}


?>