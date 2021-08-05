<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportSellModel extends CI_Model{

    
    public function getReport($clinicId, $condition, $sort, $page, $perPage){
        $query = $this->db->query(
            '
            SELECT tbincome.* 
            FROM tbincome
            JOIN tbmembers ON tbmembers.IDCARD =  tbincome.IDCARD
            WHERE tbincome.CLINICID = "' . $clinicId . '" '.$condition.' '.$sort.'
            LIMIT '.$page.','.$perPage
           
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }


    public function getReportPdf($clinicId, $condition){
      
        $query = $this->db->query(
            '
            SELECT tbincome.* 
            FROM tbincome
            JOIN tbmembers ON tbmembers.IDCARD =  tbincome.IDCARD
            WHERE tbincome.CLINICID = "' . $clinicId . '" '.$condition
            
           
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }


    public function total($clinicId, $condition){
       
        $query = $this->db->query(
            '
            SELECT COUNT(*) AS NUM_OF_ROW FROM tbincome 
            WHERE CLINICID = "' . $clinicId . '" '.$condition
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }
}
?>