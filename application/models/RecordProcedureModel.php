<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordProcedureModel extends CI_Model
{
    public function getDataPerpage($memberId, $condition, $sort, $page, $perPage)
    {
        $query = $this->db->query(
            '
            SELECT * FROM tbpatient_procedure 
            where MEMBERIDCARD = "'.$memberId.'" '.$condition.' '.$sort.'
            LIMIT '.$page.','.$perPage
          
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function total($memberId, $condition){
       
        $query = $this->db->query(
            '
            SELECT COUNT(*) AS NUM_OF_ROW FROM tbpatient_procedure 
            WHERE MEMBERIDCARD = "'.$memberId.'" '.$condition
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getDataProcedure($clinicId, $condition, $sort, $page, $perPage)
    {
        $query = $this->db->query(
            '
            SELECT * FROM tbProcedure 
            where CLINICID = "'.$clinicId.'" '.$condition.' '.$sort.'
            LIMIT '.$page.','.$perPage
          
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function totalProcedure($clinicId, $condition){
       
        $query = $this->db->query(
            '
            SELECT COUNT(*) AS NUM_OF_ROW FROM tbProcedure 
            WHERE CLINICID = "'.$clinicId.'" '.$condition
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getDataById($id){
        $query = $this->db->query('
            SELECT * FROM tbpatient_procedure 
            WHERE ProcedureID = "'.$id.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getMaxId($clinicId){
        $query = $this->db->query('
            SELECT MAX(ProcedureIDs) as max_id 
            FROM tbpatient_procedure 
            WHERE CLINICID = "'.$clinicId.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('tbpatient_procedure', $data);
        return true;
    }

    public function delete($id)
    {
        $this->db->where('PROID', $id);
        $this->db->delete('tbpatient_procedure');
        return true;
    }
}
