<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CallingUnitsModel extends CI_Model{

    public function getDataAll(){
        $query = $this->db->get('tbcallingunits');

        if($query->num_rows()>0){
            return $query->result();
        }else{
            return array();
        }
    }

    public function getDataByID($id){
        $query = $this->db->query('SELECT * FROM tbcallingunits WHERE id = "'.$id.'" ');

        if($query->num_rows()>0){
            return $query->row();
        }else{
            return array();
        }
    }

    public function insert($data){
        $this->db->insert('tbcallingunits',$data);
        return true;
    }

    public function update($data,$id){
        $this->db->where('id',$id);
        $this->db->update('tbcallingunits',$data);
        return true;
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete('tbcallingunits');
        return true;
    }
}


?>