<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PatientSickModel extends CI_Model {

    public function getDataPerPage($memberId, $condition, $sort, $page, $perPage)
    {
          $query = $this->db->query(
            '
            SELECT * FROM tbpatient_sick 
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
            SELECT COUNT(*) AS NUM_OF_ROW FROM tbpatient_sick 
            WHERE MEMBERIDCARD = '.$memberId.' '.$condition 
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getDataByBookingId($bookingId)
    {
        $query = $this->db->query(
            '
            SELECT * FROM tbpatient_sick 
            WHERE BOOKINGID = "'.$bookingId.'"'
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function insert($data){
        $this->db->insert('tbpatient_sick', $data);
        
        return true;
    }

    public function update($data, $id){
        $this->db->where('SickID', $id);
        $this->db->update('tbpatient_sick', $data);
        
        return true;
    }

    public function delete($id){
        $this->db->where('SickID', $id);
        $this->db->delete('tbpatient_sick');
        
        return true;
    }
}
?>