<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StatModel extends CI_Model
{
    public function pageVisit($clinicId){
        $numOfVisit = 0;
        
        $query = $this->db->query("SELECT
                COUNT(*) AS NUM
            FROM
                dbnutmor.tbstat
            WHERE
                IDCLINIC != '' AND IP != '::1'
                    AND IDCLINIC = '" . $clinicId . "'"
            );
        if ($query->num_rows() > 0) {
            foreach($query->result() as $item){
                $numOfVisit = $item->NUM;
            }
        } 
        return $numOfVisit;
    }

    public function stat($clinicId)
    {
        $year = date("Y");
        $query = $this->db->query("SELECT
    COUNT(*) AS NUM, SUBSTRING(CREATEDATE, 6, 2)  AS MONTH
FROM
    dbnutmor.tbstat
WHERE
    IDCLINIC != '' AND IP != '::1'
        AND SUBSTRING(CREATEDATE, 1, 5) LIKE '%" . $year . "%'
        AND IDCLINIC = '" . $clinicId . "'
GROUP BY MONTH , IDCLINIC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function statByYear($clinicId)
    {
        $year = date("Y");
        $query = $this->db->query("SELECT
    COUNT(*) AS NUM, SUBSTRING(CREATEDATE, 6, 2)  AS MONTH
FROM
    dbnutmor.tbstat
WHERE
    IDCLINIC != '' AND IP != '::1'
        AND SUBSTRING(CREATEDATE, 1, 5) LIKE '%" . $year . "%'
        AND IDCLINIC = '" . $clinicId . "'
GROUP BY MONTH , IDCLINIC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function statByMonth($clinicId)
    {
        $days_ago = date('Y-m-d', strtotime('-30 days', strtotime(date('Y-m-d'))));
        $month = date("Y-m");
        $query = $this->db->query("SELECT
    COUNT(*) AS NUM, SUBSTRING(CREATEDATE, 1, 10)  AS DATE
FROM
    dbnutmor.tbstat
WHERE
    IDCLINIC != '' AND IP != '::1'
        AND (CREATEDATE BETWEEN '".$days_ago."' AND '".date('Y-m-d')."')
        
        AND IDCLINIC = '" . $clinicId . "'
GROUP BY DATE , IDCLINIC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }


    public function statByAdmin()
    {
        $year = date("Y");
        $query = $this->db->query("SELECT
    COUNT(*) AS NUM, SUBSTRING(CREATEDATE, 6, 2)  AS MONTH ,IDCLINIC
    FROM
    dbnutmor.tbstat
    WHERE
    IDCLINIC != '' AND IP != '::1'
        AND SUBSTRING(CREATEDATE, 1, 5) LIKE '%" . $year . "%'
      GROUP BY MONTH ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }


    public function insert($data)
    {
        $this->db->insert('tbstat', $data);
        return $this->db->insert_id();
    }
}
