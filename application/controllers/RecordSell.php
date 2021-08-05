<?php

use MYPDF as GlobalMYPDF;

defined('BASEPATH') OR exit('No direct script access allowed');


// Include the main TCPDF library (search for installation path).
require_once APPPATH."/third_party/tcpdf/tcpdf.php";


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
     //public function Header() {
    //     // Logo
    //     $image_file = K_PATH_IMAGES.'logo_example.jpg';
    //     $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    //     // Set font
    //     $this->SetFont('thsarabun', 'B', 20);
    //     // Title
    //     $this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M','UTF-8');

        // $image_header = 'assets/img/nutmor_logo02.png'; // also tried "app/webroot/files/pdf_images/header.jpg"
        // $this->Image($image_header, 10,10, 15, '', 'PNG', '', 'C', false, 300, '', false, false, 0, false, false, false);

        
   // }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('thsarabun', '', 16);
        // Page number
        //$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'ข้อมูล ณ วันที่ '.date('d/m/Y H:i'), 0, false, 'R',0, '', 0, false, 'T', 'M');
    }
}



class RecordSell extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('ReportSellModel');
        $this->load->model('ClinicModel');
    }
    private function logged_in()
    {
        if (!$this->session->userdata('authenticated')) {
            redirect(base_url('login'));
        }
    }

    public function print(){
      
        date_default_timezone_set("Asia/Bangkok");

         $search = $_GET['search'];
         $start = $_GET['start'];
         $end = $_GET['end'];

         $condition = "";
        if($search != ""){
            $condition .= " AND (ci_name LIKE '%".$search."%' OR ci_drug LIKE '%".$search."%' OR ci_lab LIKE '%".$search."%' 
            OR ci_procedure LIKE '%".$search."%' OR ci_certificate LIKE '%".$search."%' )";
        }

         if($start != ""){
            $condition .= " AND (ci_date >= '".$start."' AND ci_date <='".$end."')";
         }

       
        $member = $this->ReportSellModel->getReportPdf($this->session->userdata('id'), $condition);
        $clinic = $this->ClinicModel->detailById($this->session->userdata('id'));
       
            $this->load->library('Pdf');
            $this->load->library('parser');
            
        
            $pageLayout = array(100, 80);
            $pdf = new MYPDF();


            // $image_header = 'assets/img/nutmor_logo02.png';
            // $pdf->SetHeaderData($image_header, PDF_HEADER_STRING);
            $pdf->setHeaderFont(Array('thsarabun', '', 16, '', false));
            $pdf->setHeaderData($ln='', $lw=0, $ht='', $hs='
            '.$clinic->CLINICNAME.' 
            '.$clinic->ADDRESS.'
            '.$clinic->PHONE.'', 
            $tc=array(0,0,0), $lc=array(0,0,0));

            
            $font = 'thsarabun';
            $pdf->font = $font;
            $pdf->SetCreator("");
            $pdf->SetAuthor("");
            $pdf->SetTitle("รายงานยอดขาย");
            $pdf->SetSubject("รายงานยอดขาย");
            $pdf->setPrintHeader(true);
            $pdf->setPrintFooter(true);
            //$pdf->SetAutoPageBreak(TRUE, 0);
            $pdf->SetMargins(0, 0, 0);
            $pdf->SetHeaderMargin(0);
            $pdf->SetTopMargin(10);
            //$pdf->SetFooterMargin(0);
            $pdf->SetFont($font, '', 16);
            $pdf->SetLeftMargin(12);
            $pdf->SetRightMargin(12);


            // set margins
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP+25, PDF_MARGIN_RIGHT);
            //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            

            $pdf->AddPage('L', 'A4', true, 'UTF-8', false);
        
            // $html = '<p><img  style="text-align:left" src="'.base_url().'assets/img/nutmor_logo02.png" width="45px" height="40px"></p>';
            // $html .= '<br><span style="text-align:left"><b>'.$clinic->CLINICNAME."</b></span>";
            // $html .= "<br>".'<span style="text-align:left">'.$clinic->ADDRESS.'</span>';
            // $html .= "<br>".'<span style="text-align:left">Tel : '.$clinic->PHONE.'</span>';
            $html = "<br>".'<span style="text-align:center">รายงานยอดขาย</span>';
            

            $html .="<br>".'<br><table  border="1"  align="center" style="margin: 0px auto; ">
            <tr>
                <td width="120" height="30"><b>วันที่เข้ารักษา</b></td>
                <td width="150" height="30"><b>ชื่อ-สกุลคนไข้</b></td>
                <td width="100" height="30"><b>ค่า DF</b></td>
                <td width="100" height="30"><b>ค่ายา</b></td>
                <td width="100" height="30"><b>ค่าแล็บ</b></td>
                <td width="100" height="30"><b>ค่าหัตถการ</b></td>
                <td width="100" height="30"><b>ค่าใบรับรอง</b></td>
            </tr>';
            
            $i=1;
            foreach($member as $row){
                $i++;
                $html .='<tr>
                <td width="120" height="30">'.$row->ci_date.'</td>
                <td width="150" height="30">'.$row->ci_name.'</td>
                <td width="100" height="30">'.$row->ci_drug.'</td>
                <td width="100" height="30">'.$row->ci_drug.'</td>
                <td width="100" height="30">'.$row->ci_lab.'</td>
                <td width="100" height="30">'.$row->ci_procedure.'</td>
                <td width="100" height="30">'.$row->ci_certificate.'</td>
                </tr>';
             }

                $html .= "</table><br>";
                
            //$pdf->SetRightMargin(10);
            //$html .= "<br>".'<span style="text-align:right">ข้อมูล ณ วันที่ '.date('d/m/Y H:i').'</span>';
             
            
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
          
            $pdf->lastPage();
            $pdf->Output('ReportSell.pdf', 'I');

    }

    
    
}