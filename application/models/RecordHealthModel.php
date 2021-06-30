<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordHealthModel extends CI_Model
{
    public function getDataPerPage($memberId, $clinicId, $condition, $sort, $page, $perPage)
    {
       
        $query = $this->db->query(
            '
            SELECT * FROM tbpatient_health 
            WHERE MEMBERIDCARD = '.$memberId.' AND CLINICID = "' . $clinicId . '" '.$condition.' '.$sort.' 
            LIMIT '.$page.','.$perPage
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function total($memberId, $clinicId, $condition){
        $query = $this->db->query(
            '
            SELECT COUNT(*) AS NUM_OF_ROW FROM tbpatient_health 
            WHERE MEMBERIDCARD = '.$memberId.' AND CLINICID = "' . $clinicId . '" '.$condition
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getDataByClinic($clinicId){
        $query = $this->db->query('
            SELECT * FROM tbpatient_health 
            WHERE CLINICID = "'.$clinicId.'"');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getDataById($id){
        $query = $this->db->query('
            SELECT * FROM tbpatient_health 
            WHERE PHID = "'.$id.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('tbpatient_health', $data);
        return true;
    }

    public function update($data, $id)
    {
        $this->db->where('PHID', $id);
        $this->db->update('tbpatient_health', $data);
        return true;
    }

    public function delete($id)
    {
        $this->db->where('PHID', $id);
        $this->db->delete('tbpatient_health');
        return true;
    }
}
