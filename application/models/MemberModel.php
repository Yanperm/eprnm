<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberModel extends CI_Model
{
    public function getDataById($memberId)
    {
        $query = $this->db->query('SELECT * FROM tbmembers where MEMBERIDCARD = "' . $memberId . '"');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('tbmembers', $data);
        return $this->db->insert_id();
    }

    public function delete($memberId)
    {
        $this->db->where('MEMBERIDCARD', $memberId);
        $this->db->delete('tbmembers');
    }
}
