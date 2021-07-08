<?php 

class CountUnit extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('CountUnitModel');
    }

    public function getAllData(){
        $countunit = $this->CountUnitModel->getAllData();

        header('Content-Type: application/json');

        if ($countunit) {
            echo json_encode(['result' => true, 'data' => $countunit]);
        }else{
            echo json_encode(['result' =>false]);
        }
    }

    public function getDatdByID(){
        $id = $_GET["id"];

        if (!empty($id)) {
            $countunit = $this->CountUnitModel->getDataByID($id);

            header('Content-Type: application/json');

            if ($countunit) {
                echo json_encode(['result' => true,'data'=>$countunit]);
            }else{
                echo json_encode(['result' => false]);
            }
        }
    }

    public function insertData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $Detail = $_POST["Detail"];

        $data = [
            'id' => time(),
            'detail' => $Detail,
        ];

        $result = $this->CountUnitModel->insert($data);

        if ($result>0) {
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
    }

    public function updateData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $Detail = $_POST["Detail"];

        $data = [
            'detail' => $Detail,
        ];

        $result = $this->CountUnitModel->update($data,$id);

        if ($result) {
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
    }

    public function deleteData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $id =$_POST["id"];
        $result = $this->CountUnitModel->delete($id);

        if ($result) {
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
    }
}

?>