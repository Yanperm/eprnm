<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogComment extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('BlogCommentModel');
    }

    public function getAllData(){
        $blogComment = $this->BlogCommentModel->getAllData();
        header('Content-Type: application/json');

        if($blogComment){
            echo json_encode(['result'=>true,'data'=>$blogComment]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }

    public function getDataByID(){
        $id = $_GET["id"];

        if(!empty($id)){
            header('Content-Type: application/json');
            $blogComment = $this->BlogCommentModel->getDataByID($id);

            if($blogComment){
                echo json_encode(['result'=>true,'data'=>$blogComment]);
            }else{
                echo json_encode(['result'=>false]);
            }

        }
    }

    public function insertData(){
         // $_POST = json_decode(file_get_contents("php://input"),true);
         $Name = $_POST["Name"];
         $BlogID = $_POST["BlogID"];
         $Description = $_POST["Description"];
 
         $data = [
             'id' => '',
             'name' => $Name,
             'blog_id' => $BlogID,
             'created_at' => date('Y-m-d'),
             'description' => $Description ,
         ];
 
         $result = $this->BlogCommentModel->insert($data);
 
         if($result > 0){
             echo json_encode(["result"=>true]);
         }else{
             echo json_encode(["result"=>false]);
         }
    }

    public function updateData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $Name = $_POST["Name"];
        $BlogID = $_POST["BlogID"];
        $Description = $_POST["Description"];

        $data = [
            'name' => $Name,
            'blog_id' => $BlogID,
            'created_at' => date('Y-m-d'),
            'description' => $Description ,
        ];

        $result = $this->BlogCommentModel->update($data,$id);

        if($result){
            echo json_encode(["result"=>true]);
        }else{
            echo json_encode(["result"=>false]);
        }
   }

    public function deleteData(){
        //$_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
         $result = $this->BlogCommentModel->delete($id);

        if($result){
            echo json_encode(['result' => true]);
         }else{
             echo json_encode(['result' => false]);
         }
    }
}
?>