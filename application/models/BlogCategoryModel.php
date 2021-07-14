<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogCategoryModel extends CI_Model{

    public function getAllDAta(){
        $query = $this->db->get('tbblog_category');

        if($query->num_rows() > 0 ){
            return $query->result();
        }else{
            return array();
        }
    }

    public function getDataByID($id){
        $query = $this->db->query('SELECT * FROM tbblog_category where id = "'.$id.'" ');

        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return array();
        }
    }

    public function insert($data){
        $this->db->insert('tbblog_category',$data);
        return true;
    }

    public function update($data,$id){
        $this->db->where('id',$id);
        $this->db->update('tbblog_category',$data);
        return true;
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete('tbblog_category');
        return true;
    }
}
?>