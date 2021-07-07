<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class PatientSick extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('PatientSickModel');
    }

    public function getAllData(){
        $patientSick = $this->PatientSickModel->getAllData();
        header('Content-Type: application/json');

        if ($patientSick) {
            echo json_encode(['result' => true, 'data' => $patientSick]);
        }else{
            echo json_encode(['result' => false]);
        }
    }

    public function getDataById(){
        $id=$_GET["id"];

        if(!empty($id)){
            $patientSick = $this->PatientSickModel->getDataById($id);
            
            header('Content-Type: application/json');

            if ($patientSick) {
                echo json_encode(['result'=> true, 'data' => $patientSick]);
            } else {
                echo json_encode(['result'=> false]);
            }
        }
    }

    public function insertData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $IDCard = $_POST["IDCard"];
        $MemberIDCard = $_POST["MemberIDCard"];
        $BookingID = $_POST["BookingID"];
        $Create = $_POST["Create"];
        $Dayoff = $_POST["Dayoff"];
        $Startdate = $_POST["Startdate"];
        $Enddate = $_POST["Enddate"];
        $Recommendation = $_POST["Recommendation"];
        $Price = $_POST["Price"];
        $Status = $_POST["Status"];

        $data = [
            'SickID' => "SK".time(),
            'IDCARD' => $IDCard,
            'MEMBERIDCARD' => $MemberIDCard,
            'BOOKINGID' => $BookingID,
            'CREATE' => $Create,
            'Dayoff' => $Dayoff,
            'Startdate' => $Startdate,
            'Enddate' => $Enddate,
            'Recommendation' => $Recommendation,
            'Price' => $Price,
            'Status' => $Status,
        ];

        $result = $this->PatientSickModel->insert($data);

        if($result > 0){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function updateData(){
         // $_POST = json_decode(file_get_contents("php://input"),true);
         $id = $_POST["id"];
         $IDCard = $_POST["IDCard"];
         $MemberIDCard = $_POST["MemberIDCard"];
         $BookingID = $_POST["BookingID"];
         $Create = $_POST["Create"];
         $Dayoff = $_POST["Dayoff"];
         $Startdate = $_POST["Startdate"];
         $Enddate = $_POST["Enddate"];
         $Recommendation = $_POST["Recommendation"];
         $Price = $_POST["Price"];
         $Status = $_POST["Status"];
 
         $data = [
             'IDCARD' => $IDCard,
             'MEMBERIDCARD' => $MemberIDCard,
             'BOOKINGID' => $BookingID,
             'CREATE' => $Create,
             'Dayoff' => $Dayoff,
             'Startdate' => $Startdate,
             'Enddate' => $Enddate,
             'Recommendation' => $Recommendation,
             'Price' => $Price,
             'Status' => $Status,
         ];
 
         $result = $this->PatientSickModel->update($data,$id);
 
         if($result){
             echo json_encode(['result'=> true]);
         }else{
             echo json_encode(['result'=> false]);
         }

    }

    public function deleteData(){
        //$_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $result = $this->PatientSickModel->delete($id);

        if($result){
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => true]);
        }
    }

}



?>