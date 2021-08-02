<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordCost extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('MemberModel');
        $this->load->model('ClinicModel');
        $this->load->model('RecordLabModel');
        $this->load->model('PatientHistoryModel');
        $this->load->model('RecordMedicalModel');
        $this->load->model('RecordLabModel');
        $this->load->model('RecordProcedureModel');
        $this->load->model('PatientJobModel');
        $this->load->model('PatientSickModel');
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
        $bookingId = $_GET['booking_id'];
        $clinic = $this->ClinicModel->detailById($this->session->userdata('id'));
        $diagnose = $this->PatientHistoryModel->getDataById($bookingId);
        $medical = $this->RecordMedicalModel->getDataByBookingId($bookingId);
        $lab = $this->RecordLabModel->getDataByBookingId($bookingId);
        $procedure = $this->RecordProcedureModel->getDataByBookingId($bookingId);
        $certificateJob = $this->PatientJobModel->getDataByBookingId($bookingId);
        $certificateSick = $this->PatientSickModel->getDataByBookingId($bookingId);
        
        $data = [
            'member' => $member,
            'bookingId' => $bookingId,
            'clinic' => $clinic,
            'diagnose' => $diagnose,
            'medical' => $medical,
            'lab' => $lab,
            'procedure' => $procedure,
            'certificateJob' => $certificateJob,
            'certificateSick' => $certificateSick
        ];

        $this->load->view('template/header');
        $this->load->view('template/record', $data);
        $this->load->view('record_cost/index', $data);
        $this->load->view('template/footer');
    }

    public function receipt(){
        $member = $this->MemberModel->getDataById($_GET['id']);
        $bookingId = $_GET['booking_id'];
        $clinic = $this->ClinicModel->detailById($this->session->userdata('id'));
        $diagnose = $this->PatientHistoryModel->getDataById($bookingId);
        $medical = $this->RecordMedicalModel->getDataByBookingId($bookingId);
        $lab = $this->RecordLabModel->getDataByBookingId($bookingId);
        $procedure = $this->RecordProcedureModel->getDataByBookingId($bookingId);
        $certificateJob = $this->PatientJobModel->getDataByBookingId($bookingId);
        $certificateSick = $this->PatientSickModel->getDataByBookingId($bookingId);

       
            $this->load->library('Pdf');
            $this->load->library('parser');
        
            $pageLayout = array(100, 80);
            $pdf = new Pdf();
            
            $font = 'thsarabun';
            $pdf->font = $font;
            $pdf->SetCreator("");
            $pdf->SetAuthor("");
            $pdf->SetTitle("ใบเสร็จ");
            $pdf->SetSubject("ใบเสร็จ");
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetAutoPageBreak(TRUE, 0);
            $pdf->SetMargins(0, 0, 0);
            $pdf->SetHeaderMargin(0);
            $pdf->SetTopMargin(1);
            $pdf->SetFooterMargin(0);
            $pdf->SetFont($font, '', 10);
            // Add a page
            $width = $pdf->pixelsToUnits(283); 
            $height = $pdf->pixelsToUnits(212);
            $resolution= array(50, 150);
            $pdf->AddPage('P', $resolution, true, 'UTF-8', false);
        
            $html = '<p><img  style="text-align:center" src="'.base_url().'assets/img/nutmor_logo02.png" width="40px" height="35px"></p>';
            $html .= '<br><span style="text-align:center"><b>'.$clinic->CLINICNAME."</b></span>";
            $html .= "<br>".'<span style="text-align:center">'.$clinic->ADDRESS.'</span>';
            $html .= "<br>".'<span style="text-align:right">Tel : '.$clinic->PHONE.'</span>';
            $html .= "<br>".'<span style="text-align:left">ต้นฉบับใบเสร็จรับเงิน</span>';
            $html .= "<br>".'<span style="text-align:left">วันที่ '.date('d/m/Y H:i').'</span>';
            $html .= "<hr>";
            $html .= "<br>".'<span style="text-align:left">ลูกค้า : '.$member->CUSTOMERNAME.'</span>';
            $html .= "<hr>";
            $i = 0;
            $total = 0;
            $html .= '<table style="width:135px">';
            if(!empty($diagnose)){
                $i ++;
                $html .= '<tr ><td ><b>'.$i.".Diagnose</b></td><td></td></tr>";
                foreach($diagnose as $item){
                    $total += $item->PH5;
                    $html .= '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$item->PH3.'</td><td style="text-align:right">'.number_format($item->PH5, 2)."</td></tr>";
                }  
            }
            if(!empty($medical)){
                $i ++;
                $html .= '<tr><td><b>'.$i.".Medicine</b></td><td></td></tr>";
                foreach($medical as $item){
                    $total += $item->PH8;
                    $html .= '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$item->PH1.'</td><td style="text-align:right">'.number_format($item->PH8, 2)."</td></tr>";
                }  
            }
            if(!empty($lab)){
                $i ++;
                $html .= '<tr><td ><b>'.$i.".Laboratory</b></td><td></td></tr>";
                foreach($lab as $item){
                    $total += $item->PH4;
                    $html .= '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$item->PH1.'</td><td style="text-align:right">'.number_format($item->PH4, 2)."</td></tr>";
                }  
            }
            if(!empty($procedure)){
                $i ++;
                $html .= '<tr><td><b>'.$i.".Procedure</b></td><td></td></tr>";
                foreach($procedure as $item){
                    $total += $item->PH3;
                    $html .= '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$item->PH2.'</td><td style="text-align:right">'.number_format($item->PH3, 2)."</td></tr>";
                }  
            }
            if(!empty($certificateJob) || !empty($certificateSick)){
                $i ++;
                $html .= '<tr ><td><b>'.$i.".Certificate</b></td><td></td></tr>";
                if(!empty($certificateJob)){
                    foreach($certificateJob as $item){
                        $total += $item->Price;
                        $html .= '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ค่าใบรับรองแพทย์
                        สำหรับสมัครงาน</td><td style="text-align:right">'.number_format($item->Price, 2)."</td></tr>";
                    }  
                }
                
                if(!empty($certificateSick)){
                    foreach($certificateJob as $item){
                        $total += $item->Price;
                        $html .= '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ค่าใบรับรองแพทย์สำหรับลาป่วย</td><td style="text-align:right">'.number_format($item->Price, 2)."</td></tr>";
                    }  
                }   
            }
            $html .= '<tr><td><b>Sub Total</b></td><td style="text-align:right">'.number_format($total, 2).'</td></tr>';
            $html .= '<tr><td><b>Discount</b></td><td style="text-align:right">'.number_format(0, 2).'</td></tr>';
            $html .= '<tr><td><b>Net Total</b></td><td style="text-align:right">'.number_format($total, 2).'</td></tr>';
            $html .= "<hr>";
            $html .= '<tr><td><b>CASH</b></td><td style="text-align:right">'.number_format($total, 2).'</td></tr>';
            $html .= "<hr>";
            $html .= "</table><br>";
            $html .= '<br><br><span style="text-align:center;">*โปรดตรวจสอบรายการทุกครั้งเพื่อความถูกต้อง*</span>';
           
           
            
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
          
            $pdf->lastPage();
            $pdf->Output('Student_list.pdf', 'I');
        

    }
}