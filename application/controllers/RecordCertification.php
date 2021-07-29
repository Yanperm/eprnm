<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordCertification extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('MemberModel');
        $this->load->model('PatientSickModel');
        $this->load->model('PatientJobModel');
        $this->load->model('ClinicModel');
        $this->load->model('MemberModel');
        $this->load->model('RecordHealthModel');
        $this->load->model('PatientsModel');
        
    }
    private function logged_in()
    {
        if (!$this->session->userdata('authenticated')) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {       
        $member = $this->MemberModel->getDataById($_GET['id']);

        $data = [
            'member' => $member,
            'bookingId' => $this->input->get('booking_id')
        ];

        $this->load->view('template/header');
        $this->load->view('template/record', $data);
        $this->load->view('record_certification/index', $data);
        $this->load->view('template/footer');
    }

    public function getDataJob()
    {
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');

            $condition .= 'AND ( tbpatient_job.CREATE like "%'.$search.'%"';
            $condition .= ' OR BOOKINGID like "%'.$search.'%"';
            $condition .= ' OR Recommendation like "%'.$search.'%"';
            $condition .= ' OR Price like "%'.$search.'%")'; 
        }

        if (!empty($this->input->get('sortBy'))) {
            $sort .= 'ORDER BY '.$sortBy.' '.$sortType;
        }else{
            $sort .= 'ORDER BY tbpatient_job.CREATE DESC';
        }

        $recordJob = $this->PatientJobModel->getDataPerPage($this->input->get('memberId'), $condition, $sort, $page, $perPage);
        $total = $this->PatientJobModel->total($this->input->get('memberId'), $condition);
       
        header('Content-Type: application/json');

        if ($recordJob) {
            echo json_encode(['result'=> true, 'data' => $recordJob, 'total' => $total->NUM_OF_ROW]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function getDataSick()
    {
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');

            $condition .= 'AND ( tbpatient_sick.CREATE like "%'.$search.'%"';
            $condition .= ' OR Dayoff like "%'.$search.'%"';
            $condition .= ' OR BOOKINGID like "%'.$search.'%"';
            $condition .= ' OR Recommendation like "%'.$search.'%"';
            $condition .= ' OR Price like "%'.$search.'%"';
            $condition .= ' OR Startdate like "%'.$search.'%"';
            $condition .= ' OR Enddate like "%'.$search.'%")'; 
        }

        if (!empty($this->input->get('sortBy'))) {
            $sort .= 'ORDER BY '.$sortBy.' '.$sortType;
        }else{
            $sort .= 'ORDER BY tbpatient_sick.CREATE DESC';
        }

        $recordSick = $this->PatientSickModel->getDataPerPage($this->input->get('memberId'), $condition, $sort, $page, $perPage);
        $total = $this->PatientSickModel->total($this->input->get('memberId'), $condition);
       
        header('Content-Type: application/json');

        if ($recordSick) {
            echo json_encode(['result'=> true, 'data' => $recordSick, 'total' => $total->NUM_OF_ROW]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function insertSick(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $data = [
            'SickID' => 'SK'.time(),
            'Dayoff' => $_POST['numOfSick'],
            'Startdate' => $_POST['startDate'],
            'Enddate' => $_POST["endDate"],
            'Recommendation' => $_POST["recommend"],
            'Price' => $_POST["price"],
            'MEMBERIDCARD' => $_POST["memberId"],
            'BOOKINGID' => $_POST["bookingId"],
            'CREATE' => date('Y-m-d'),
            'Status' =>1
        ];

        $result = $this->PatientSickModel->insert($data);
        
        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function updateSick(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        
        $data = [
            'Dayoff' => $_POST['numOfSick'],
            'Startdate' => $_POST['startDate'],
            'Enddate' => $_POST["endDate"],
            'Recommendation' => $_POST["recommend"],
            'Price' => $_POST["price"],
        ];

        $result = $this->PatientSickModel->update($data, $_POST["id"]);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function deleteSick(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        
        $result = $this->PatientSickModel->delete($id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function insertJob(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        
        $diseases = "ไม่มี";
        if(isset($_POST['diseases']) && $_POST['diseases']){
            $diseases = "มี";
        }

        $accident = "ไม่มี";
        if(isset($_POST['accident']) && $_POST['accident']){
            $accident = "มี";
        }

        $hospital = "ไม่มี";
        if(isset($_POST['hospital']) && $_POST['hospital']){
            $hospital = "มี";
        }

        $others = "ไม่มี";
        if(isset($_POST['others']) && $_POST['others']){
            $others = "มี";
        }

        $health = "ปกติ";
        if(isset($_POST['health']) && $_POST['health']){
            $health = "ผิดปกติ";
        }
        
        $data = [
            'JobID' => 'JB'.time(),
            'Diseases' => $diseases,
            'DiseasesDetail' => (isset($_POST['diseasesDetail']) ? $_POST['diseasesDetail'] : '') ,
            'Accident' => $accident,
            'AccidentDetail' => (isset($_POST['accidentDetail']) ? $_POST['accidentDetail'] : '') ,
            'Hospital' => $hospital,
            'HospitalDetail' => (isset($_POST['hospitalDetail']) ? $_POST['hospitalDetail']: '') ,
            'Others' => $others,
            'OthersDetail' => (isset($_POST['othersDetail']) ? $_POST['othersDetail'] :  '') ,
            'BodyHealth' => $health,
            'BodyHealthDetail' => (isset($_POST['healthDetail']) ? $_POST['healthDetail'] :  ''),
            'OtherSymptoms' => (isset($_POST['otherSymptoms']) ? $_POST['otherSymptoms'] :  ''),
            'Recommendation' => (isset($_POST['recommend']) ? $_POST['recommend'] :  ''),
            'Price' => (isset($_POST['price']) ? $_POST['price'] :  ''),
            'MEMBERIDCARD' => $_POST["memberId"],
            'BOOKINGID' => $_POST["bookingId"],
            'CREATE' => date('Y-m-d'),
            'Status' => 1
        ];

        $result = $this->PatientJobModel->insert($data);
        
        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function updateJob(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $diseases = "ไม่มี";
        if(isset($_POST['diseases']) && $_POST['diseases']){
            $diseases = "มี";
        }

        $accident = "ไม่มี";
        if(isset($_POST['accident']) && $_POST['accident']){
            $accident = "มี";
        }

        $hospital = "ไม่มี";
        if(isset($_POST['hospital']) && $_POST['hospital']){
            $hospital = "มี";
        }

        $others = "ไม่มี";
        if(isset($_POST['others']) && $_POST['others']){
            $others = "มี";
        }

        $health = "ปกติ";
        if(isset($_POST['health']) && $_POST['health']){
            $health = "ผิดปกติ";
        }

        $data = [
            'Diseases' => $diseases,
            'DiseasesDetail' => (isset($_POST['diseasesDetail']) ? $_POST['diseasesDetail'] : '') ,
            'Accident' => $accident,
            'AccidentDetail' => (isset($_POST['accidentDetail']) ? $_POST['accidentDetail'] : '') ,
            'Hospital' => $hospital,
            'HospitalDetail' => (isset($_POST['hospitalDetail']) ? $_POST['hospitalDetail']: '') ,
            'Others' => $others,
            'OthersDetail' => (isset($_POST['othersDetail']) ? $_POST['othersDetail'] :  '') ,
            'BodyHealth' => $health,
            'BodyHealthDetail' => (isset($_POST['healthDetail']) ? $_POST['healthDetail'] :  ''),
            'OtherSymptoms' => (isset($_POST['otherSymptoms']) ? $_POST['otherSymptoms'] :  ''),
            'Recommendation' => (isset($_POST['recommend']) ? $_POST['recommend'] :  ''),
            'Price' => (isset($_POST['price']) ? $_POST['price'] :  ''),
        ];

        $result = $this->PatientJobModel->update($data, $_POST["id"]);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function deleteJob(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $id = $_POST["id"];
        
        $result = $this->PatientJobModel->delete($id);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function printCertificateJob()
    {
        $certificateJob = $this->PatientJobModel->getDataById($_GET['id']);
        $member = $this->MemberModel->getDataById($certificateJob->MEMBERIDCARD);
        $clinic = $this->ClinicModel->detailById($this->session->userdata('id'));
        $health = $this->RecordHealthModel->getDataByBookingId($certificateJob->BOOKINGID);
        $patient = $this->PatientsModel->getDataById($certificateJob->MEMBERIDCARD);
      
        $thaiMonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

        if($certificateJob){
            $this->load->library('Pdf');
            $this->load->library('parser');
            $pdf = new Pdf();
            $font = 'thsarabun';
            $pdf->font = $font;
            $pdf->SetCreator("Nutmor.com");
            $pdf->SetAuthor("Nutmor.com");
            $pdf->SetTitle("ใบรับรองแพทย์ สมัครงาน");
            $pdf->SetSubject("ใบรับรองแพทย์");
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetHeaderMargin(5);
            $pdf->SetTopMargin(5);
            $pdf->SetLeftMargin(20);
            $pdf->SetRightMargin(20);
            $pdf->SetAutoPageBreak(TRUE, 0);
            $pdf->SetFooterMargin(0);
            $pdf->SetFont($font, '', 14);
            $pdf->AddPage('P','A4');
            $html = '<h1 style="text-align:center"><b>ใบรับรองแพทย์</b></h1>';
            $html .= '<h3><span style="background-color:black;color:white;"> ส่วนที่ 1 </span> ของผู้รับใบรับรองสุขภาพ</h3>';
            $html .= '<br>ข้าพเจ้า <b>'.$patient->PATIEN_NAMEPREFIX." ".$patient->PATIEN_NAME."</b>";
            $html .= '<br>สถานที่อยู่ (ที่สามารถติดต่อได้) <b>'.$patient->PATIEN_ADDRESS."</b>";
            $html .= '<br>หมายเลขบัตรประจำตัวประชาชน <b>'.$patient->IDCARD.'</b>';
            $html .= '<br>ข้าพเจ้าขอใบรับรองสุขขภาพ โดยมีประวัติสุขภาพดังนี้';

            if($certificateJob->DiseasesDetail != ''){
                $html .= '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. โรคประจำตัว <b>'.$certificateJob->DiseasesDetail."</b>";
            }else{
                $html .= '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. โรคประจำตัว <b>'.$certificateJob->Diseases."</b>";
            }

            if($certificateJob->AccidentDetail != ''){
                $html .= '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. อุบัติเหตุ และ ผ่าตัด <b>'.$certificateJob->AccidentDetail."</b>";
            }else{
                $html .= '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. อุบัติเหตุ และ ผ่าตัด <b>'.$certificateJob->Accident."</b>";
            }

            if($certificateJob->HospitalDetail != ''){
                $html .= '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. เคยเข้ารับการรักษาในโรงพยาบาล <b>'.$certificateJob->HospitalDetail."</b>";
            }else{
                $html .= '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. เคยเข้ารับการรักษาในโรงพยาบาล <b>'.$certificateJob->Hospital."</b>";
            }

            if($certificateJob->OthersDetail != ''){
                $html .= '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. ประวัติอื่นที่สำคัญ <b>'.$certificateJob->OthersDetail."</b>";
            }else{
                $html .= '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. ประวัติอื่นที่สำคัญ <b>'.$certificateJob->Others."</b>";
            }
            
            $html .= '<p style="text-align:right">ลงชื่อ.............................................................................วันที่ '.date('d').' เดือน '.$thaiMonth[intval(date('m'))-1].' พ.ศ. '.(intval(date('Y'))+543).'</p>';
            $html .= '<p style="text-align:right">ในกรณีเด็กที่ไม่สามารถรับรองตนเองได้ ให้ผู้ปกครองลงนามรับรองแทนได้</p>';
            $html .= '<h3><span style="background-color:black;color:white;"> ส่วนที่ 2 </span> ของแพทย์</h3>';
            $html .= '<br>สถานที่ตรวจ <b>'.$clinic->CLINICNAME.'</b> วันที่ '.date('d').' เดือน '.$thaiMonth[intval(date('m'))-1].' พ.ศ. '.(intval(date('Y'))+543);
            $html .= '<br><b>(1)</b> ข้าพเจ้า <b>'.$clinic->DOCTORNAME."</b>";
            $html .= '<br>ใบอนุญาตประกอบวิชาชีพเวชกรรมเลขที่ ..........................................สถานพยาบาลชื่อ <b>'.$clinic->CLINICNAME."</b>";
            $html .= '<br>ที่อยู่ <b>'.$clinic->ADDRESS."</b>";
            $html .= '<br>ได้ตรวจร่างกาย <b>'.$patient->PATIEN_NAMEPREFIX." ".$patient->PATIEN_NAME."</b>";
            $html .= '<br>แล้วเมื่อวันที่ '.date('d').' เดือน '.$thaiMonth[intval(date('m'))-1].' พ.ศ. '.(intval(date('Y'))+543).' มีรายละเอียดดังนี้';
            $html .= '<br>น้ำหนักตัว <b>'.$health->Wieght.'</b> กิโลกรัม&nbsp;&nbsp;ความสูง <b>'.$health->Height.'</b> เซนติเมตร&nbsp;&nbsp;ความดันโลหิต <b>'.$health->BP.'</b> มม.ปรอท&nbsp;&nbsp;ชีพจร <b>'.$health->HR.'</b> ครั้ง/นาที';
            
            if($certificateJob->BodyHealthDetail != ''){
                $html .= '<br>สภาพร่างกายทั่วไปอยู่ในเกณฑ์ <b>'.$certificateJob->BodyHealth." ".$certificateJob->BodyHealthDetail."</b>";
            }else{
                $html .= '<br>สภาพร่างกายทั่วไปอยู่ในเกณฑ์ <b>'.$certificateJob->BodyHealth."</b>";
            }
            $html .= '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ขอรับรองว่า บุคคลดังกล่าว ไม่เป็นผู้มีร่างกายทุพพลภาพจนไม่สามารถปฏิบัติหน้าที่ได้ ไม่ปรากฏอาการของโรคจิต
            หรือจิตฟั่นเฟือนหรือปัญญาอ่อน ไม่ปรากฏอาการของการติดยาเสพติดให้โทษ และอาการของโรคพิษสุราเรื้อรัง และไม่
            ปรากฏอาการและอาการแสดงของโรคต่อไปนี้';
            $html .= '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(1) โรคเรื้อนในระยะติดต่อ หรือในระยะที่ปรากฏอาการเป็นที่รังเกียจแก่สังคม';
            $html .= '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(2) วัณโรคในระยะอันตราย';
            $html .= '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(3) โรคเท้าช้างในระยะที่ปรากฏอาการเป็นที่รังเกียจแก่สังคม';
            $html .= '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(4) อื่น ๆ (ถ้ามี) <b>'.$certificateJob->OtherSymptoms."</b>";
            $html .= '<br><b>(2)</b> สรุปความเห็นและข้อแนะนำของแพทย์ <b>'.$certificateJob->Recommendation."</b>";
            $html .= '<p style="text-align:right">ลงชื่อ................................................................................แพทย์ผู้ตรวจร่างกาย</p>';
            $html .="<br>หมายเหตุ (1) ต้องเป็นแพทย์ซึ่งได้ขึ้นทะเบียนรับใบอนุญาตประกอบวิชาชีพเวชกรรม
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(2) ให้แสดงว่าเป็นผู้มีร่างกายสมบูรณ์เพียงใด ใบรับรองแพทย์ฉบับนีให้ใช้ได้ 1 เดือนนับแต่วันที่ตรวจร่างกาย
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(3) คำรับรองนี้เป็นการตรวจวินิจฉัยเบื้องต้น
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แบบฟอร์มนี้ได้รับการรับรองจากมติคณะกรรมการแพทยสภาในการประชุมครั้งที่ 4/2561 วันที่19 เมษายน 2561";

            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->lastPage();
            $pdf->Output('certificate.pdf', 'I');
        }
    }


}