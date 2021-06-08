<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductSubModel extends CI_Model
{
    public function getDataPerpage($clinicId, $condition)
    {
        
        $query = $this->db->query(
            '
            SELECT * FROM tbsubcategory as sub
            inner join tbproductcategory as main on main.CategoryID = sub.CategoryID
            where sub.CLINICID = "' . $clinicId . '" '.$condition.'
            order by main.CategoryName ASC
          '
        );


        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('tbsubcategory', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->where('SubID', $id);
        $this->db->update('tbsubcategory', $data);
    }

    public function delete($id)
    {
        $this->db->where('SubID', $id);
        $this->db->delete('tbsubcategory');
    }
}
