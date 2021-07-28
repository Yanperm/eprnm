<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TimeModel extends CI_Model {

    // public function getDataPerpage($clinicId, $condition, $sort, $page, $perPage){
        
    //     $query = $this->db->query(
    //         '
    //         SELECT * FROM tbclinic
    //         WHERE IDCLINIC = "' . $clinicId . '" '.$condition.' '.$sort.'
    //         LIMIT '.$page.','.$perPage
           
    //     );

    //     if ($query->num_rows() > 0) {
    //         return $query->result();
    //     } else {
    //         return array();
    //     }
    // }

    public function getDay($clinicId){
        
        $query = $this->db->query(
            '
            SELECT * FROM tbclinic
            WHERE IDCLINIC = "' . $clinicId .'"'
           
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    // public function total($clinicId, $condition){
       
    //     $query = $this->db->query(
    //         '
    //         SELECT COUNT(*) AS NUM_OF_ROW FROM tbclinic 
    //         WHERE IDCLINIC = "' . $clinicId . '" '.$condition
    //     );

    //     if ($query->num_rows() > 0) {
    //         return $query->row();
    //     } else {
    //         return array();
    //     }
    // }


    public function update($data, $id){
        $this->db->where('IDCLINIC', $id);
        $this->db->update('tbclinic', $data);
        return true;
    }



}