<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProcedureModel extends CI_Model
{
    public function getDataPerpage($clinicId, $condition)
    {
        $query = $this->db->query(
            '
            SELECT * FROM tbProcedure 
            where CLINICID = "' . $clinicId . '" '.$condition.'
            order by ProcedureName ASC
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
        $this->db->insert('tbProcedure', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->where('ProcedureID', $id);
        $this->db->update('tbProcedure', $data);
    }

    public function delete($id)
    {
        $this->db->where('ProcedureID', $id);
        $this->db->delete('tbProcedure');
    }
}
