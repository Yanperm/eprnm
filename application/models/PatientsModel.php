<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PatientsModel extends CI_Model
{
    public function getDataById($memberId)
    {
        $query = $this->db->query('SELECT * FROM tbpatients where MEMBERIDCARD = "' . $memberId . '"');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('tbpatients', $data);
        return true;
    }

    public function update($data, $id)
    {
        $this->db->where('PATIENT_ID', $id);
        $this->db->update('tbpatients', $data);
        return true;
    }

    public function getDataPerpageListData($clinicId, $condition,$sort, $page, $perPage)
    {
        $query = $this->db->query(
            '
            SELECT * FROM tbmembers 
            where CLINICID = "' . $clinicId . '" '.$condition.' '.$sort.' 
            LIMIT '.$page.','.$perPage.'
          '
          
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function totalListData($clinicId, $condition){
       
        $query = $this->db->query(
            '
            SELECT COUNT(*) AS NUM_OF_ROW 
            FROM tbmembers 
            WHERE CLINICID = "' . $clinicId . '" '.$condition
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }
}
