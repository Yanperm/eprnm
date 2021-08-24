<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class QueueClodeModel extends CI_Model{

    public function getDataPerpage($clinicId, $condition, $sort, $page, $perPage)
    {
        
        $query = $this->db->query(
            '
            SELECT * FROM tbqueueclode
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
            SELECT COUNT(*) AS NUM_OF_ROW FROM tbqueueclode 
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
            SELECT * FROM tbqueueclode 
            WHERE colseid = "'.$id.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('tbqueueclode', $data);
        return true;
    }

    // public function update($data, $id)
    // {
    //     $this->db->where('colseid', $id);
    //     $this->db->update('tbqueueclode', $data);
    //     return true;
    // }

    public function delete($id)
    {
        $this->db->where('colseid', $id);
        $this->db->delete('tbqueueclode');
        return true;
    }

    public function inserttbclose($data)
    {
        $this->db->insert('tbclose', $data);
        return true;
    }
}


?>

