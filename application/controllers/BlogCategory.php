<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogCategory extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('BlogCategoryModel');
    }

    public function getAllData(){

        header('Content-Type: application/json');
        $blogCategory = $this->BlogCategoryModel->getAllData();

        if($blogCategory){
            echo json_encode(['result'=>true,'data'=>$blogCategory]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }

    public function getDataByID(){
        $id = $_GET["id"];

        if(!empty($id)){
            header('Content-Type: application/json');
            $blogCategory = $this->BlogCategoryModel->getDataByID($id);

            if($blogCategory){
                echo json_encode(['result'=>true,'data'=>$blogCategory]);
            }else{
                echo json_encode(['result'=>false]);
            }

        }
    }

    public function insertData(){
         // $_POST = json_decode(file_get_contents("php://input"),true);
        $Name = $_POST["Name"];

        $data = [
            'id' => '',
            'name' => $Name
        ];

        $result = $this->BlogCategoryModel->insert($data);

        if($result > 0){
            echo json_encode(['result'=>true]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }

    public function updateData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $Name = $_POST["Name"];

        $data = [
            'name' => $Name
        ];

        $result = $this->BlogCategoryModel->update($data,$id);

        if($result){
            echo json_encode(['result'=>true]);
        }else{
            echo json_encode(['result'=>false]);
        }
   }

   public function deleteData(){
        //$_POST = json_decode(file_get_contents("php://input"),true);
       $id = $_POST["id"];
       $result = $this->BlogCategoryModel->delete($id);

       if($result){
           echo json_encode(['result'=>true]);
       }else{
           echo json_encode(['result'=>false]);
       }
   }


}


?>