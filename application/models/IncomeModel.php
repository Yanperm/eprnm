<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IncomeModel extends CI_Model
{
    public function statByMonth($clinicId){
        $month = date("2020-04");
        $query = $this->db->query("SELECT
                SUM((ci_check+ci_drug+ci_lab+ci_procedure+ci_certificate)) AS NUM, SUBSTRING(ci_date, 9, 2)  AS DATE
            FROM
                dbnutmor.tbincome
            WHERE
                SUBSTRING(ci_date, 1, 8) LIKE '%" . $month . "%'
                AND CLINICID = '" . $clinicId . "'
            GROUP BY DATE , CLINICID");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function insert($data)
    {
        $this->db->insert('tbincome', $data);
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->where('ci_id', $id);
        $this->db->update('tbincome', $data);
    }

    public function delete($id)
    {
        $this->db->where('ci_id', $id);
        $this->db->delete('tbincome');
    }
}
