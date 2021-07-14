<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordLabModel extends CI_Model
{
    public function getDataPerPage($memberId, $condition, $sort, $page, $perPage)
    {
        $query = $this->db->query(
            '
            SELECT * FROM tbpatient_lab 
            WHERE MEMBERIDCARD = '.$memberId.' '.$condition.' '.$sort.' 
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
            SELECT COUNT(*) AS NUM_OF_ROW FROM tbpatient_lab 
            WHERE MEMBERIDCARD = '.$memberId.' '.$condition
            
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getDataLab($clinicId, $condition, $sortBy, $sortType, $page, $perPage)
    {

        $this->db->select('tbsenddepartment.*,tbdepartment.DepName,tblabscompany.LabCName');
        $this->db->from('tbsenddepartment');
        $this->db->join('tbdepartment', 'tbdepartment.DepID = tbsenddepartment.DepID');
        $this->db->join('tblabscompany', 'tblabscompany.LabCID = tbsenddepartment.LabCID');
        $this->db->where('tbsenddepartment.CLINICID', $clinicId);
        if($condition != ""){
            $this->db->where($condition);
        }
        if($sortBy != ""){
            $this->db->order_by($sortBy, $sortType);
        }else{
            $this->db->order_by('tbsenddepartment.STESTNAME', 'ASC');
        }

        $this->db->limit($perPage, $page);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function totalLab($clinicId, $condition)
    {
        $this->db->select('COUNT(*) AS NUM_OF_ROW ');
        $this->db->from('tbsenddepartment');
        $this->db->join('tbdepartment', 'tbdepartment.DepID = tbsenddepartment.DepID');
        $this->db->join('tblabscompany', 'tblabscompany.LabCID = tbsenddepartment.LabCID');
        $this->db->where('tbsenddepartment.CLINICID', $clinicId);
        if($condition != ""){
            $this->db->where($condition);
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }


    public function insert($data)
    {
        $this->db->insert('tbpatient_lab', $data);
        return true;
    }

    public function update($data, $id)
    {
        $this->db->where('LBID', $id);
        $this->db->update('tbpatient_lab', $data);
        return true;
    }

    public function delete($id)
    {
        $this->db->where('LBID', $id);
        $this->db->delete('tbpatient_lab');
        return true;
    }
}
