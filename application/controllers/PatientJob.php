<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class PatientJob extends CI_Controller{

    public function __construct()
    {
        parent:: __construct();

        $this->load->model('PatientJobModel');
    }

    public function getDataAll(){
        $patientjob = $this->PatientJobModel->getAllData() ;

        header('Content-Type: application/json');

        if ($patientjob) {
            echo json_encode(['result'=> true, 'data' => $patientjob]);
        } else {
            echo json_encode(['result'=> false]);
        }

    }

    public function getDataByID(){
        $id = $_GET["id"];
        
        if(!empty($id)){
            $patientjob = $this->PatientJobModel->getDataById($id);
            
            header('Content-Type: application/json');

            if ($patientjob) {
                echo json_encode(['result'=> true, 'data' => $patientjob]);
            } else {
                echo json_encode(['result'=> false]);
            }
        }
    }

    public function insertData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $IDcard = $_POST["IDcard"];
        $MemberIDCard = $_POST["MemberIDCard"];
        $BookingID = $_POST["BookingID"];
        //$Create = $_POST["Create"];
        $Diseases = $_POST["Diseases"];
        $DiseasesDetail = $_POST["DiseasesDetail"];
        $Accident = $_POST["Accident"];
        $AccidentDetail = $_POST["AccidentDetail"];
        $Hospital = $_POST["Hospital"];
        $HospitalDetail = $_POST["HospitalDetail"];
        $Others = $_POST["Others"];
        $OthersDetail = $_POST["OthersDetail"];
        $BodyHealth = $_POST["BodyHealth"];
        $BodyHealthDetail = $_POST["BodyHealthDetail"];
        $OtherSymptoms = $_POST["OtherSymptoms"];
        $Recommendation = $_POST["Recommendation"];
        $Price = $_POST["Price"];
        $Status = $_POST["Status"];

        $data = [
            'JobID' => "JB".time(),
            'IDCARD' => $IDcard,
            'MEMBERIDCARD' => $MemberIDCard,
            'BOOKINGID' => $BookingID,
            'CREATE' => date("Y-m-d"),
            'Diseases' => $Diseases,
            'DiseasesDetail' => $DiseasesDetail,
            'Accident' => $Accident,
            'AccidentDetail' => $AccidentDetail,
            'Hospital' => $Hospital,
            'HospitalDetail' => $HospitalDetail,
            'Others' => $Others,
            'OthersDetail' => $OthersDetail,
            'BodyHealth' => $BodyHealth,
            'BodyHealthDetail' => $BodyHealthDetail,
            'OtherSymptoms' => $OtherSymptoms,
            'Recommendation' => $Recommendation,
            'Price' => $Price,
            'Status' => $Status
        ];

        $result = $this->PatientJobModel->insert($data);

        if ($result > 0) {
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
    }

    public function updateData(){
        // $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $IDcard = $_POST["IDcard"];
        $MemberIDCard = $_POST["MemberIDCard"];
        $BookingID = $_POST["BookingID"];
        //$Create = $_POST["Create"];
        $Diseases = $_POST["Diseases"];
        $DiseasesDetail = $_POST["DiseasesDetail"];
        $Accident = $_POST["Accident"];
        $AccidentDetail = $_POST["AccidentDetail"];
        $Hospital = $_POST["Hospital"];
        $HospitalDetail = $_POST["HospitalDetail"];
        $Others = $_POST["Others"];
        $OthersDetail = $_POST["OthersDetail"];
        $BodyHealth = $_POST["BodyHealth"];
        $BodyHealthDetail = $_POST["BodyHealthDetail"];
        $OtherSymptoms = $_POST["OtherSymptoms"];
        $Recommendation = $_POST["Recommendation"];
        $Price = $_POST["Price"];
        $Status = $_POST["Status"];

        $data = [
            'IDCARD' => $IDcard,
            'MEMBERIDCARD' => $MemberIDCard,
            'BOOKINGID' => $BookingID,
            'CREATE' => date("Y-m-d"),
            'Diseases' => $Diseases,
            'DiseasesDetail' => $DiseasesDetail,
            'Accident' => $Accident,
            'AccidentDetail' => $AccidentDetail,
            'Hospital' => $Hospital,
            'HospitalDetail' => $HospitalDetail,
            'Others' => $Others,
            'OthersDetail' => $OthersDetail,
            'BodyHealth' => $BodyHealth,
            'BodyHealthDetail' => $BodyHealthDetail,
            'OtherSymptoms' => $OtherSymptoms,
            'Recommendation' => $Recommendation,
            'Price' => $Price,
            'Status' => $Status
        ];

        $result = $this->PatientJobModel->update($data,$id);

        if ($result) {
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
    }

    public function deleteData(){
        //$_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        $result = $this->PatientJobModel->delete($id);

        if ($result) {
            echo json_encode(['result' => true]);
        }else{
            echo json_encode(['result' => false]);
        }
            
    }

    

    
}

?>