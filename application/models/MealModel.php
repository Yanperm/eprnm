<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class MealModel extends CI_Model{


    public function getAllData(){
        $this->db->order_by('id', 'ASC');
        $query =  $this->db->get('tbMeal');

        if ($query->num_rows() > 0) {

            return $query->result();
        }else{
            return array();
        }
    }

    public function getDataByID($id){
        $query = $this->db->query('SELECT * FROM tbmeal WHERE id = "'.$id.'"');

        if($query->num_rows()>0){
            return $query->row();
        }else{
            return array();
        }
    }

    public function insert($data){
        $this->db->insert('tbmeal',$data);
        return true;
    }

    public function update($data,$id){
        $this->db->where('id',$id);
        $this->db->update('tbmeal',$data);
        return true;
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete('tbmeal');
        return true;
    }
}
?>