<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogCommentModel extends CI_Model{

    public function getAllData(){
        $query = $this->db->get('tbblog_comment');

        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return array();
        }
    }

    public function getDataByID($id){
        $query = $this->db->query('SELECT * FROM tbblog_comment where id = "'.$id.'"');

        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return array();
        }
    }

    public function insert($data){
        $this->db->insert('tbblog_comment',$data);
        return true;
    }

    public function update($data,$id){
        $this->db->where('id',$id);
        $this->db->update('tbblog_comment',$data);
        return true;
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete('tbblog_comment');
        return true;
    }
}

?>