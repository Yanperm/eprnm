<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class LikeClinicModel extends CI_Model{
    
    public function getLike($clinicId,$condition, $sort, $page, $perPage){

        $query = $this->db->query(
            '
            SELECT tbfavorite.*,tbmembers.CUSTOMERNAME
            FROM tbfavorite
            LEFT JOIN tbmembers ON tbmembers.MEMBERIDCARD =  tbfavorite.MEMBERIDCARD
            WHERE tbfavorite.CLINICID = "' . $clinicId . '" '.$condition.' '.$sort.'
            LIMIT '.$page.','.$perPage
            
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
            FROM tbfavorite 
            LEFT JOIN tbmembers ON tbmembers.MEMBERIDCARD =  tbfavorite.MEMBERIDCARD
            WHERE tbfavorite.CLINICID = "' . $clinicId . '" '.$condition
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }


}


?>