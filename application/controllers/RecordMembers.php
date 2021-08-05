<?php

use MYPDF as GlobalMYPDF;

defined('BASEPATH') OR exit('No direct script access allowed');


// Include the main TCPDF library (search for installation path).
require_once APPPATH."/third_party/tcpdf/tcpdf.php";


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

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



class RecordMembers extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('ReportMembersModel');
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
            $condition .= " AND (CUSTOMERNAME LIKE '%".$search."%' )";
        }

         if($start != ""){
            $condition .= " AND (BOOKDATE >= '".$start."' AND BOOKDATE <='".$end."')";
         }

       
        $member = $this->ReportMembersModel->getReportPdf($this->session->userdata('id'), $condition);
        $clinic = $this->ClinicModel->detailById($this->session->userdata('id'));
       
            $this->load->library('Pdf');
            $this->load->library('parser');
            
        
            $pageLayout = array(100, 80);
            $pdf = new MYPDF();


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
            $pdf->SetLeftMargin(50);
            $pdf->SetRightMargin(12);


            // set margins
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP+25, PDF_MARGIN_RIGHT);
            //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            

            $pdf->AddPage('L', 'A4', true, 'UTF-8', false);
        
            $html = "<br>".'<span style="text-align:center">รายงานยอดขาย</span>';
            

            $html .="<br>".'<br><table  border="1"  align="center" style="margin: 0px auto; ">
            <tr>
                <td width="150" height="30"><b>วันที่เข้ารักษา</b></td>
                <td width="200" height="30"><b>ชื่อ-สกุลคนไข้</b></td>
                <td width="250" height="30"><b>รายละเอียด</b></td>
                <td width="150" height="30"><b>Book on</b></td>
            </tr>';
            
            $i=1;
            foreach($member as $row){
                $i++;
                $html .='<tr>
                <td width="150" height="30">'.$row->BOOKDATE.'</td>
                <td width="200" height="30">'.$row->CUSTOMERNAME.'</td>
                <td width="250" height="30">'.$row->DETAIL.'</td>
                <td width="150" height="30">'.$row->BOOK_ON.'</td>
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