<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductYoutubeModel extends CI_Model
{
    public function getDataPerpage($clinicId, $condition, $sort, $page, $perPage)
    {
        
        $query = $this->db->query(
            '
            SELECT * FROM tbvideolink
            WHERE CLINICID = "' . $clinicId . '" '.$condition.' '.$sort.'
            LIMIT '.$page.','.$perPage
           
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function total($clinicId, $condition){
       
        $query = $this->db->query(
            '
            SELECT COUNT(*) AS NUM_OF_ROW FROM tbvideolink 
            WHERE CLINICID = "' . $clinicId . '" '.$condition
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getDataById($id){
        $query = $this->db->query('
            SELECT * FROM tbvideolink 
            WHERE VDOID = "'.$id.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('tbvideolink', $data);
        return true;
    }

    public function update($data, $id)
    {
        $this->db->where('VDOID', $id);
        $this->db->update('tbvideolink', $data);
        return true;
    }

    public function delete($id)
    {
        $this->db->where('VDOID', $id);
        $this->db->delete('tbvideolink');
        return true;
    }
}
