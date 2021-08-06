<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordDrug extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('MemberModel');
        $this->load->model('RecordMedicalModel');
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
        $this->load->view('record_drug/index', $data);
        $this->load->view('template/footer');
    }
    public function getRecord()
    {
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');
        $memberId = $this->input->get('memberId');
        
        $condition = '';
        $sort = '';

        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            $condition .= 'AND  (BOOKINGID like "%'.$search.'%"';
            $condition .= ' OR PH1 like "%'.$search.'%"';
            $condition .= ' OR PH3 like "%'.$search.'%"';
            $condition .= ' OR PH4 like "%'.$search.'%"';
            $condition .= ' OR PH5 like "%'.$search.'%"';
            $condition .= ' OR PH6 like "%'.$search.'%"';
            $condition .= ' OR COMMENT like "%'.$search.'%")';
        }

        if (!empty($this->input->get('sortBy'))) {
            $sort .= 'ORDER BY "'.$sortBy.'" '.$sortType;
        }

        $record = $this->RecordMedicalModel->getDataPerpage($memberId, $condition, $sort, $page, $perPage);
        $total = $this->RecordMedicalModel->total($memberId, $condition);
       
        header('Content-Type: application/json');

        if ($record) {
            echo json_encode([
                'result'=> true,
                'data' => $record,
                'total' => $total->NUM_OF_ROW
                ]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }
    public function sticker()
    {
        $recordMedical = $this->RecordMedicalModel->getDataByMedicalId($_GET['id']);
      
        if($recordMedical){
            $this->load->library('Pdf');
            $this->load->library('parser');
        
            $pageLayout = array(100, 80);
            $pdf = new Pdf();
            
            $font = 'thsarabun';
            $pdf->font = $font;
            $pdf->SetCreator("");
            $pdf->SetAuthor("");
            $pdf->SetTitle("พิมพ์ฉลากยา");
            $pdf->SetSubject("ฉลากยา");
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetAutoPageBreak(TRUE, 0);
            $pdf->SetMargins(0, 0, 0);
            $pdf->SetHeaderMargin(0);
            $pdf->SetTopMargin(0);
            $pdf->SetFooterMargin(0);
            $pdf->SetFont($font, '', 14);
            // Add a page
            $width = $pdf->pixelsToUnits(283); 
            $height = $pdf->pixelsToUnits(212);
            $resolution= array(80, 80);
            $pdf->AddPage('L', $resolution, true, 'UTF-8', false);
            foreach($recordMedical as $item){
                 
                $data = [
                    'clinicName' => $item->CLINICNAME,
                    'customerName' => $item->CUSTOMERNAME,
                    'dateMedical' => $item->DATE_MEDICAL,
                    'medicalName' => $item->PH1,
                    'ph3' => $item->PH3,
                    'ph4' => $item->PH4,
                    'ph5' => $item->PH5,
                    'ph6' => $item->PH6,
                    'ph7' => $item->PH7,
            'ph2' => $item->PH2,
                    'number' => $item->Number,
                    'unit' => $item->Unit,
                ];
               // $data['data_list'] = $item;
                $html = $this->parser->parse('record_medical/list_pdf', $data, true);
                $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            }

            
            
            // $pdf->AddPage('L', $resolution, true, 'UTF-8', false);
            // $html = $this->parser->parse('record_medical/list_pdf', $data, true);
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->lastPage();
            $pdf->Output('Student_list.pdf', 'I');
        }
     
        
    }
}