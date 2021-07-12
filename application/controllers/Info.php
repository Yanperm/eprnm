<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Info extends CI_Controller{

     public function __construct()
     {
         parent::__construct();

         $this->load->model('InfoModel');
     }

     public function getAllData(){
         $info = $this->InfoModel->getAllData();

        header('Content-Type: application/json');

         if($info){
             echo json_encode(['result'=>true,'data'=>$info]);
         }else{
             echo json_encode(['result'=>false]);
         }
     }

     public function getDataByID(){
        
        $id = $_GET["id"];

         if(!empty($id)){
         $info = $this->InfoModel->getDataByID($id);

        header('Content-Type: application/json');


        if($info){
            echo json_encode(['reslut'=>true,'data'=>$info]);
        }else{
            echo json_encode(['result'=>false]);
        }

        }
     }

     public function insertData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
         date_default_timezone_set('Asia/Bangkok');

         $ID = $_POST["ID"];
         $InfoName = $_POST["InfoName"];
         $Detail = $_POST["Detail"];
         //$created_at = $_POST["created_at"];
         //$updated_at = $_POST["updated_at"];
         $Update_by = $_POST["Update_by"];

         $data = [
              //'id' => '',
             'id' => $ID ,
             'info_name' => $InfoName,
             'detail' => $Detail,
             'created_at' => date("Y-m-d h:i:sa"),
             //'updated_at' => date("Y-m-d h:i:sa"),
             'Update_by' => $Update_by,
         ];

         $result = $this->InfoModel->insert($data);

         if($result > 0){
             echo json_encode(['result'=>true]);
        }else{
            echo json_encode(['result'=>false]);
        }
     }

     public function updateData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
         date_default_timezone_set('Asia/Bangkok');
         
         $id = $_POST["ID"];
         $InfoName = $_POST["InfoName"];
         $Detail = $_POST["Detail"];
         //$created_at = $_POST["created_at"];
         //$updated_at = $_POST["updated_at"];
         $Update_by = $_POST["Update_by"];

         $data = [
             'info_name' => $InfoName,
             'detail' => $Detail,
             //'created_at' => date("Y-m-d h:i:sa"),
             'updated_at' => date("Y-m-d h:i:sa"),
             'Update_by' => $Update_by,
         ];

         $result = $this->InfoModel->update($data,$id);

         if($result){
             echo json_encode(['result'=>true]);
        }else{
            echo json_encode(['result'=>false]);
        }
     }

     public function deleteData(){
        //$_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $result = $this->InfoModel->delete($id);

        if($result){
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
     }
}



?>