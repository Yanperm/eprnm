<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class AdvertiseModel extends CI_Model{

    public function getDataAll(){
        $query = $this->db->get('advertise');

        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return array();
        }
    }

    public function getDataByID($id){
        $query = $this->db->query('SELECT * FROM advertise where ADVERTISEID = "'.$id.'"');

        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return array();
        }
    }

    public function insert($data){
        $this->db->insert('advertise',$data);
        return true;
    }

    public function update($data,$id){
        $this->db->where('ADVERTISEID',$id);
        $this->db->update('advertise',$data);
        return true;
    }

    public function delete($id){
        $this->db->where('ADVERTISEID',$id);
        $this->db->delete('advertise');
        return true;
    }
}
?>