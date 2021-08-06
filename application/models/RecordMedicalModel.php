<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordMedicalModel extends CI_Model
{
    public function getDataPerPage($memberId, $condition, $sort, $page, $perPage)
    {
      
        $query = $this->db->query(
            '
            SELECT * FROM tbpatient_medical 
            WHERE MEMBERIDCARD = '.$memberId.' '.$condition.' '.$sort.' 
            LIMIT '.$page.','.$perPage
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function total($memberId, $condition){
        $query = $this->db->query(
            '
            SELECT COUNT(*) AS NUM_OF_ROW FROM tbpatient_medical 
            WHERE MEMBERIDCARD = '.$memberId.' '.$condition
            
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    public function getDataById($id)
    {
        $query = $this->db->query(
            '
            SELECT *,medical.CREATE as DATE_MEDICAL FROM tbpatient_medical as medical
            left join tbmembers as member on member.MEMBERIDCARD = medical.MEMBERIDCARD
            left join tbclinic as clinic on clinic.IDCLINIC = medical.CLINICID
            WHERE medical.BOOKINGID = "'.$id.'"' 
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getDataByMedicalId($id)
    {
        $query = $this->db->query(
            '
            SELECT *,medical.CREATE as DATE_MEDICAL FROM tbpatient_medical as medical
            left join tbmembers as member on member.MEMBERIDCARD = medical.MEMBERIDCARD
            left join tbclinic as clinic on clinic.IDCLINIC = medical.CLINICID
            WHERE medical.MEDICALID = "'.$id.'"' 
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getDataByBookingId($bookingId)
    {
      
        $query = $this->db->query(
            '
            SELECT * FROM tbpatient_medical 
            WHERE BOOKINGID = "'.$bookingId.'"'
        );

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getDataProduct($clinicId, $condition, $sortBy, $sortType, $page, $perPage)
    {

        $this->db->select('tbproducts.*, tbsubcategory.SubName, tbproductcategory.CategoryName');
        $this->db->from('tbproducts');
        $this->db->join('tbsubcategory', 'tbsubcategory.SubID = tbproducts.SubID');
        $this->db->join('tbproductcategory', 'tbproductcategory.CategoryID = tbproducts.CategoryID');
        $this->db->where('tbproducts.CLINICID', $clinicId);
        if($condition != ""){
            $this->db->where($condition);
        }
        if($sortBy != ""){
            $this->db->order_by($sortBy, $sortType);
        }else{
            $this->db->order_by('tbproducts.BrandName', 'ASC');
        }

        $this->db->limit($perPage, $page);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function totalProduct($clinicId, $condition)
    {
        $this->db->select('COUNT(*) AS NUM_OF_ROW ');
        $this->db->from('tbproducts');
        $this->db->join('tbsubcategory', 'tbsubcategory.SubID = tbproducts.SubID');
        $this->db->join('tbproductcategory', 'tbproductcategory.CategoryID = tbproducts.CategoryID');
        $this->db->where('tbproducts.CLINICID', $clinicId);
        if($condition != ""){
            $this->db->where($condition);
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }


    public function insert($data)
    {
        $this->db->insert('tbpatient_medical', $data);
        return true;
    }

    public function update($data, $id)
    {
        $this->db->where('MEDICALID', $id);
        $this->db->update('tbpatient_medical', $data);
        return true;
    }

    public function delete($id)
    {
        $this->db->where('MEDICALID', $id);
        $this->db->delete('tbpatient_medical');
        return true;
    }
}