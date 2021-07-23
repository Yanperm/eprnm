<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

 class DistrictModel extends CI_Model{

    public function getAllData(){
        $query = $this->db->get('district');

        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return array();
        }
    }

    public function getDataByID($id){
        $query = $this->db->query('SELECT * FROM district where DISTRICT_ID = "'.$id.'"');

        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return array();
        }
    }

    public function insert($data){
        $this->db->insert('district',$data);
        return true;
    }

    public function update($data,$id){
        $this->db->where('DISTRICT_ID',$id);
        $this->db->update('district',$data);
        return true;
    }

    public function delete($id){
        $this->db->where('DISTRICT_ID',$id);
        $this->db->delete('district');
        return true;
    }
 }


?>