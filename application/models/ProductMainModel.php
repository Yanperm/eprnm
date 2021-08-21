<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductMainModel extends CI_Model
{
    public function getDataPerpage($clinicId, $condition, $sort, $page, $perPage)
    {
        $query = $this->db->query(
            '
            SELECT tbproductcategory.*,count(sub.SubID) AS NUM_OF_SUB
            FROM tbproductcategory
            LEFT JOIN tbsubcategory AS sub ON sub.CategoryID =  tbproductcategory.CategoryID
            WHERE tbproductcategory.CLINICID = "' . $clinicId . '" '.$condition.' '.$sort.'
            GROUP BY tbproductcategory.CategoryID
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
            SELECT COUNT(*) AS NUM_OF_ROW FROM tbproductcategory 
            WHERE CLINICID = "' . $clinicId . '" '.$condition
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getDataByClinic($clinicId){
        $query = $this->db->query('
            SELECT * FROM tbproductcategory 
            WHERE CLINICID = "'.$clinicId.'"');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getDataById($id){
        $query = $this->db->query('
            SELECT * FROM tbproductcategory 
            WHERE CategoryID = "'.$id.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getMaxId($clinicId){
        $query = $this->db->query('
            SELECT MAX(CategoryIDs) as max_id 
            FROM tbproductcategory 
            WHERE CLINICID = "'.$clinicId.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getList($clinicId){
        $query = $this->db->query('
        SELECT *
        FROM tbproductcategory 
        WHERE CLINICID = "'.$clinicId.'"');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('tbproductcategory', $data);
        return true;
    }

    public function update($data, $id)
    {
        $this->db->where('CategoryID', $id);
        $this->db->update('tbproductcategory', $data);
        return true;
    }

    public function delete($id)
    {
        $this->db->where('CategoryID', $id);
        $this->db->delete('tbproductcategory');
        return true;
    }
}