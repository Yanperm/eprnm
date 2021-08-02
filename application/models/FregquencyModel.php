<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class FregquencyModel extends CI_Model{

    public function getAllData(){

        $this->db->order_by('id', 'ASC');
        $query =  $this->db->get('tbFregquency');

        if ($query->num_rows() > 0) {

            return $query->result();
        }else{
            return array();
        }


    }

    public function getDataByID($id){
        $query = $this->db->query('SELECT * FROM tbfregquency where id = "'.$id.'"');

        if($query->num_rows()>0){
            return $query->row();
        }else{
            return array();
        }
    }

    public function insert($data){
        $this->db->insert('tbfregquency',$data);
        return true;
    }

    public function update($data,$id){
        $this->db->where('id',$id);
        $this->db->update('tbfregquency',$data);
        return true;
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete('tbfregquency');
        return true;
    }
}


?>