<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class InfoModel extends CI_Model{

    public function getAlldata(){
        $query = $this->db->get('tbinfo');

        if($query->num_rows() > 0 ){
            return $query->result();
        }else{
            return array();
        }
    }

    public function getDataByID($id){
        $query = $this->db->query('SELECT * FROM tbinfo where id = "'.$id.'"');

        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return array();
        }
    }

    public function insert($data){
        $this->db->insert('tbinfo',$data);
        return true;
    }

    public function update($data,$id){
        $this->db->where('id',$id);
        $this->db->update('tbinfo',$data);
        return true;
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete('tbinfo');
        return true;
    }
}
?>