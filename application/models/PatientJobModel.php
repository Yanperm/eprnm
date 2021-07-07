<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class PatientJobModel extends CI_Model{


    public function getAllData(){
        $query = $this->db->get('tbpatient_job');

        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return array();
        }
    }

    public function getDataById($id){

        $query = $this->db->query('SELECT * FROM tbpatient_job where JobID = "'.$id.'"');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function insert($data){
        $this->db->insert('tbpatient_job',$data);
        return true;
    }

    public function update($data,$id){
        $this->db->where('JobID',$id);
        $this->db->update('tbpatient_job',$data);
        return true;
    }

    public function delete($id){
        $this->db->where('JobID',$id);
        $this->db->delete('tbpatient_job');
        return true;
    }

    

}

?>