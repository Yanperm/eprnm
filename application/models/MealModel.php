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
}
?>