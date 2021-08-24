<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class DateExpressModel extends CI_Model {

    public function getDateExpress($clinicId, $condition, $sort, $page, $perPage){
        
        $query = $this->db->query(
            '
            SELECT * FROM tbdateexpress
            WHERE CLINICID = "' . $clinicId . '" '.$condition.' '.$sort.'
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
            FROM tbdateexpress 
            WHERE CLINICID = "' . $clinicId . '" '.$condition
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('tbdateexpress', $data);
        return true;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbdateexpress');
        return true;
    }

}
?>