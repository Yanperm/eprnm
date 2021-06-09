<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductMainModel extends CI_Model
{
    public function getDataPerpage($clinicId, $condition)
    {
        
        $query = $this->db->query(
            '
            SELECT * FROM tbproductcategory 
            WHERE CLINICID = "' . $clinicId . '" '.$condition.'
            ORDER BY CategoryName ASC
          '
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getDataById($id){
        $query = $this->db->query('SELECT * FROM tbproductcategory WHERE CategoryID = "'.$id.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getMaxId($clinicId){
        $query = $this->db->query('SELECT MAX(CategoryIDs) as max_id FROM tbproductcategory where CLINICID = "'.$clinicId.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
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
