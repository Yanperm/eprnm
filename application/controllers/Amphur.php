<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amphur extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AmphurModel');
    }

    public function getAllData(){
        $amphur = $this->AmphurModel->getAllData();
        header('Content-Type: application/json');

        if($amphur){
            echo json_encode(['result' => true,'data' => $amphur]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }

    public function getDataByID(){
        $id = $_GET["id"];

        if(!empty($id)){
            header('Content-Type: application/json');
            $amphur = $this->AmphurModel->getDataByID($id);

            if($amphur){
                echo json_encode(['result'=>true,'data'=>$amphur]);
            }else{
                echo json_encode(['result'=>false]);
            }

        }
    }

    public function insertData(){
         // $_POST = json_decode(file_get_contents("php://input"),true);
         $AmphurCode = $_POST["AmphurCode"];
         $AmphurName = $_POST["AmphurName"];
         $GEOID = $_POST["GEOID"];
         $ProvinceID = $_POST["ProvinceID"];
 
         $data = [
             'AMPHUR_ID' => '',
             'AMPHUR_CODE' => $AmphurCode,
             'AMPHUR_NAME' => $AmphurName,
             'GEO_ID' => $GEOID,
             'PROVINCE_ID' => $ProvinceID ,
         ];
 
         $result = $this->AmphurModel->insert($data);
 
         if($result > 0){
             echo json_encode(["result"=>true]);
         }else{
             echo json_encode(["result"=>false]);
         }
    }

    public function updateData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $AmphurCode = $_POST["AmphurCode"];
        $AmphurName = $_POST["AmphurName"];
        $GEOID = $_POST["GEOID"];
        $ProvinceID = $_POST["ProvinceID"];

        $data = [
            'AMPHUR_CODE' => $AmphurCode,
            'AMPHUR_NAME' => $AmphurName,
            'GEO_ID' => $GEOID,
            'PROVINCE_ID' => $ProvinceID ,
        ];

        $result = $this->AmphurModel->update($data,$id);

        if($result > 0){
            echo json_encode(["result"=>true]);
        }else{
            echo json_encode(["result"=>false]);
        }
   }

   public function deleteData(){
        //$_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
         $result = $this->AmphurModel->delete($id);

         if($result){
             echo json_encode(['result' => true]);
         }else{
             echo json_encode(['result' => false]);
         }
   }
       
}
?>