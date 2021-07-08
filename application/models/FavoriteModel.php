<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class FavoriteModel extends CI_Model{

     public function getAllData(){
         $query = $this->db->get('tbfavorite');

         if($query -> num_rows() > 0 ){
             return $query->result();
         }else{
             return array();
         }
     } 

     public function getDataByID($id){
         $query = $this->db->query('SELECT * FROM tbfavorite where FAVID = "'.$id.'"');

         if($query->num_rows() > 0){
             return $query->row();
         }else{
             return array();
         }
     }

     public function insert($data){
        $this->db->insert('tbfavorite',$data);
        return true;
     }

     public function update($data,$id){
         $this->db->where('FAVID',$id);
         $this->db->update('tbfavorite',$data);
         return true;
     }

     public function delete($id){
         $this->db->where('FAVID',$id);
         $this->db->delete('tbfavorite');
         return true;
     }
}



?>