<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportMembersModel extends CI_Model{

    
    public function getReport($clinicId, $condition, $sort, $page, $perPage){
        $query = $this->db->query(
            '
            SELECT tbbooking.*,tbmembers.CUSTOMERNAME
            FROM tbbooking
            JOIN tbmembers ON tbmembers.IDCARD =  tbbooking.IDCARD
            WHERE tbbooking.CLINICID = "' . $clinicId . '" '.$condition.' '.$sort.'
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
            SELECT tbbooking.*,tbmembers.CUSTOMERNAME
            FROM tbbooking
            JOIN tbmembers ON tbmembers.IDCARD =  tbbooking.IDCARD
            WHERE tbbooking.CLINICID = "' . $clinicId . '" '.$condition
            
           
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
            SELECT COUNT(*) AS NUM_OF_ROW
            FROM tbbooking 
            JOIN tbmembers ON tbmembers.IDCARD =  tbbooking.IDCARD
            WHERE tbbooking.CLINICID = "' . $clinicId . '" '.$condition
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }
}
?>