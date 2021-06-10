<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckListModel extends CI_Model
{
    public function getDataPerpage($clinicId, $condition)
    {
        
        $query = $this->db->query(
            '
            SELECT * FROM tbsenddepartment as checklist
            inner join tbdepartment as department on department.DepID = checklist.DepID
            inner join tblabscompany as company on company.LabCID = checklist.LabCID
            where checklist.CLINICID = "' . $clinicId . '" '.$condition.'
            order by checklist.STESTNAME ASC
          '
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getDataById($id){
        $query = $this->db->query('
            SELECT * FROM tbsenddepartment 
            WHERE SID = "'.$id.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getMaxId($clinicId){
        $query = $this->db->query('
            SELECT MAX(SPID) as max_id 
            FROM tbsenddepartment 
            WHERE CLINICID = "'.$clinicId.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('tbsenddepartment', $data);
        return true;
    }

    public function update($data, $id)
    {
        $this->db->where('SID', $id);
        $this->db->update('tbsenddepartment', $data);
        return true;
    }

    public function delete($id)
    {
        $this->db->where('SID', $id);
        $this->db->delete('tbsenddepartment');
        return true;
    }
}
