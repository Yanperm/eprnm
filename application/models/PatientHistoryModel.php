<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PatientHistoryModel extends CI_Model
{
    public function getDataPerPage($memberId, $condition, $sort, $page, $perPage)
    {
        $query = $this->db->query(
            '
            SELECT * FROM tbpatient_history 
            WHERE MEMBERIDCARD = '.$memberId.' '.$condition.' '.$sort.' 
            LIMIT '.$page.','.$perPage
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }


    public function total($memberId, $condition){
        $query = $this->db->query(
            '
            SELECT COUNT(*) AS NUM_OF_ROW FROM tbpatient_history 
            WHERE MEMBERIDCARD = '.$memberId.' '.$condition
            
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getDataById($bookId)
    {
        $query = $this->db->query(
            '
            SELECT * FROM tbpatient_history 
            WHERE BOOKINGID = "'.$bookId.'"'
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('tbpatient_history', $data);
        return true;
    }

    public function update($data, $id)
    {
        $this->db->where('PHID', $id);
        $this->db->update('tbpatient_history', $data);
        return true;
    }

    public function delete($id)
    {
        $this->db->where('PHID', $id);
        $this->db->delete('tbpatient_history');
        return true;
    }
}