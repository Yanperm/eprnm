<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RestDayModel extends CI_Model{

   public function getDataRest($clinicId){
   
    $query = $this->db->query(
        '
        SELECT *
        FROM tbclose
        WHERE CLINICID = "' . $clinicId . '" 
        '
    );

    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return array();
    }
    
   }
}




?>