<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class CountUnitModel extends CI_Model{

    public function getAllData(){
        $this->db->order_by('detail', 'ASC');
        $query =  $this->db->get('tbCountUnit');

        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return array();
        }
    }

    public function getDataByID($id){
        $query = $this->db->query('SELECT * FROM tbCountUnit where id = "'.$id.'" ');

        if ($query->num_rows()>0) {
            return $query->row();
        }else{
            return array();
        }
    }

    public function insert($data){
        $this->db->insert('tbCountUnit',$data);
        return true;
    }

    public function update($data,$id){
        $this->db->where('id',$id);
        $this->db->update('tbCountUnit',$data);
        return true;
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete('tbCountUnit');
        return true;
    }
}




?>