<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ShowUserModel extends CI_Model {

    public function getDataPerpage($clinicId, $condition, $sort, $page, $perPage)
    {
        $query = $this->db->query(
            '
            SELECT * 
            FROM tbuser
            WHERE CLINICID = "' . $clinicId . '" '.$condition.' '.$sort.'
            LIMIT '.$page.','.$perPage 
           
        );

        if ($query) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function total($clinicId,$condition){
       
        $query = $this->db->query(
            '
            SELECT COUNT(*) AS NUM_OF_ROW 
            FROM tbuser 
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