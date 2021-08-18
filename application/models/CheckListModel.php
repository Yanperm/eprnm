<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckListModel extends CI_Model
{
    public function getDataPerpage($clinicId, $condition,$sort, $page, $perPage)
    {
        
        $query = $this->db->query(
            '
            SELECT * FROM tbsenddepartment as checklist
            inner join tbdepartment as department on department.DepID = checklist.DepID
            inner join tblabscompany as company on company.LabCID = checklist.LabCID
            where checklist.CLINICID = "' . $clinicId . '" '.$condition.' '.$sort.' 
            order by checklist.STESTNAME ASC 
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
            FROM tbsenddepartment 
            inner join tbdepartment as department on department.DepID = tbsenddepartment.DepID
            inner join tblabscompany as company on company.LabCID = tbsenddepartment.LabCID
            WHERE tbsenddepartment.CLINICID = "' . $clinicId . '" '.$condition.' '
        );

        if ($query->num_rows() > 0) {
            return $query->row();
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
