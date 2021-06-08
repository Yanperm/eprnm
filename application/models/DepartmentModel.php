<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DepartmentModel extends CI_Model
{
    public function getDataPerpage($clinicId, $condition)
    {
        
        $query = $this->db->query(
            '
            SELECT * FROM tbdepartment as dep
            inner join tblabscompany as company on company.LabCID = dep.LabCID
            where dep.CLINICID = "' . $clinicId . '" '.$condition.'
            order by company.LabCName ASC
          '
        );

    //     echo '
    //     SELECT * FROM tbdepartment as dep
    //     inner join tblabscompany as company on company.LabCID = dep.LabCID
    //     where dep.CLINICID = "' . $clinicId . '" '.$condition.'
    //     order by tblabscompany.LabCName ASC
    //   ';
      

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('tbdepartment', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->where('DepID', $id);
        $this->db->update('tbdepartment', $data);
    }

    public function delete($id)
    {
        $this->db->where('DepID', $id);
        $this->db->delete('tblabscompany');
    }
}
