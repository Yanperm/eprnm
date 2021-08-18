<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProcedureModel extends CI_Model
{
    public function getDataPerpage($clinicId, $condition,$sort, $page, $perPage)
    {
        $query = $this->db->query(
            '
            SELECT * FROM tbProcedure 
            where CLINICID = "' . $clinicId . '" '.$condition.' '.$sort.' 
            order by ProcedureIDs ASC
            LIMIT '.$page.','.$perPage.'
          '
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
            FROM tbProcedure 
            WHERE CLINICID = "' . $clinicId . '" '.$condition
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getDataById($id){
        $query = $this->db->query('
            SELECT * FROM tbProcedure 
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
            FROM tbProcedure 
            WHERE CLINICID = "'.$clinicId.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }


    public function insert($data)
    {
        $this->db->insert('tbProcedure', $data);
        return true;
    }

    public function update($data, $id)
    {
        $this->db->where('ProcedureID', $id);
        $this->db->update('tbProcedure', $data);
        return true;
    }

    public function delete($id)
    {
        $this->db->where('ProcedureID', $id);
        $this->db->delete('tbProcedure');
        return true;
    }
}