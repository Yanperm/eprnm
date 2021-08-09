<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TimeModel extends CI_Model {


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

    public function update($data, $id){
        $this->db->where('IDCLINIC', $id);
        $this->db->update('tbclinic', $data);
        return true;
    }

    public function getDataPerpage($clinicId, $condition, $sort, $page, $perPage){
        
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

    public function delete($ID)
    {
        $this->db->where('id', $ID);
        $this->db->delete('tbdateexpress');
        return true;
    }

}