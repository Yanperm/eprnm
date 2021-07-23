<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogReply extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('BlogReplyModel');
    }

    public function getAllData() {
        $BlogReply = $this->BlogReplyModel->getAllData();
        header('Content-Type: application/json');

        if($BlogReply){
            echo json_encode(['result'=>true,'data'=>$BlogReply]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }

    public function getDataByID(){
        $id = $_GET["id"];

        if(!empty($id)){
            header('Content-Type: application/json');
            $BlogReply = $this->BlogReplyModel->getDataByID($id);

            if($BlogReply){
                echo json_encode(['result'=>true,'data'=>$BlogReply]);
            }else{
                echo json_encode(['result'=>false]);
            }

        }
    }

    public function insertData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $CommentID = $_POST["CommentID"];
        $Name = $_POST["Name"];
        $Description = $_POST["Description"];

        $data = [
            'id' => '',
            'comment_id' => $CommentID,
            'name' => $Name,
            'created_at' => date('Y-m-d'),
            'description' => $Description ,
        ];

        $result = $this->BlogReplyModel->insert($data);

        if($result > 0){
            echo json_encode(["result"=>true]);
        }else{
            echo json_encode(["result"=>false]);
        }
   }

       public function updateData(){
         // $_POST = json_decode(file_get_contents("php://input"),true);
         $id = $_POST["id"];
         $CommentID = $_POST["CommentID"];
         $Name = $_POST["Name"];
         $Description = $_POST["Description"];
 
         $data = [
             'comment_id' => $CommentID,
             'name' => $Name,
             'created_at' => date('Y-m-d'),
             'description' => $Description,
         ]; 

        $result = $this->BlogReplyModel->update($data,$id);

        if($result){
            echo json_encode(["result"=>true]);
        }else{
            echo json_encode(["result"=>false]);
        }
   }

   public function deleteData(){
       //$_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $result = $this->BlogReplyModel->delete($id);

        if($result){
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
    }

}



?>