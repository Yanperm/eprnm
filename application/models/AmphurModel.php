<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AmphurModel extends CI_model{

    public function getAllData(){
        $query = $this->db->get('amphur');

        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return array();
        }
    }

    public function getDataByID($id){
        $query = $this->db->query('SELECT * FROM amphur where AMPHUR_ID = "'.$id.'"');

        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return array();
        }
    }

    public function insert($data){
        $this->db->insert('amphur',$data);
        return true;
    }

    public function update($data,$id){
        $this->db->where('AMPHUR_ID',$id);
        $this->db->update('amphur',$data);
        return true;

    }

    public function delete($id){
        $this->db->where('AMPHUR_ID',$id);
        $this->db->delete('amphur');
        return true;
    }


}


?>