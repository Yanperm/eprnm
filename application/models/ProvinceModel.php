<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class ProvinceModel extends CI_Model{

    public function getDataAll(){

        $query = $this->db->get('province');

        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return array();
        }
    }

    public function getDataByID($id){

        $query = $this->db->query('SELECT * FROM province where PROVINCE_ID ="'.$id.'"');
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return array();
        }
    }

    public function insert($data){
        $this->db->insert('province',$data);
        return true;
    }

    public function update($data,$id){
        $this->db->where('PROVINCE_ID',$id);
        $this->db->update('province',$data);
        return true;
    }

    public function delete($id){
        $this->db->where('PROVINCE_ID',$id);
        $this->db->delete('province');
        return true;
    }
}



?>