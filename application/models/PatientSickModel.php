<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PatientSickModel extends CI_Model {

    public function getAllData(){
        $query = $this->db->get('tbpatient_sick');

        if ($query->num_rows() >0) {
            return $query->result();
        }else{
            return array();
        }
    }

    public function getDataById($id){
        $query = $this->db->query('SELECT * FROM tbpatient_sick where SickID ="'.$id.'"');

        if($query->num_rows()>0){
            return $query->row();
        }else{
            return array();
        }
    }

    public function insert($data){
        $this->db->insert('tbpatient_sick',$data);
        return true;
    }

    public function update($data,$id){
        $this->db->where('SickID',$id);
        $this->db->update('tbpatient_sick',$data);
        return true;
    }

    public function delete($id){
        $this->db->where('SickID',$id);
        $this->db->delete('tbpatient_sick');
        return true;
    }
}






?>