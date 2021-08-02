<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordMedical extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->logged_in();

        $this->load->model('MemberModel');
        $this->load->model('PatientHistoryModel');
        $this->load->model('RecordMedicalModel');
        $this->load->model('CountUnitModel');
        $this->load->model('CallingUnitModel');
        $this->load->model('FregquencyModel');
        $this->load->model('SuggestionModel');
        $this->load->model('MealModel');
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
        $this->load->view('record_medical/index', $data);
        $this->load->view('template/footer');
    }

    public function getOptiondata(){
        $countUnit = $this->CountUnitModel->getAllData();
        $callingUnit = $this->CallingUnitModel->getAllData();
        $fregquency = $this->FregquencyModel->getAllData();
        $suggestion = $this->SuggestionModel->getAllData();
        $meal = $this->MealModel->getAllData();
        
        
        $data = [
            'countUnit' => $countUnit,
            'callingUnit' => $callingUnit,
            'fregquency' => $fregquency,
            'suggestion' => $suggestion,
            'meal' => $meal
        ];

        header('Content-Type: application/json');

        if ($data) {
            echo json_encode(['result'=> true, 'data' => $data]);
        } else {
            echo json_encode(['result'=> false]);
        }
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

    public function getProduct()
    {
        $sortBy = $this->input->get('sortBy');
        $sortType = $this->input->get('sortType');
        $page = (intval($this->input->get('page')) - 1) * $this->input->get('perPage');
        $perPage = $this->input->get('perPage');

        $condition = '';
        $sort = '';

        if (!empty($this->input->get('search'))) {
            $search = $this->input->get('search');
            $condition .= '  (tbproducts.ProID like "%'.$search.'%"';
            $condition .= ' OR tbproducts.CommonName like "%'.$search.'%"';
            $condition .= ' OR tbproducts.BrandName like "%'.$search.'%"';
            $condition .= ' OR tbproducts.Barcode like "%'.$search.'%"';
            $condition .= ' OR tbsubcategory.SubName like "%'.$search.'%"';
            $condition .= ' OR tbproductcategory.CategoryName like "%'.$search.'%")';
        }

        $recordProduct = $this->RecordMedicalModel->getDataProduct($this->session->userdata('id'), $condition, $sortBy, $sortType, $page, $perPage);
        $total = $this->RecordMedicalModel->totalProduct($this->session->userdata('id'), $condition);

        header('Content-Type: application/json');

        if ($recordProduct) {
            echo json_encode([
                'result'=> true,
                'data' => $recordProduct,
                'total' => $total->NUM_OF_ROW
            ]);
        } else {
            echo json_encode(['result'=> false]);
        }
    }

    public function insert(){
        $_POST = json_decode(file_get_contents("php://input"),true);
        $memberId = $_POST["member_id"];
        $ph1 = $_POST["ph1"];
        $ph2 = $_POST["ph2"];
        $ph3 = $_POST["ph3"];
        $ph4 = $_POST["ph4"];
        $ph5 = $_POST["ph5"];
        $ph6 = $_POST["ph6"];
        $ph7 = $_POST["ph7"];
        $ph8 = $_POST["ph8"];
        $ph9 = $_POST["ph9"];
        $pregCat = $_POST["pregCat"];
        $comment = $_POST["comment"];
        $duration = $_POST["duration"];
        $number = $_POST["number"];
        $unit = $_POST["unit"];
        $barcode = $_POST["barcode"];
        $bookingId = $_POST["booking_id"];
      
        $data = [
            'MEDICALID' => "MI".time(),
            'MEMBERIDCARD' => $memberId,
            'PH1' => $ph1,
            'PH2' => $ph2,
            'PH3' => $ph3,
            'PH4' => $ph4,
            'PH5' => $ph5,
            'PH6' => $ph6,
            'PH7' => $ph7,
            'PH8' => $ph8,
            'PH9' => $ph9,
            'PregCat' => $pregCat,
            'COMMENT' => $comment,
            'Duration' => $duration,
            'Number' => $number,
            'Unit' => $unit,
            'Barcode' => $barcode,
            'Status' => 1,
            'BOOKINGID' => $bookingId,
            'CREATE' => date('Y-m-d'),
            'CLINICID' => $this->session->userdata('id'),
        ];

        $result = $this->RecordMedicalModel->insert($data);

        if($result){
            echo json_encode(['result'=> true]);
        }else{
            echo json_encode(['result'=> false]);
        }
    }

    public function sticker()
    {
        $recordMedical = $this->RecordMedicalModel->getDataById($_GET['id']);
      
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