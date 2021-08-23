<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductSubModel extends CI_Model
{

    public function getDataPerpage($clinicId, $condition, $sort, $page, $perPage)
    {
        $query = $this->db->query(
            '
            SELECT *
            FROM tbsubcategory as sub
            LEFT JOIN tbproductcategory AS main ON main.CategoryID =  sub.CategoryID
            WHERE sub.CLINICID = "' . $clinicId . '" '.$condition.' '.$sort.'
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
            SELECT COUNT(*) AS NUM_OF_ROW FROM tbsubcategory  as sub
            LEFT JOIN tbproductcategory AS main ON main.CategoryID =  sub.CategoryID
            WHERE   sub.CLINICID = "' . $clinicId . '" '.$condition
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getDataById($id){
        $query = $this->db->query('
            SELECT * FROM tbsubcategory 
            WHERE SubID = "'.$id.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getMaxId($clinicId){
        $query = $this->db->query('
            SELECT MAX(SubIDs) as max_id 
            FROM tbsubcategory 
            WHERE CLINICID = "'.$clinicId.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getList($categoryId, $clinicId){
        $query = $this->db->query('
        SELECT *
        FROM tbsubcategory 
        WHERE CategoryID = "'.$categoryId.'" AND CLINICID = "'.$clinicId.'"');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('tbsubcategory', $data);
        return true;
    }

    public function update($data, $id)
    {
        $this->db->where('SubID', $id);
        $this->db->update('tbsubcategory', $data);
        return true;
    }

    public function delete($id)
    {
        $this->db->where('SubID', $id);
        $this->db->delete('tbsubcategory');
        return true;
    }
}