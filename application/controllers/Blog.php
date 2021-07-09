<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('BlogModel');
    }

    public function getDataall(){
        $blog = $this->BlogModel->getDataAll();
        
        header('Content-Type: application/json');

        if($blog){
            echo json_encode(['result'=>true, 'data'=>$blog]);
        }else{
            echo json_encode(['result'=>false]);
        }

    }

    public function getDataById(){
        $id = $_GET["id"];

        if(!empty($id))
        $blog = $this->BlogModel->getDataByID($id);

        header('Content-Type: application/json');

        if($blog){
            echo json_encode(['result'=>true,'data'=>$blog]);
        }else{
            echo json_encode(['result' =>false]);
        }
    }

    public function insertData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $Title = $_POST["Title"];
        $Imagepath = $_POST["Imagepath"];
        $CategoryID = $_POST["CategoryID"];
        $Description = $_POST["Description"];
        //$Created_at = $_POST["Created_at"];
        $Created_by  =$_POST["Created_by"];
        $YoutubeLink  =$_POST["YoutubeLink"];

        $data = [
            'id'=> '',
            'title'=> $Title,
            'image_path'=> $Imagepath,
            'category_id'=> $CategoryID,
            'description'=> $Description,
            'created_at'=> date("Y-m-d"),
            'created_by'=> $Created_by,
            'youtube_link' => $YoutubeLink,
        ];

        $result = $this->BlogModel->insert($data);

        if($result > 0 ){
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
    }

    public function updateData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $Title = $_POST["Title"];
        $Imagepath = $_POST["Imagepath"];
        $CategoryID = $_POST["CategoryID"];
        $Description = $_POST["Description"];
        //$Created_at = $_POST["Created_at"];
        $Created_by  =$_POST["Created_by"];
        $YoutubeLink  =$_POST["YoutubeLink"];

        $data = [
            'title'=> $Title,
            'image_path'=> $Imagepath,
            'category_id'=> $CategoryID,
            'description'=> $Description,
            'created_at'=> date("Y-m-d"),
            'created_by'=> $Created_by,
            'youtube_link' => $YoutubeLink,
        ];

        $result = $this->BlogModel->update($data,$id);

        if($result){
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
    }

    public function deleteData(){
        //$_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $result = $this->BlogModel->delete($id);

        if($result){
            echo json_encode(['result'=>true]);
        }else{
            echo json_encode(['result'=>false]);
        }
    }
}
?>