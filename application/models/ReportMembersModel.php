<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportMembersModel extends CI_Model{

    
    public function getReport($clinicId, $condition, $sort, $page, $perPage){

        $date = date("Y-m-d");
        $lastdate = date("Y-m-d", strtotime("-3 months"));
        $query = $this->db->query(
            '
            SELECT tbbooking.*,tbmembers.CUSTOMERNAME
            FROM tbbooking
            JOIN tbmembers ON tbmembers.IDCARD =  tbbooking.IDCARD
            WHERE tbbooking.CLINICID = "' . $clinicId . '" '.$condition.' '.$sort.' 
            AND BOOKDATE <= "'.$date.'" 
            AND BOOKDATE >= "'.$lastdate.'" 
            LIMIT '.$page.','.$perPage 
           
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }

        
    }


    public function getReportPdf($clinicId, $condition){

        $date = date("Y-m-d");
        $lastdate = date("Y-m-d", strtotime("-3 months"));
      
        $query = $this->db->query(
            '
            SELECT tbbooking.*,tbmembers.CUSTOMERNAME 
            FROM tbbooking 
            JOIN tbmembers ON tbmembers.IDCARD =  tbbooking.IDCARD 
            WHERE tbbooking.CLINICID = "' . $clinicId . '" '.$condition.' 
            AND BOOKDATE <= "'.$date.'" 
            AND BOOKDATE >= "'.$lastdate.'"' 
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function total($clinicId, $condition){

        $date = date("Y-m-d");
        $lastdate = date("Y-m-d", strtotime("-3 months"));
       
        $query = $this->db->query(
            '
            SELECT COUNT(*) AS NUM_OF_ROW 
            FROM tbbooking 
            JOIN tbmembers ON tbmembers.IDCARD =  tbbooking.IDCARD 
            WHERE tbbooking.CLINICID = "' . $clinicId . '" '.$condition.' 
            AND BOOKDATE <= "'.$date.'" 
            AND BOOKDATE >= "'.$lastdate.'"' 
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getChart($clinicId){

        $date = date("Y-m-d");
        $lastdate = date("Y-m-d", strtotime("-3 months"));
        $query = $this->db->query(
            
            "
            SELECT COUNT(*) AS countmember ,DATE_FORMAT(BOOKDATE, '%M-%Y') AS BOOKDATE 
            FROM tbbooking 
            JOIN tbmembers ON tbmembers.IDCARD =  tbbooking.IDCARD 
            WHERE BOOKDATE <= '$date' 
            AND BOOKDATE >= '$lastdate' 
            AND tbbooking.CLINICID = '$clinicId' 
            GROUP BY DATE_FORMAT(BOOKDATE, '%m%')  
            ORDER BY DATE_FORMAT(BOOKDATE, '%Y-%m-%d')  ASC 
            
            "
        );

        $result = $query->result();
        $data = [];
        for($i = 0; $i < count($result); $i++){
            $data[0][$i] = $result[$i]->BOOKDATE;
            $data[1][$i] = $result[$i]->countmember;
        }
        return $data;

        // if ($query->num_rows() > 0) {
        //     return $query->result();
        // } else {
        //     return array();
        // }
    }
}
?>