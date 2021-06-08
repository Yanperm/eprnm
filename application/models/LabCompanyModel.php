<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LabCompanyModel extends CI_Model
{
    public function getDataPerpage($clinicId, $condition)
    {
        
        $query = $this->db->query(
            '
            SELECT * FROM tblabscompany 
            where CLINICID = "' . $clinicId . '" '.$condition.'
            order by LabCName ASC
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
        $this->db->insert('tblabscompany', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->where('LabCID', $id);
        $this->db->update('tblabscompany', $data);
    }

    public function delete($id)
    {
        $this->db->where('LabCID', $id);
        $this->db->delete('tblabscompany');
    }
}
