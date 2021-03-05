<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClinicModel extends CI_Model
{
    public function login($email, $password)
    {
        $this->db->where('USERNAME', $email);
        $this->db->where('PASSWORD', md5($password));
        $this->db->where('ACTIVATE', 1);
        $this->db->group_start();
        $this->db->where('TYPE', 'ULTIMATE');
        $this->db->or_where('TYPE', 3);
        $this->db->group_end();
        $query = $this->db->get('tbclinic');

        if ($query->num_rows() == 1) {
            return $query->row();
        }

        return false;
    }
}