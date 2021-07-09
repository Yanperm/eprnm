<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BlogModel extends CI_Model{

    public function getDataAll(){
        $query = $this->db->get('tbblog');

        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return array();
        }
    }

    public function getDataByID($id){
        $query = $this->db->query('SELECT * FROM tbblog where id = "'.$id.'"');

        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return array();
        }
    }

    public function insert($data){
        $this->db->insert('tbblog',$data);
        return true;
    }

    public function update($data,$id){
        $this->db->where('id',$id);
        $this->db->update('tbblog',$data);
        return true;
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete('tbblog');
        return true;
    }
}
?>