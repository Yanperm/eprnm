<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model
{
    public function getDataPerpage($clinicId, $condition)
    {
        
        $query = $this->db->query(
            '
            SELECT * FROM tbproducts 
            where CLINICID = "' . $clinicId . '" '.$condition.'
            order by ProID ASC
          '
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getDataByClinic($clinicId){
        $query = $this->db->query('
            SELECT * FROM tblabscompany 
            WHERE CLINICID = "'.$clinicId.'"');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getDataById($id){
        $query = $this->db->query('
            SELECT * FROM tblabscompany 
            WHERE LabCID = "'.$id.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getMaxId($clinicId){
        $query = $this->db->query('
            SELECT MAX(LCID) as max_id 
            FROM tblabscompany 
            WHERE CLINICID = "'.$clinicId.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('tblabscompany', $data);
        return true;
    }

    public function update($data, $id)
    {
        $this->db->where('LabCID', $id);
        $this->db->update('tblabscompany', $data);
        return true;
    }

    public function delete($id)
    {
        $this->db->where('LabCID', $id);
        $this->db->delete('tblabscompany');
        return true;
    }
}
