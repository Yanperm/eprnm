<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DepartmentModel extends CI_Model
{
    public function getDataPerpage($clinicId, $condition,$sort, $page, $perPage)
    {
        
        $query = $this->db->query(
            '
            SELECT * FROM tbdepartment as dep 
            inner join tblabscompany as company on company.LabCID = dep.LabCID 
            where dep.CLINICID = "' . $clinicId . '" '.$condition.' '.$sort.' 
            order by company.LabCName ASC 
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
            FROM tbdepartment 
            inner join tblabscompany as company on company.LabCID = tbdepartment.LabCID
            WHERE tbdepartment.CLINICID = "' . $clinicId . '" '.$condition
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getDataById($id){
        $query = $this->db->query('
            SELECT * FROM tbdepartment 
            WHERE DepID = "'.$id.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getDataByClinicAndLab($clinicId, $labId){
        $query = $this->db->query('
            SELECT * FROM tbdepartment 
            WHERE CLINICID = "'.$clinicId.'"
            AND LabCID = "'.$labId.'"
            ');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getMaxId($clinicId){
        $query = $this->db->query('
            SELECT MAX(DID) as max_id 
            FROM tbdepartment 
            WHERE CLINICID = "'.$clinicId.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('tbdepartment', $data);
        return true;
    }

    public function update($data, $id)
    {
        $this->db->where('DepID', $id);
        $this->db->update('tbdepartment', $data);
        return true;
    }

    public function delete($id)
    {
        $this->db->where('DepID', $id);
        $this->db->delete('tbdepartment');
        return true;
    }
}
